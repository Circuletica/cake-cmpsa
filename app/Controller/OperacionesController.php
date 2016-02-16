<?php
class OperacionesController extends AppController {

    public function index() {

	$this->paginate['order'] = array('Operacion.referencia' => 'asc');
	$this->paginate['recursive'] = 2;
	$this->paginate['contain'] = array(
	    'Contrato',
	    'PesoOperacion',
	    'Proveedor',
	    'CalidadNombre'
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

	//Si queremos un titulo con los criterios de busqueda
	$titulo = array();

	//filtramos por referencia
	if(isset($this->passedArgs['Search.referencia'])) {
	    $criterio = $this->passedArgs['Search.referencia'];
	    $this->paginate['conditions']['Operacion.referencia LIKE'] = "%$criterio%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['referencia'] = $criterio;
	    //completamos el titulo
	    $title[] = 'Referencia: '.$criterio;
	}

	//filtramos por contrato
	if(isset($this->passedArgs['Search.contrato_referencia'])) {
	    $criterio = $this->passedArgs['Search.contrato_referencia'];
	    $this->paginate['conditions']['Contrato.referencia LIKE'] = "%$criterio%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['contrato_referencia'] = $criterio;
	    //completamos el titulo
	    $title[] = 'Contrato: '.$criterio;
	}

	//filtramos por calidad
	if(isset($this->passedArgs['Search.calidad'])) {
	    $criterio = $this->passedArgs['Search.calidad'];
	    $this->paginate['conditions']['CalidadNombre.nombre LIKE'] = "%$criterio%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['calidad'] = $criterio;
	    //completamos el titulo
	    $title[] ='Calidad: '.$criterio;
	}

	//filtramos por proveedor
	if(isset($this->passedArgs['Search.proveedor_id'])) {
	    $criterio = $this->passedArgs['Search.proveedor_id'];
	    $this->paginate['conditions']['Proveedor.id LIKE'] = "$criterio";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['proveedor_id'] = $criterio;
	    //completamos el titulo
	    $title[] ='Proveedor: '.$proveedores[$criterio];
	}

	$this->Operacion->bindModel(
	    array(
		'belongsTo' => array(
		    'CalidadNombre' => array(
			'foreignKey' => false,
			'conditions' => array('Contrato.calidad_id = CalidadNombre.id')
		    ),
		    'Proveedor' => array(
			'className' => 'Empresa',
			'foreignKey' => false,
			'conditions' => array('Proveedor.id = Contrato.proveedor_id')
		    )
		)
	    )
	);
	$operaciones = $this->paginate();
	//pasamos los datos a la vista
	$this->set(compact('operaciones','title'));
    }

    public function add() {
	//el id y la clase de la entidad de origen vienen en la URL
	if (!$this->params['named']['from_id']) {
	    $this->Session->setFlash('URL mal formado operaciones/add '.$this->params['named']['from_controller']);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => 'index')
	    );
	}
	$contrato_id = $this->params['named']['from_id'];
	$this->loadModel('Asociado');
	$asociados = $this->Asociado->find(
	    'all',
	    array(
			'fields' => array(
				'Asociado.id',
		    	'Empresa.codigo_contable',
				'Empresa.nombre_corto'
				),
		'order' => array(
	    	'Empresa.codigo_contable' => 'ASC'
	    	),
		'recursive' => 1
	    )
	);	
	//reindexamos los asociados por codigo contable
	$asociados = Hash::combine($asociados, '{n}.Empresa.codigo_contable', '{n}');
	ksort($asociados);
	$this->set('asociados', $asociados);

	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$this->loadModel('Proveedor');
	$proveedores = $this->Proveedor->find(
	    'list',
	    array(
		'fields' => array(
			'Proveedor.id',
			'Empresa.nombre_corto'),
		'order' => array(
			'Empresa.nombre_corto' => 'asc'),
		'recursive' => 1
	    )
	);
	$this->set('proveedores',$proveedores);

