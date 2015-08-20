<?php
class OperacionesController extends AppController {
	var $displayField = 'referencia';

	public $paginate = array(
		'recursive' => 3,
		'order' => array('Operacion.referencia' => 'asc')
	);

	public function index() {
		$this->set('operaciones', $this->paginate());
	}

	public function index_trafico() {
	$this->set('operaciones', $this->paginate());
	$proveedores = $this->Operacion->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
		)
	);
	$calidades = $this->Operacion->Contrato->CalidadNombre->find('list', array(
		'fields' => array('CalidadNombre.nombre'),
		'recursive' => 1
		)
	);	

	$this->set('proveedores', $proveedores);
	$this->set('calidades', $calidades);

	}
public function view($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$operacion = $this->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 3
			)
		);
		$this->set('operacion', $operacion);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
				),
				'fields' => array('Embalaje.nombre', 'ContratoEmbalaje.peso_embalaje_real')
			)
		);
		$this->set('embalaje', $embalaje);
		$this->set('divisa', $operacion['Contrato']['CanalCompra']['divisa']);
		foreach ($operacion['AsociadoOperacion'] as $linea):
			$peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
			$codigo = substr($linea['Asociado']['Empresa']['codigo_contable'],-2);
			$lineas_reparto[] = array(
				'Código' => $codigo,
				'Nombre' => $linea['Asociado']['Empresa']['nombre_corto'],
				'Cantidad' => $linea['cantidad_embalaje_asociado'],
				'Peso' => $peso
			);	
		endforeach;
		$columnas_reparto = array_keys($lineas_reparto[0]);
		//indexamos el array por el codigo de asociado
		$lineas_reparto = Hash::combine($lineas_reparto, '{n}.Código','{n}');
		//se ordena por codigo ascendente
		ksort($lineas_reparto);
		$this->set('columnas_reparto',$columnas_reparto);
		$this->set('lineas_reparto',$lineas_reparto);
	}
	
public function view_trafico($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formada Operación/view ');
			$this->redirect(array('action'=>'index'));
		}
		$operacion = $this->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3));
		$this ->set('operacion',$operacion);
		//el nombre de calidad concatenado esta en una view de MSQL
		$this->loadModel('ContratoEmbalaje');

		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
				),
				'fields' => array('Embalaje.nombre', 'ContratoEmbalaje.peso_embalaje_real')
			)
		);
		$this->set('tipo_fecha_transporte', $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
		//mysql almacena la fecha en formato ymd
		$fecha = $operacion['Contrato']['fecha_transporte'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$this->set('fecha_transporte', $dia.'-'.$mes.'-'.$anyo);		

		$this->set('embalaje', $embalaje);
		$this->loadModel('CalidadNombre');

//Líneas de reparto
			foreach ($operacion['AsociadoOperacion'] as $linea):
			$peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
			$codigo = substr($linea['Asociado']['Empresa']['codigo_contable'],-2);
			$lineas_reparto[] = array(
				'Código' => $codigo,
				'Nombre' => $linea['Asociado']['Empresa']['nombre_corto'],
				'Cantidad' => $linea['cantidad_embalaje_asociado'],
				'Peso' => $peso.' Kg'
			);	
		endforeach;
		$columnas_reparto = array_keys($lineas_reparto[0]);
		//indexamos el array por el codigo de asociado
		$lineas_reparto = Hash::combine($lineas_reparto, '{n}.Código','{n}');
		//se ordena por codigo ascendente
		ksort($lineas_reparto);
		$this->set('columnas_reparto',$columnas_reparto);
		$this->set('lineas_reparto',$lineas_reparto);

	}

	public function add() {
	$proveedores = $this->Operacion->Contrato->Proveedor->find('list', array(
		'fields' => array('Proveedor.id','Empresa.nombre'),
		'recursive' => 1
		)
	);
	$calidades = $this->Operacion->Contrato->CalidadNombre->find('list', array(
		'fields' => array('CalidadNombre.nombre'),
		'recursive' => 1
		)
	);
		$this->set('proveedores', $proveedores);
		$this->set('incoterms', $this->Operacion->Contrato->Incoterm->find('list'));
		$this->set('calidades', $calidades);

		if($this->request->is('post')):
			if($this->Operacion->save($this->request->data) ):
				$this->Session->setFlash('Operación guardada');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			endif;
		endif;
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
			//$this->Session->setFlash('URL mal formado');
			//$this->redirect(array('action'=>'index'));
		endif;
		if ($this->Operacion->delete($id)):
			$this->Session->setFlash('Operación borrada');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Operacion->id = $id;
		$operacion = $this->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3
			)
		);
		$this->set('operacion', $operacion);
//		$asociados = $this->Operacion->AsociadoOperacion->Asociado->find('list', array(
//			'fields' => array('Asociado.id','Empresa.nombre_corto'),
//			'order' => array('Empresa.codigo_contable' => 'ASC'),
//			'recursive' => 1
//			)
//		);
		$asociados = $this->Operacion->AsociadoOperacion->Asociado->find('all', array(
			'fields' => array('Asociado.id','Empresa.codigo_contable','Empresa.nombre_corto'),
			'order' => array('Empresa.codigo_contable' => 'ASC'),
			'recursive' => 1
			)
		);
		//reindexamos los asociados por codigo contable
		$asociados = Hash::combine($asociados, '{n}.Empresa.codigo_contable', '{n}');
		ksort($asociados);
		$this->set('asociados', $asociados);
		$this->set('divisa', $operacion['Contrato']['CanalCompra']['divisa']);
		//los que ya tienen embalajes en la operacion
		$asociados_operacion = $operacion['AsociadoOperacion'];
		//queremos el id del socio como index del array
		$asociados_operacion = Hash::combine($asociados_operacion, '{n}.Asociado.id', '{n}');
		$this->set('asociados_operacion', $asociados_operacion);
		//Ahora que tenemos todos los datos, rellenamos el formulario
		$embalaje = $this->Operacion->Contrato->ContratoEmbalaje->find('first', array(
			'conditions' => array(
				'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
				'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
			)
		));
		$this->set('embalaje', $embalaje);
		if($this->request->is('get')): //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->Operacion->read();
			foreach ($asociados_operacion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['cantidad_embalaje_asociado'];
			}
		else:
			if ($this->Operacion->save($this->request->data)):
				//Los registros de AsociadoOperacion se van sumando
				//asi que hay que borrarlos todos porque el saveAll() los
				//vuelve a crear y no queremos duplicados.
				$this->Operacion->AsociadoOperacion->deleteAll(array(
					'AsociadoOperacion.operacion_id' => $id
				));
				foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
					if ($cantidad != NULL) {
						$this->request->data['AsociadoOperacion']['operacion_id'] = $this->Operacion->id;
						$this->request->data['AsociadoOperacion']['asociado_id'] = $asociado_id;
						$this->request->data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
						$this->Operacion->AsociadoOperacion->saveAll($this->request->data['AsociadoOperacion']);
					}
				}
				$this->Session->setFlash('Operacion '.
				$this->request->data['Operacion']['referencia'].
			        ' modificada con éxito');
				$this->redirect(array(
					'action' => 'view',
					$id
					)
				);
			else:
				$this->Session->setFlash('Operacion NO guardada');
			endif;
		endif;
	}
}
?>