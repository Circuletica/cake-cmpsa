<?php
class ContratosController extends AppController {
	//public $components = array('Paginator');
	var $displayField = 'referencia';

	public function index() {
		$this->paginate = array(
			'contain' => array(
				'Empresa',
				'Incoterm',
				'CalidadNombre',
				'CanalCompra'
			),
			'order' => array(
				'Contrato.posicion_bolsa' => 'asc'
			)
		);
		$this->Contrato->bindModel(array(
			'belongsTo' => array(
				'Empresa' => array(
					'foreignKey' => false,
					'conditions' => array('Empresa.id = Contrato.proveedor_id')
					)
				)
		));
		$this->set('contratos', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Contrato/view');
			$this->redirect(array('action'=>'index'));
		}
		$contrato = $this->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $id),
			'recursive' => 2));
		$this->set('contrato', $contrato);
		
		//La suma del peso de todas las operaciones de un contrato
		$peso_fijado = $this->Contrato->query(
			"SELECT
				SUM(p.peso) as peso_fijado
			FROM peso_operaciones p
			LEFT JOIN contratos c ON (p.contrato_id = c.id)
			WHERE c.id = $id;
			"
		);
		//el sql devuelve un array, solo queremos el campo de peso sin decimales
		$peso_fijado = intval($peso_fijado[0][0]['peso_fijado']);
		$this->set(compact('peso_fijado'));
		//$peso_por_fijar = $contrato['Contrato']['peso_comprado'] - $peso_fijado; 
		$this->set('peso_por_fijar', $contrato['Contrato']['peso_comprado'] - $peso_fijado);

		$this->set('referencia', $contrato['Contrato']['referencia']);
		//si embarque o entrega
		$this->set('tipo_fecha_transporte', $contrato['Contrato']['si_entrega'] ? 'Fecha de entrega' : 'Fecha de embarque');
		$this->set('tipo_puerto', $contrato['Contrato']['si_entrega'] ? 'Puerto de destino' : 'Puerto de carga');
		$this->set('puerto', $contrato['Contrato']['si_entrega'] ? $contrato['PuertoDestino']['nombre'] : $contrato['PuertoCarga']['nombre']);
		//mysql almacena la fecha en formato ymd
		$this->set('fecha_transporte', $contrato['Contrato']['fecha_transporte']);
		$fecha = $contrato['Contrato']['posicion_bolsa'];
		//sacamos el nombre del mes en castellano
		setlocale(LC_TIME, "es_ES.UTF-8");
		$mes = strftime("%B", strtotime($fecha));
		$anyo = substr($fecha,0,4);
		$this->set('posicion_bolsa', $mes.' '.$anyo);
	}

	public function add() {
		$proveedores = $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre_corto'),
			'recursive' => 1,
			'order' => array('Empresa.nombre_corto' => 'ASC')
			)
		);
		$this->set('proveedores', $proveedores);
		$this->set('puertoCargas', $this->Contrato->PuertoCarga->find('list', array(
			'order' => array('PuertoCarga.nombre' => 'ASC')
			))
		);
		$this->set('puertoDestinos', $this->Contrato->PuertoDestino->find('list', array(
			'order' => array('PuertoDestino.nombre' => 'ASC')
			))
		);
		$this->set('incoterms', $this->Contrato->Incoterm->find('list', array(
			'order' => array('Incoterm.nombre' => 'ASC')
			)
		));
		$canal_compras_divisa = $this->Contrato->CanalCompra->find('all');
		$this->set('canal_compras_divisa', $canal_compras_divisa);
		$canal_compras = $this->Contrato->CanalCompra->find('list', array(
			'fields' => array('id','nombre')
			)
		);
		$this->set('canal_compras', $canal_compras);
		//En la vista se muestra la lista de todos los embalajes existentes
		$embalajes = $this->Contrato->ContratoEmbalaje->Embalaje->find('all', array(
			'order' => array('Embalaje.nombre' => 'asc')
			)
		);
		$this->set('embalajes', $embalajes);
		//desplegable con las calidades de café
		$this->set('calidades',$this->Contrato->CalidadNombre->find('list', array(
			'order' => array('CalidadNombre.nombre' => 'ASC')
			)
		));
		//El tipo de fecha: embarque o entrega
		$this->set('tipos_fecha_transporte', array(
			'0'=>'embarque',
			'1'=>'entrega'
			)
		);
		//Rellenamos la fecha de posicion con el mes/año de hoy sólo si esta vacío,
		//si ya tenía valor y que el usuario vuelve al formulario, se guarda lo que
		//habia metido antes.
		//Si usaramos un 'selected' en la View, cuando vuelve el usuario al formulario
		//se sobreescribe lo que tenía
		if (!isset($this->request->data['Contrato']['posicion_bolsa']['day']))
			$this->request->data['Contrato']['posicion_bolsa']['day'] = date('Y-m');
		if($this->request->is('post')):
			//Hay que meter un dia si no queremos que mysql meta una fecha NULL
			//lo suyo seria tener 0, pero el cakephp parece que no quiere
			$this->request->data['Contrato']['posicion_bolsa']['day'] = 1;
			if($this->Contrato->save($this->request->data)):
				//Las claves del array data['Embalaje'] no son secuenciales,
				//son realmente el embalaje_id
				foreach ($this->request->data['Embalaje'] as $embalaje_id => $valor) {
					//no interesa guardar lineas vacías
					if ($valor['cantidad_embalaje'] != NULL) {
						$this->request->data['ContratoEmbalaje']['contrato_id'] = $this->Contrato->id;
						$this->request->data['ContratoEmbalaje']['embalaje_id'] = $embalaje_id;
						$this->request->data['ContratoEmbalaje']['cantidad_embalaje'] = $valor['cantidad_embalaje'];
						$this->request->data['ContratoEmbalaje']['peso_embalaje_real'] = $valor['peso_embalaje_real'];
						$this->Contrato->ContratoEmbalaje->saveAll($this->request->data['ContratoEmbalaje']);
					}
				}
				$this->Session->setFlash('Contrato guardado');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Contrato->id = $id;
		$contrato = $this->Contrato->findById($id);
		$this->set('contrato',$contrato);
		//el titulado completo de la Calidad sale de una vista
		//de MySQL que concatena descafeinado, pais y descripcion
		$this->set('calidades',$this->Contrato->CalidadNombre->find('list', array(
			'order' => array('CalidadNombre.nombre' => 'ASC')
			)
		));
		$this->set('incoterms', $this->Contrato->Incoterm->find('list', array(
			'order' => array('Incoterm.nombre' => 'ASC')
			)
		));
		$this->set('puertoCargas', $this->Contrato->PuertoCarga->find('list', array(
			'order' => array('PuertoCarga.nombre' => 'ASC')
			))
		);
		$this->set('puertoDestinos', $this->Contrato->PuertoDestino->find('list', array(
			'order' => array('PuertoDestino.nombre' => 'ASC')
			))
		);
		$this->set('proveedores', $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre_corto'),
			'recursive' => 1,
			'order' => array('Empresa.nombre_corto' => 'ASC')
			))
		);
		//Donde se compra el café (London, New-York, ...)
		$canal = $this->Contrato->CanalCompra->find('first', array(
			'conditions' => array('CanalCompra.id' => $contrato['CanalCompra']['id']),
			'fields' => array('id','nombre','divisa')
			)
		);
		$this->set('canal',$canal);
		//En la vista se muestra la lista de todos los embalajes existentes
		$embalajes = $this->Contrato->ContratoEmbalaje->Embalaje->find('all', array(
			'order' => array('Embalaje.nombre' => 'asc')
			)
		);
		$this->set('embalajes', $embalajes);
		//El tipo de fecha: embarque o entrega
		$this->set('tipos_fecha_transporte', array(
			'0'=>'embarque',
			'1'=>'entrega'
			)
		);
		//la fecha de transporte (embarque o entrega)
		$this->set('si_entrega', $contrato['Contrato']['si_entrega']);

		if($this->request->is('get')):
			$this->request->data = $this->Contrato->read();
			foreach($contrato['ContratoEmbalaje'] as $embalaje) {
				$this->request->data['Embalaje'][$embalaje['embalaje_id']]['cantidad_embalaje'] = $embalaje['cantidad_embalaje'];
				$this->request->data['Embalaje'][$embalaje['embalaje_id']]['peso_embalaje_real'] = $embalaje['peso_embalaje_real'];
			}
		else:
			//Hay que meter un dia si no queremos que mysql meta una fecha NULL
			//lo suyo seria tener 0, pero el cakephp parece que no quiere
			$this->request->data['Contrato']['posicion_bolsa']['day'] = 1;
			if ($this->Contrato->save($this->request->data)):
				//Los registros de ContratoEmbalaje se van sumando
				//entonces hay que borrarlos todos porque el saveAll()
				//los volverá a crear y no queremos duplicados
				$this->Contrato->ContratoEmbalaje->deleteAll(array(
					'ContratoEmbalaje.contrato_id' => $this->Contrato->id
					)
				);
				//sacamos los datos del formulario en edit.ctp para crear nuevos
				//registros en la tabla de join
				//Las claves del array data['Embalaje'] no son secuenciales,
				//son realmente el embalaje_id
				foreach ($this->request->data['Embalaje'] as $embalaje_id => $valor) {
					//no interesa guardar lineas vacías
					if ($valor['cantidad_embalaje'] != NULL) {
						$this->request->data['ContratoEmbalaje']['contrato_id'] = $this->Contrato->id;
						$this->request->data['ContratoEmbalaje']['embalaje_id'] = $embalaje_id;
						$this->request->data['ContratoEmbalaje']['cantidad_embalaje'] = $valor['cantidad_embalaje'];
						$this->request->data['ContratoEmbalaje']['peso_embalaje_real'] = $valor['peso_embalaje_real'];
						$this->Contrato->ContratoEmbalaje->saveAll($this->request->data['ContratoEmbalaje']);
					}
				}
				$this->Session->setFlash('Contrato '.
				$this->request->data['Contrato']['referencia'].
			        ' modificada con éxito');
				$this->redirect(array(
					'action' => 'view',
					$id
					)
				);
			else:
				$this->Session->setFlash('Contrato NO guardado');
			endif;
		endif;
	}

	public function copy($id = null) {
		//para duplicar un registro, se hace una copia del mismo con
		//los registros relacionados en otras tablas, teniendo cuidado
		//de usar una clave primaria nueva (id) y se hace un redirect
		//al edit del nuevo registro para poder modificar los campos
		//que lo necesitan (entre otros la referencia que es UNIQUE)

		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		
		$nuevo_contrato = $this->Contrato->findById($id);
		unset($nuevo_contrato['Contrato']['id']);
		unset($nuevo_contrato['Contrato']['created']);
		unset($nuevo_contrato['Contrato']['modified']);
		//no podemos tener dos contratos con la misma referencia
		$nuevo_contrato['Contrato']['referencia'] .= '###';
		$this->Contrato->create();
		$this->Contrato->save($nuevo_contrato);
		
		//hay que recuperar los embalajes del contrato copiado
		$contrato_embalajes = $this->Contrato->ContratoEmbalaje->find('all', array(
			'conditions' => array('ContratoEmbalaje.contrato_id' => $id)
			)
		);
		//y copiar los registros de ContratoEmbalaje pero con el id del nuevo contrato
		foreach($contrato_embalajes as $contrato_embalaje) {
			unset($contrato_embalaje['ContratoEmbalaje']['id']);
			unset($contrato_embalaje['ContratoEmbalaje']['created']);
			unset($contrato_embalaje['ContratoEmbalaje']['modified']);
			$contrato_embalaje['ContratoEmbalaje']['contrato_id'] = $this->Contrato->id;
			$this->Contrato->ContratoEmbalaje->create();
			$this->Contrato->ContratoEmbalaje->save($contrato_embalaje);
		}

		$this->redirect(array(
			'action'=>'edit',
			$this->Contrato->id
			)
		);
	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) :
			throw new MethodNotAllowedException();
		endif;
		if ($this->Contrato->delete($id)):
			$this->Session->setFlash('Contrato borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}
}
?>