	//sacamos los datos del contrato al que pertenece la linea
	//nos sirven en la vista para detallar campos
	$contrato = $this->Operacion->Contrato->find('first', array(
	    'conditions' => array('Contrato.id' => $contrato_id),
	    'recursive' => 2,
	    'fields' => array(
		'Contrato.id',
		'Contrato.referencia',
		'Contrato.proveedor_id',
		'Contrato.peso_comprado',
		'Contrato.puerto_carga_id',
		'Contrato.puerto_destino_id',
		'CanalCompra.nombre',
		'CanalCompra.divisa',
		'Incoterm.nombre',
		'Incoterm.si_flete',
		'Incoterm.si_seguro',
		'CalidadNombre.nombre')
	    ));
	$this->set('contrato',$contrato);
	$this->set('puerto_carga_contrato_id', $contrato['Contrato']['puerto_carga_id']);
	$this->set('puerto_destino_contrato_id', $contrato['Contrato']['puerto_destino_id']);
	$this->set('divisa', $contrato['CanalCompra']['divisa']);
	$embalajes_contrato = $this->Operacion->Contrato->ContratoEmbalaje->find('all', array(
	    'conditions' => array(
		'ContratoEmbalaje.contrato_id' => $contrato_id
	    ),
	    'fields' => array(
		'Embalaje.id',
		'Embalaje.nombre',
		'ContratoEmbalaje.cantidad_embalaje',
		'ContratoEmbalaje.peso_embalaje_real'
	    )
	)
    );
	//hace falta para el desplegable de 'Embalaje'
	//recombinamos el array anterior que quedaba asi:
	//Array
	//  (
	//    [0] => Array
	//      id => 2
	//      nombre => big bag
	//    [1] => Array
	//      id => 1
	//      nombre => saco 60kg
	//y se transforma así
	//Array
	//  (
	//    [2] => big bag
	//    [1] => saco 60kg
	$embalajes = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.Embalaje.nombre');
	$this->set('embalajes', $embalajes);
	$embalajes_nombre = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.Embalaje');
	$embalajes_peso = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.ContratoEmbalaje');
	//sumamos los distintos arrays de mismo index para llegar a esto:
	//Array
	//  (
	//    [2] =>Array
	//      id => 2
	//      nombre => big bag
	//      cantidad_embalaje => 60
	//      peso_embalaje_real => 60
	//    [1] => ...
	$embalajes_completo = array_replace_recursive($embalajes_nombre,$embalajes_peso);
	$this->set('embalajes_completo', $embalajes_completo);
	//solo para mostrar el proveedor a nivel informativo
	$this->set('proveedor',$contrato['Proveedor']['nombre']);
	//a quienes van asociadas las lineas de contrato




	//para los puertos de carga y destino
	$this->set('puertoCargas',$this->Operacion->PuertoCarga->find('list', array(
	    'order' => array('PuertoCarga.nombre' =>'ASC')
	)
    ));

	$this->set('puertoDestinos',$this->Operacion->PuertoDestino->find(
	    'list',
	    #el café solo llega a puerto españoles
	    array(
		'contain' => array('Pais'),
		'conditions' => array( 'Pais.nombre' => 'España')
	    )
	));
	//Por defecto ponemos las opciones, el forfait, el seguro y el flete a cero
	$this->request->data['Operacion']['opciones'] = 0;
	$this->request->data['Operacion']['forfait'] = 0;
	$this->request->data['Operacion']['seguro'] = 0;
	$this->request->data['Operacion']['flete'] = 0;

