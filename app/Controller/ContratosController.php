<?php
class ContratosController extends AppController {
    var $displayField = 'referencia';

    public function index() {
	$this->paginate['order'] = array('Contrato.posicion_bolsa' => 'asc');
	$this->Contrato->virtualFields['calidad']=$this->Contrato->Calidad->virtualFields['nombre'];
	$this->paginate['contain'] = array(
	    'Proveedor' => array(
			'fields' => array(
				'nombre_corto'
			)
	    ),
	    'Incoterm' => array(
			'fields' => array(
				'nombre'
			)
	    ),
	    'Calidad' => array(
			'fields' => array(
				'nombre'
			)
	    ),
	    'CanalCompra' => array(
			'fields' => array(
				'nombre'
			)
	    )
	);
	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$this->loadModel('Proveedor');
	$proveedores = $this->Proveedor->find(
	    'list',
	    array(
			'fields' => array('Proveedor.id','Empresa.nombre_corto'),
			'order' => array('Empresa.nombre_corto' => 'asc'),
			'recursive' => 1
	    )
	);
	$this->set('proveedores',$proveedores);

	//los elementos de la URL pasados como Search.* son almacenados por cake en $this->passedArgs[]
	//por ej.
	//$passedArgs['Search.palabras'] = mipalabra
	//$passedArgs['Search.id'] = 3

	$titulo = $this->filtroPaginador(
	    array(
			'Contrato' => array(
				'Referencia' => array(
					'columna' => 'referencia',
					'exacto' => false,
					'lista' => '',
				),
				'Proveedor' => array(
					'columna' => 'proveedor_id',
					'exacto' => true,
					'lista' => $proveedores
				),
				'Calidad' => array(
					'columna' => 'calidad',
					'exacto' => false,
					'lista' => ''
				)
			)
	    )
	);
	//filtramos por fecha
	if(isset($this->passedArgs['Search.fecha'])) {
	    $criterio = $this->passedArgs['Search.fecha'];
	    //Si solo se ha introducido un año (aaaa)
	    if (preg_match('/^\d{4}$/',$criterio)) { $anyo = $criterio; }
	    //la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
	    elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$criterio)) {
		list($mes,$anyo) = explode('-',$criterio);
	    } else {
			$this->Flash->set('Error de fecha');
			$this->redirect(array('action' => 'index'));
	    }
	    //si se ha introducido un año, filtramos por el año
	    if($anyo) { $this->paginate['conditions']['YEAR(Contrato.posicion_bolsa) ='] = $anyo;};
	    //si se ha introducido un mes, filtramos por el mes
	    if(isset($mes)) { $this->paginate['conditions']['MONTH(Contrato.posicion_bolsa) ='] = $mes;};
	    $this->request->data['Search']['fecha'] = $criterio;
	    //completamos el titulo
	    $title[] = 'Fecha: '.$criterio;
	}

	$contratos=$this->paginate();

	//generamos el título
	if (isset($title)) { //si hay criterios de filtro
	    $title = implode(' | ', $title);
	    $title = 'Contratos de '.$title;
	} else {
	    $title = 'Contratos';
	}

	//pasamos los datos a la vista
	$this->set(compact('contratos','title'));
    }

    public function view($id = null) {
	if (!$id) {
        throw new NotFoundException(__('URL mal formado Contrato/view'));
	}
	$contrato = $this->Contrato->find(
        'first',
        array(
            'conditions' => array('Contrato.id' => $id),
            'recursive' => 2
        )
    );
    if (!$contrato) {
        throw new NotFoundException(__('No existe ese contrato'));
    }
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
		$this->set('peso_por_fijar', $contrato['Contrato']['peso_comprado'] - $peso_fijado);

		$this->set('referencia', $contrato['Contrato']['referencia']);
		//si embarque o entrega
		$this->set('tipo_fecha_transporte', $contrato['Contrato']['si_entrega'] ? 'Fecha de entrega' : 'Fecha de embarque');
//		$this->set('tipo_puerto', $contrato['Contrato']['si_entrega'] ? 'Puerto de destino' : 'Puerto de carga');
//		$this->set('puerto', $contrato['Contrato']['si_entrega'] ? $contrato['PuertoDestino']['nombre'] : $contrato['PuertoCarga']['nombre']);
		$this->set('puerto_carga', $contrato['PuertoCarga']['nombre']);
		$this->set('puerto_destino', $contrato['PuertoDestino']['nombre']);
		//mysql almacena la fecha en formato ymd
		$this->set('fecha_transporte', $contrato['Contrato']['fecha_transporte']);
		$fecha = $contrato['Contrato']['posicion_bolsa'];
		//sacamos el nombre del mes en castellano
		setlocale(LC_TIME, "es_ES.UTF-8");
		$mes = strftime("%B", strtotime($fecha));
		$anyo = substr($fecha,0,4);
		$this->set('posicion_bolsa', $mes.' '.$anyo);
		//Se declara para acceder al PDF
		$this->set(compact('id'));
    }

    public function add() {
	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$this->loadModel('Proveedor');
	$proveedores = $this->Proveedor->find(
	    'list',
	    array(
		'fields' => array('Proveedor.id','Empresa.nombre_corto'),
		'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1
	    )
	);
	$this->set('proveedores',$proveedores);
	$this->set(
	    'puertoCargas',
	    $this->Contrato->PuertoCarga->find(
		'list',
		array(
		    'order' => array('PuertoCarga.nombre' => 'ASC')
		)
	    )
	);
	$this->set(
	    'puertoDestinos',
	    $this->Contrato->PuertoDestino->find(
		'list',
		array(
		    'order' => array('PuertoDestino.nombre' => 'ASC')
		)
	    )
	);
	$this->set(
	    'incoterms',
	    $this->Contrato->Incoterm->find(
		'list',
		array(
		    'order' => array('Incoterm.nombre' => 'ASC')
		)
	    )
	);
	$this->set(
	    'canal_compras_divisa',
	    $this->Contrato->CanalCompra->find('all')
	);
	$this->set(
	    'canal_compras',
	    $this->Contrato->CanalCompra->find(
		'list',
		array(
		    'fields' => array('id','nombre')
		)
	    )
	);
	//En la vista se muestra la lista de todos los embalajes existentes
	$this->set(
	    'embalajes',
	    $this->Contrato->ContratoEmbalaje->Embalaje->find(
		'all',
		array(
		    'order' => array('Embalaje.nombre' => 'asc')
		)
	    )
	);
	//desplegable con las calidades de café
	$this->set(
	    'calidades',
	    $this->Contrato->Calidad->find(
		'list',
		array(
		    'order' => array('Calidad.nombre' => 'ASC')
		)
	    )
	);
	//El tipo de fecha: embarque o entrega
	$this->set(
	    'tipos_fecha_transporte',
	    array(
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
	if($this->request->is('post')) {
	    //Hay que meter un dia si no queremos que mysql meta una fecha NULL
	    //lo suyo seria tener 0, pero el cakephp parece que no quiere
	    $this->request->data['Contrato']['posicion_bolsa']['day'] = 1;
	    //si se ha cambiado el canalCompra a uno sin diferencial,
	    //hay que borrar el diferencial que existía antes
	    $canal_compra = $this->Contrato->CanalCompra->findById($this->request->data['Contrato']['canal_compra_id']);
	    if (!$canal_compra['CanalCompra']['si_diferencial']) $this->request->data['Contrato']['diferencial'] = 0;
	    if($this->Contrato->save($this->request->data)) {
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
		$this->Flash->set('Contrato guardado');
		$this->redirect(array('action' => 'index'));
	    }
	}
    }

    public function edit($id = null) {
	if (!$id) {
        throw new NotFoundException(__('URL mal formado Contrato/edit'));
	}
	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$this->loadModel('Proveedor');
	$proveedores = $this->Proveedor->find(
	    'list',
	    array(
		'fields' => array('Proveedor.id','Empresa.nombre_corto'),
		'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1
	    )
	);
	$this->set('proveedores',$proveedores);
	$this->Contrato->id = $id;
	$contrato = $this->Contrato->findById($id);
	$this->set('contrato',$contrato);
	//el titulado completo de la Calidad sale de una vista
	//de MySQL que concatena descafeinado, pais y descripcion
	$this->set('calidades',$this->Contrato->Calidad->find('list', array(
			'order' => array('Calidad.nombre' => 'ASC')
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
	//Donde se compra el café (London, New-York, ...)
	$canal_compras = $this->Contrato->CanalCompra->find('list', array(
	    'fields' => array('id','nombre')
			)
		);
	$this->set('canalCompras', $canal_compras);
	$canal_compras_divisa = $this->Contrato->CanalCompra->find('all');
	$this->set('canal_compras_divisa', $canal_compras_divisa);
	//En la vista se muestra la lista de todos los embalajes existentes
	$embalajes = $this->Contrato->ContratoEmbalaje->Embalaje->find('all', array(
	    'order' => array('Embalaje.nombre' => 'asc')
	    )
	);
	$this->set('embalajes', $embalajes);
	//El tipo de fecha: embarque o entrega
	$this->set(
	    'tipos_fecha_transporte',
	    array(
		'0'=>'embarque',
		'1'=>'entrega'
	    )
	);
	//la fecha de transporte (embarque o entrega)
	$this->set('si_entrega', $contrato['Contrato']['si_entrega']);

	if($this->request->is('get')) { //pantalla de modificación
	    $this->request->data = $this->Contrato->read();
	    //algo de magia con los arrays de embalaje
	    foreach($contrato['ContratoEmbalaje'] as $embalaje) {
		$this->request->data['Embalaje'][$embalaje['embalaje_id']]['cantidad_embalaje'] = $embalaje['cantidad_embalaje'];
		$this->request->data['Embalaje'][$embalaje['embalaje_id']]['peso_embalaje_real'] = $embalaje['peso_embalaje_real'];
	    }
	} else { //después de pulsar 'Guardar'
	    //Hay que meter un dia si no queremos que mysql meta una fecha NULL
	    //lo suyo seria tener 0, pero el cakephp parece que no quiere
	    $this->request->data['Contrato']['posicion_bolsa']['day'] = 1;
	    //si se ha cambiado el canalCompra a uno sin diferencial,
	    //hay que borrar el diferencial que existía antes
	    $canal_compra = $this->Contrato->CanalCompra->findById($this->request->data['Contrato']['canal_compra_id']);
	    if (!$canal_compra['CanalCompra']['si_diferencial']) $this->request->data['Contrato']['diferencial'] = 0;
	    if ($this->Contrato->save($this->request->data)) {
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
		$this->Flash->set('Contrato '.$this->request->data['Contrato']['referencia'].' modificada con éxito');
		$this->redirect(array(
		    'action' => 'view',
		    $id
		    )
		);
	    } else {
		$this->Flash->set('Contrato NO guardado');
	    }
	}
    }

    public function copy($id = null) {
		//para duplicar un registro, se hace una copia del mismo con
		//los registros relacionados en otras tablas, teniendo cuidado
		//de usar una clave primaria nueva (id) y se hace un redirect
		//al edit del nuevo registro para poder modificar los campos
		//que lo necesitan (entre otros la referencia que es UNIQUE)

		if (!$id) {
			$this->Flash->set('URL mal formado');
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

		//recuperar las operaciones asociadas al contrato
		$operaciones = $this->Contrato->Operacion->find('all', array(
			'conditions' => array('Operacion.contrato_id' => $id)
			)
		);
		//y copiarlas con el id del nuevo contrato y una nueva referencia
		$i = 1; //hay que incrementar cada referencia de operacion
		foreach ($operaciones as $operacion) {
			$id_operacion_copiada = $operacion['Operacion']['id'];
			unset($operacion['Operacion']['id']);
			unset($operacion['Operacion']['created']);
			unset($operacion['Operacion']['modified']);
			$operacion['Operacion']['contrato_id'] = $this->Contrato->id;
			$operacion['Operacion']['referencia'] .= '###'.$i;
			$this->Contrato->Operacion->create();
			$this->Contrato->Operacion->save($operacion);
			$asociado_operaciones = $this->Contrato->Operacion->AsociadoOperacion->find('all', array(
				'conditions' => array('AsociadoOperacion.operacion_id' => $id_operacion_copiada)
				)
			);
			//después de crear la operacion, hay que meterle los repartos de asociados
			foreach ($asociado_operaciones as $asociado_operacion){
				$asociado_operacion['AsociadoOperacion']['operacion_id'] = $this->Contrato->Operacion->id;
				unset ($asociado_operacion['AsociadoOperacion']['id']);
				unset ($asociado_operacion['AsociadoOperacion']['created']);
				unset ($asociado_operacion['AsociadoOperacion']['modified']);
				$this->Contrato->Operacion->AsociadoOperacion->create();
				$this->Contrato->Operacion->AsociadoOperacion->save($asociado_operacion);
			}
			$i++;
		}

		//vamos al edit del nuevo contrato creado para poder modificar
		//datos como la referencia o la fecha de fijacion
		$this->redirect(array(
			'action'=>'edit',
			$this->Contrato->id
			)
		);
	}

    public function delete($id = null) {
        if (!$id or $this->request->is('get')){
            throw new MethodNotAllowedException('URL mal formada o incompleta');
        }
        if ($this->Contrato->delete($id)) {
            $this->Flash->set('Contrato borrado');
            $this->History->Back(-1);
        } else {
            $this->Flash->set('El contrato NO se ha borrado');
            $this->History->Back(0);
        }
//        try { $this->Contrato->delete($id);
//        } catch (ForeignKey $e) {
//            echo 'Error en base de datos: ', $e->getMessage(), "\n";
//            $this->History->Back(0);
//        } finally {
//            $this->Flash->set('Contrato borrado');
//        }
    }
}
?>