	//Queremos la lista de costes de fletes
	$precio_fletes = $this->Operacion->Contrato->PrecioFleteContrato->find('all', array(
	    'recursive' => 3,
	    'contain' => array(
		'Flete' => array(
		    'PuertoCarga' => array(
			'fields' => array(
			    'nombre'
			)
		    ),
		    'PuertoDestino' => array(
			'fields' => array(
			    'nombre'
			)
		    ),
		    'Naviera' => array(
			'fields' => array(
			    'nombre_corto'
			)
		    ),
		    'Embalaje' => array(
			'fields' => array(
			    'nombre'
			)
		    )
		)
	    ),
	    'conditions' => array(
		'PrecioFleteContrato.contrato_id' => $contrato_id,
		//'PrecioFleteContrato.precio_flete is not null'
	    )
	));
	//el desplegable con los costes de flete según los puertos de
	//carga/destino asociados con el contrato.
	//Tenemos que hacer un array con name =>, value => para poder
	//usar el mismo valor para varias opciones del select.
	//Con un array simple no funciona, no se puede usar la misma clave
	//varias veces. 
	foreach($precio_fletes as $precio_flete) {
	    $fletes[] = array( 
		'name' => $precio_flete['Flete']['Naviera']['nombre_corto'].'('
		.$precio_flete['Flete']['PuertoCarga']['nombre'].'-'
		.$precio_flete['Flete']['PuertoDestino']['nombre'].')-'
		.(!empty($precio_flete['Flete']['Embalaje']) ? $precio_flete['Flete']['Embalaje']['nombre'] : '??').'-'
		.($precio_flete['PrecioFleteContrato']['precio_flete'] ?: '??').'$/Tm',
		'value' => $precio_flete['PrecioFleteContrato']['precio_flete'] ?: ''
	    );
	}
	$this->set(compact('fletes'));

	if($this->request->is('post')) {
	    //al guardar la linea, se incluye a qué contrato pertenece
	    $this->request->data['Operacion']['contrato_id'] = $contrato_id;
	    //primero guardamos los datos de Operacion
	    if($this->Operacion->save($this->request->data)){
		//luego las cantidades de cada asociado en AsociadoOperacion
		foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
		    if ($cantidad != NULL) {
			$this->request->data['AsociadoOperacion']['operacion_id'] = $this->Operacion->id;
			$this->request->data['AsociadoOperacion']['asociado_id'] = $asociado_id;
			$this->request->data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
			//$cantidad_embalaje_operacion += $cantidad;
			if (!$this->Operacion->AsociadoOperacion->saveAll($this->request->data['AsociadoOperacion']))
			    throw New Exception('error en guardar AsociadoOperacion');
		    }
		}
		//falta aquí guardar el peso total de la linea de contrato
		//y el tipo de embalaje
		//.....
		$this->Session->setFlash('Linea de Contrato guardada');
		//volvemos al contrato a la que pertenece la linea creada
		$this->redirect(array(
		    'controller' => $this->params['named']['from_controller'],
		    'action' => 'view',
		    $contrato_id));
	    } else {
		$this->Session->setFlash('Operación NO guardada');
	    }
	}
    }

    public function edit($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Operacion->id = $id;
	$this->loadModel('Asociado');
	$asociados = $this->Asociado->find(
	    'all',
	    array(
		'fields' => array(
		    'Asociado.id',
		    'Empresa.codigo_contable',
		    'Empresa.nombre_corto'
		),
		'order' => array('Empresa.codigo_contable' => 'asc'),
		'recursive' => 1
	    )
	);
	$operacion = $this->Operacion->find(
	    'first',
	    array(
		'conditions' => array('Operacion.id' => $id),
		'recursive' => 3
	    )
	);
	$this->set('operacion', $operacion);
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
	//para el js de la view
	$this->set('pesoEmbalaje', $embalaje['ContratoEmbalaje']['peso_embalaje_real']);
	//para los puertos de carga y destino
	$this->set('puertoCargas',$this->Operacion->PuertoCarga->find('list', array(
	    'order' => array('PuertoCarga.nombre' =>'ASC')
	)
    ));
	$this->set('puertoDestinos',$this->Operacion->PuertoDestino->find(
	    'list',
	    #el café solo llega a puerto españoles
	    array(
		'contain' => array('Pais'),
		'conditions' => array( 'Pais.nombre' => 'España')
	    )
	));

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
	$this->set('referencia', $operacion['Operacion']['referencia']);
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
	$this->set('tipo_fecha_transporte', $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
	$this->set('fecha_transporte', $operacion['Contrato']['fecha_transporte']);	
	//$this->set('fecha_carga', $transporte['Transporte']['fecha_carga']);

	//Líneas de reparto
	foreach ($operacion['AsociadoOperacion'] as $linea) {
	    $peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
	    $codigo = substr($linea['Asociado']['codigo_contable'],-2);
	    $lineas_reparto[] = array(
		'Código' => $codigo,
		'Nombre' => $linea['Asociado']['nombre_corto'],
		'Cantidad' => $linea['cantidad_embalaje_asociado'],
		'Peso' => $peso
	    );	
	}
	$columnas_reparto = array_keys($lineas_reparto[0]);
	//indexamos el array por el codigo de asociado
	$lineas_reparto = Hash::combine($lineas_reparto, '{n}.Código','{n}');
	//se ordena por codigo ascendente
	ksort($lineas_reparto);
	$this->set('columnas_reparto',$columnas_reparto);
	$this->set('lineas_reparto',$lineas_reparto);
	$this->set('fecha_fijacion', $operacion['Operacion']['fecha_pos_fijacion']);
	//comprobamos si ya existe una financiacion para esta operación
	if ($this->Operacion->Financiacion->hasAny(array('Financiacion.id' => $id))) {
	    $this->set('existe_financiacion', 1);
	}
    }

    public function index_trafico() {
	$this->index();
	$this->render('index_trafico');
    }

    public function view_trafico($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formada Operación/view_trafico ');
	    $this->redirect(array('action'=>'index_trafico'));
	}
	$operacion = $this->Operacion->find(
		'first',
		array(
			'conditions' => array(
				'Operacion.id' => $id
				),
	    'recursive' => 2,
	    'contain' => array(
	    	'Transporte'=> array(
	    		'fields' => array(
	    			'id',
	    			'nombre_vehiculo',
	    			'matricula',
	    			'fecha_carga',
	    			'fecha_seguro',
	    			'cantidad_embalaje'
	    			)
	    		),
	    	'Contrato'=>array(
	    		'fields'=> array(
	    			'id',
	    			'referencia',
	    			'si_entrega',
	    			'fecha_transporte'
	    			),
	    		'Proveedor'=>array(
	    			'id',
	    			'nombre_corto'
	    			),
	    		'Incoterm' => array(
	    			'fields'=> array(
						'nombre',
						'si_flete'
				   	)
				),
	    		'CalidadNombre' => array(
	    			'fields' =>(
	    				'nombre'
	    				)
	    			)
	    		),
	    	'PesoOperacion'=> array(
	    		'fields' =>array(
	    			'peso',
	    			'cantidad_embalaje'
	    			)
	    		),
	    	'PrecioTotalOperacion'=> array(
	    		'fields'=>array(
	    			'precio_dolar_tonelada'
	    			)
	    		),
	    	'AsociadoOperacion'=>array(
	    		'Asociado'
	    		)
	    	)
	    )
	);

	$this ->set(compact('operacion'));

	//el nombre de calidad concatenado esta en una view de MSQL
	$this->loadModel('ContratoEmbalaje');
	$embalaje = $this->ContratoEmbalaje->find(
	    'first',
	    array(
		'conditions' => array(
		    'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
		    'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
		),
		'fields' => array('Embalaje.nombre','ContratoEmbalaje.peso_embalaje_real')
	    )
	);

	//Calculo la cantidad de bultos transportados
	if($operacion['Operacion']['id']!= NULL){
	    $suma = 0;
	    $transportado=0;
	    foreach ($operacion['Transporte'] as $suma){
		if ($transporte['operacion_id']=$operacion['Operacion']['id']){
		    $transportado = $transportado + $suma['cantidad_embalaje'];
		}
	    }
	}
	$this->set('transportado',$transportado);

	$this->set('tipo_fecha_transporte', $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
	//mysql almacena la fecha en formato ymd
	//	$this->Date->format($operacion['Contrato']['fecha_transporte']);
	$fecha = $operacion['Contrato']['fecha_transporte'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	$this->set('fecha_transporte', $dia.'-'.$mes.'-'.$anyo);		
	$this->set('embalaje', $embalaje);
	$this->loadModel('CalidadNombre');
	//Línea de transporte
	//	$this->set('tipo_fecha_carga', $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
	//mysql almacena la fecha en formato ymd
	//$fecha = $transporte['Transporte']['fecha_carga'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	$this->set('fecha_carga', $dia.'-'.$mes.'-'.$anyo);

//*****AQUI HACE EXCESO DE QUERIES, HAY QUE DEPURARLO*****
	$operacion_retiradas = $this->Operacion->Retirada->find(
				'all',
				array(
		    		'conditions' => array(
		    			'operacion_id' => $id
		    		)
		    	)
			);	
	//Líneas de reparto
	//		debug($operacion_retiradas);
	$total_sacos = 0;
	$total_peso = 0;
	$total_sacos_retirados = 0;
	$total_peso_retirado = 0;

	foreach ($operacion['AsociadoOperacion'] as $linea):
	    $peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];

	$cantidad_retirado = 0;
	$peso_retirado = 0;

		foreach ($operacion_retiradas as $clave => $operacion_retirada){
			$retirada = $operacion_retirada['Retirada'];
			if($retirada['asociado_id'] == $linea['Asociado']['id']){
				$cantidad_retirado += $retirada['embalaje_retirado'];
				$peso_retirado += $retirada['peso_retirado'];
			}
		}

	$lineas_retirada[] = array(
	   'asociado_id' => $linea['Asociado']['id'],
 	   'Nombre' => $linea['Asociado']['nombre_corto'],
 	   'Cantidad' => $linea['cantidad_embalaje_asociado'],
 	   'Peso' => $peso,
 	   'Cantidad_retirado' => $cantidad_retirado,
 	   'Peso_retirado' => $peso_retirado
		);

	$total_sacos += $linea['cantidad_embalaje_asociado'];
	$total_peso += $peso;
	$total_sacos_retirados += $cantidad_retirado; 
	$total_peso_retirado += $peso_retirado;

endforeach;

ksort($lineas_retirada);
$this->set('lineas_retirada',$lineas_retirada);
$this->set('total_sacos',$total_sacos);
$this->set('total_peso',$total_peso);	
$this->set('total_sacos_retirados',$total_sacos_retirados);
$this->set('total_peso_retirado',$total_peso_retirado);
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) {
	    throw new MethodNotAllowedException();
	}
	if ($this->Operacion->delete($id)) {
	    $this->Session->setFlash('Línea de contrato borrada');
	    $this->redirect(array(
		//'controller' => $this->params['named']['from_controller'],
		'controller' => 'operaciones',
		//'action'=>'view',
		'action'=>'index',
		//$this->params['named']['from_id']
	    ));
	}
    }

    public function generarFinanciacion($id = null) {
	//el id y la clase de la entidad de origen vienen en la URL
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Operacion/generarFinanciacion');
	    $this->redirect(array('action'=>'index'));
	}
	//vamos al add de la nueva financiacion
	$this->request->data['algo'] = 'algo';
	$this->redirect(array(
	    'controller' => 'financiaciones',
	    'from_controller' => 'operaciones',
	    'from_id' => $id,
	    'action' => 'add'
	)
    );
    }
}
?>
