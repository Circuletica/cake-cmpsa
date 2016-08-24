<?php
class OperacionesController extends AppController {

	public function index() {
		$this->set('action', $this->action);	//Se usa para tener la misma vista

		$this->Operacion->virtualFields['calidad']=$this->Operacion->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['order'] = array('Operacion.referencia' => 'asc');
		$this->paginate['recursive'] = 2;
		$this->paginate['contain'] = array(
			'Contrato' =>array(
				'fields' => array(
					'referencia',
					'fecha_transporte',
					'si_entrega'
				)
			),
			'PesoOperacion',
			'Proveedor',
			'Calidad'
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

		$titulo = $this->filtroPaginador(
			array(
				'Operacion' =>array(
					'Referencia' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => ''
					),
					'Calidad' => array(
						'columna' => 'calidad',
						'exacto' => false,
						'lista' => ''
					)
				),
				'Contrato' => array(
					'Proveedor' => array(
						'columna' => 'proveedor_id',
						'exacto' => true,
						'lista' => $proveedores
					)
				)
			)
		);

		//filtramos por contrato
		if(isset($this->passedArgs['Search.contrato_referencia'])) {
			$criterio = strtr($this->passedArgs['Search.contrato_referencia'],'_','/');
			$this->paginate['conditions']['Contrato.referencia LIKE'] = "%$criterio%";
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['contrato_referencia'] = $criterio;
			//completamos el titulo
			$title[] = 'Contrato: '.$criterio;
		}

		$this->Operacion->bindModel(
			array(
				'belongsTo' => array(
					'Calidad' => array(
						'foreignKey' => false,
						'conditions' => array('Contrato.calidad_id = Calidad.id')
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


	public function edit($id = null) {
		$this->checkId($id);
		$this->Operacion->id = $id;
		$this->loadModel('Asociado');
		$asociados = $this->Asociado->find(
			'all',
			array(
				'contain' => array(
					'Empresa'
				),
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
				'recursive' => 3,
				'contain' => array(
					'Contrato' => array(
						'fields'  => array(
							'id',
							'referencia',
							'proveedor_id',
							'peso_comprado',
							'puerto_carga_id',
							'puerto_destino_id',
						),
						'Calidad',
						'CanalCompra' => array(
							'fields' => array(
								'nombre',
								'divisa'
							)
						),
						'ContratoEmbalaje' =>array(
							'fields' => array(
								'cantidad_embalaje',
								'peso_embalaje_real'
							),
							'Embalaje' =>array(
								'fields' =>array(
									'id',
									'nombre'
								)
							)
						),
						'Incoterm' => array(
							'fields' => array(
								'nombre',
								'si_flete',
								'si_seguro'
							)
						),
						'Proveedor' => array(
							'fields' => array(
								'nombre_corto'
							)
						),
						'RestoContrato',
						'RestoLotesContrato'
					),
					'Embalaje',
					'AsociadoOperacion'
				)
			)
		);
		$contrato_id =  $operacion['Operacion']['contrato_id'];
		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos

		$contrato = $operacion['Contrato'];

		$this->set('operacion', $operacion);
		$this->set('contrato', $contrato);

		//reindexamos los asociados por codigo contable
		$asociados = Hash::combine($asociados, '{n}.Empresa.codigo_contable', '{n}');
		ksort($asociados);
		$this->set('asociados', $asociados);
		$this->set('divisa', $contrato['CanalCompra']['divisa']);
		$this->set('puerto_carga_contrato_id', $contrato['puerto_carga_id']);
		$this->set('puerto_destino_contrato_id', $contrato['puerto_destino_id']);

		//los que ya tienen embalajes en la operacion
		//queremos el id del socio como index del array
		$asociados_operacion = Hash::combine($operacion['AsociadoOperacion'], '{n}.asociado_id', '{n}');
		$this->set('asociados_operacion', $asociados_operacion);
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
		$embalajes = Hash::combine($contrato['ContratoEmbalaje'], '{n}.Embalaje.id', '{n}.Embalaje.nombre');
		$embalajes_nombre = Hash::combine($contrato['ContratoEmbalaje'], '{n}.Embalaje.id', '{n}.Embalaje');
		$embalajes_peso = Hash::combine($contrato['ContratoEmbalaje'], '{n}.Embalaje.id', '{n}');
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
		$this->set('embalajes', $embalajes);
		$this->set('embalajes_completo', $embalajes_completo);
		$peso_embalaje_real = $embalajes_completo[$operacion['Embalaje']['id']]['peso_embalaje_real'];
		$this->set(compact('peso_embalaje_real'));
		//solo para mostrar el proveedor a nivel informativo
		$this->set('proveedor',$contrato['Proveedor']['nombre_corto']);
		//a quienes van asociadas las lineas de contrato
		//para los puertos de carga y destino
		$this->set(
			'puertoCargas',
			$this->Operacion->PuertoCarga->find(
				'list',
				array(
					'order' => array('PuertoCarga.nombre' =>'ASC')
				)
			)
		);
		$this->set(
			'puertoDestinos',
			$this->Operacion->PuertoDestino->find(
				'list',
				#el café solo llega a puerto españoles
				array(
					'contain' => array('Pais'),
					'conditions' => array( 'Pais.nombre' => 'España')
				)
			)
		);

		$this->set('proveedor',$contrato['Proveedor']['nombre_corto']);

		if($this->request->is('get')){ //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->Operacion->read();
			foreach ($asociados_operacion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['cantidad_embalaje_asociado'];
			}
		} else {
			if ($this->Operacion->save($this->request->data)){
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
				$this->Flash->success(
					'Operacion '.
					$this->request->data['Operacion']['referencia'].
					' modificada con éxito'
				);
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error('Operacion NO guardada');
			}
		}
		//	$this->set('action', $this->action);
		//	$this->render('form');
	}

	//// AQUI EMPIEZA EL FORM ()

	public function add() {
		if (!isset($this->params['named']['from_id'])) {
			$this->Flash->error('URL mal formado operaciones/add '.$this->params['named']['from_controller']);
			//$this->redirect(array(
			//    'controller' => $this->params['named']['from_controller'],
			//    'action' => 'index')
			//);
			$this->History->Back(0);
		}
		$this->form();
		$this->render('form');
	}

	public function form($id=null) {
		$this->set('action', $this->action);

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

		//Sacamos el valor de la operación si es un ADD
		if (empty($this->params['named']['from_id'])){
			$operacion = $this->Operacion->find(
				'first',
				array(
					'conditions' =>array(
						'Operacion.id' => $id
					),
					'fields' => array(
						'contrato_id',
					)
				)
			);
			$contrato_id =  $operacion['Operacion']['contrato_id'];
		}else{
			$contrato_id = $this->params['named']['from_id'];
		}

		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$this->Operacion->Contrato->virtualFields['calidad']=$this->Operacion->Contrato->Calidad->virtualFields['nombre'];

		$contrato = $this->Operacion->Contrato->find(
			'first',
			array(
				'conditions' => array('Contrato.id' => $contrato_id),
				'recursive' => 2,
				'contain' => array(
					'Calidad',
					'CanalCompra',
					'FleteContrato',
					'Incoterm',
					'Proveedor',
					'RestoContrato',
					'RestoLotesContrato'
				),
				'fields' => array(
					'Contrato.id',
					'Contrato.referencia',
					'Contrato.proveedor_id',
					'Contrato.peso_comprado',
					'Contrato.diferencial',
					'Contrato.puerto_carga_id',
					'Contrato.puerto_destino_id',
					'Contrato.calidad',
					'CanalCompra.nombre',
					'CanalCompra.divisa',
					'Incoterm.nombre',
					'Incoterm.si_flete',
					'Incoterm.si_seguro',
					'Proveedor.nombre_corto'
				)
			)
		);

		$this->set('contrato',$contrato);
		$this->set('puerto_carga_contrato_id', $contrato['Contrato']['puerto_carga_id']);
		$this->set('puerto_destino_contrato_id', $contrato['Contrato']['puerto_destino_id']);
		$this->set('divisa', $contrato['CanalCompra']['divisa']);
		$embalajes_contrato = $this->Operacion->Contrato->ContratoEmbalaje->find(
			'all',
			array(
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
		$this->set('proveedor',$contrato['Proveedor']['nombre_corto']);
		//a quienes van asociadas las lineas de contrato
		//para los puertos de carga y destino
		$this->set('puertoCargas',$this->Operacion->PuertoCarga->find(
			'list',
			array(
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
		//$precio_fletes = $this->Operacion->Contrato->PrecioFleteContrato->find(
		$precio_fletes = $this->Operacion->Contrato->FleteContrato->find(
			'all',
			array(
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
					'FleteContrato.contrato_id' => $contrato_id,
				)
			)
		);
		//el desplegable con los costes de flete según los puertos de
		//carga/destino asociados con el contrato.
		//Tenemos que hacer un array con name =>, value => para poder
		//usar el mismo valor para varias opciones del select.
		//Con un array simple no funciona, no se puede usar la misma clave
		//varias veces.
		//si $precio_fletes == null evitar acabar con una variable null en el form.ctp
		$fletes = array();
		foreach($precio_fletes as &$precio_flete) { //usar &$ para que funcione el unset
			$fletes[] = array(
				'name' => $precio_flete['Flete']['Naviera']['nombre_corto'].'('
				.$precio_flete['Flete']['PuertoCarga']['nombre'].'-'
				.$precio_flete['Flete']['PuertoDestino']['nombre'].')-'
				.(!empty($precio_flete['Flete']['Embalaje']) ? $precio_flete['Flete']['Embalaje']['nombre'] : '??').'-'
				.($precio_flete['FleteContrato']['precio_flete'] ?: '??').'$/Tm',
				'value' => $precio_flete['FleteContrato']['precio_flete'] ?: ''
			);
			//vamos a tener otro array para un js que modifique la lista de fletes disponibles
			//segun se elija uno u otro puerto embarque/puerto destino/embalaje
			//$precio_flete['Flete']['value']=$precio_flete['PrecioFleteContrato']['precio_flete'];
			$precio_flete['Flete']['value']=$precio_flete['FleteContrato']['precio_flete'];
			$precio_flete['Flete']['name']=end($fletes)['name'];
			unset($precio_flete['Flete']['Naviera']);
			unset($precio_flete['Flete']['PuertoCarga']);
			unset($precio_flete['Flete']['PuertoDestino']);
			unset($precio_flete['Flete']['Embalaje']);
			unset($precio_flete['FleteContrato']);
		}
		$this->set(compact('fletes'));
		$this->set(compact('precio_fletes'));

		if (!empty($id))$this->Operacion->id = $id;


		if ($this->request->is('post')) {//ES UN POST
			$data = &$this->request->data;
			//al guardar la linea, se incluye a qué contrato pertenece
			$this->request->data['Operacion']['contrato_id'] = $contrato_id;
			if($id == NULL){
				//primero guardamos los datos de Operacion
				if($this->Operacion->save($this->request->data)){
					//luego las cantidades de cada asociado en AsociadoOperacion
					foreach ($data['CantidadAsociado'] as $asociado_id => $cantidad) {
						if ($cantidad != NULL) {
							$data['AsociadoOperacion']['operacion_id'] = $this->Operacion->id;
							$data['AsociadoOperacion']['asociado_id'] = $asociado_id;
							$data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
							if (!$this->Operacion->AsociadoOperacion->saveAll($data['AsociadoOperacion']))
								throw New Exception('error en guardar AsociadoOperacion');
						}
					}
					//falta aquí guardar el peso total de la linea de contrato
					//y el tipo de embalaje
					//.....
					$this->Flash->success('Operación guardada');
					//volvemos al contrato a la que pertenece la linea creada
					$this->redirect(array(
						//'controller' => 'contratos',
						'controller' => 'operaciones',
						'action' => 'view',
						//$contrato_id
						$this->Operacion->id
					));
				}else{
					$this->Flash->error('Operación NO guardada');
				}
			}else{
			/*	if($this->Operacion->save($this->request->data)){
					$this->Flash->success('Operación modificada');
					$this->redirect(array(
						'controller' => 'operaciones',
						'action' => 'view',
						$id
						)
					);
			}*/
			}
		}else{//es un GET
			$this->request->data = $this->Operacion->read(null, $id);
		}
	}

	public function view($id = null) {
		$this->checkId($id);
		$this->set('action', $this->action);	//Se usa para tener la misma info

		$operacion = $this->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 3,
				'contain' => array(
					'PuertoCarga',
					'PuertoDestino',
					'Contrato' => array(
						'Proveedor',
						'Incoterm',
						'CanalCompra',
						'Calidad'
					),
					'AsociadoOperacion' => array(
						'Asociado'
					),
					'PesoOperacion',
					'PrecioTotalOperacion'
				)
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

		//Líneas de reparto
		if (!empty($operacion['AsociadoOperacion'])) {
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
		}

		$this->set('fecha_fijacion', $operacion['Operacion']['fecha_pos_fijacion']);
		//comprobamos si ya existe una financiacion para esta operación
		if ($this->Operacion->Financiacion->hasAny(array('Financiacion.id' => $id))) {
			$this->set('existe_financiacion', 1);
		}
		//comprobamos si ya existe una facturación para esta operación
		if ($this->Operacion->Facturacion->hasAny(array('Facturacion.id' => $id))) {
			$this->set('existe_facturacion', 1);
		}
		//Se declara para acceder al PDF
		$this->set(compact('id'));

	}

	public function index_trafico() {
		$this->index();
		$this->set('action', $this->action);
		$this->render('index');
	}

	public function view_trafico($id = null){
		$this->checkId($id);
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
							'cantidad_embalaje',
							'linea'
						)
					),
					'Contrato'=>array(
						'fields'=> array(
							'id',
							'referencia',
							'si_entrega',
							'fecha_transporte',
							'si_muestra_emb_aprob',
							'si_muestra_entr_aprob'
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
						'Calidad' => array(
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
							'precio_divisa_tonelada',
							'divisa'
						)
					),
					'AsociadoOperacion'=>array(
						'Asociado'
					)
				)

			)
		);

		$this ->set(compact('operacion'));
		//Controlo la posibilidad de agregar retiradas unicamente si hay cuentas de almacen.
		$cuentas_almacenes = $this->Operacion->Transporte->AlmacenTransporte->find(
			'all',
			array(
				'conditions' => array(
					'Transporte.operacion_id' => $id
				),
				//'recursive' => 2,
				'fields' => array(
					'id',
					'cuenta_almacen',
					'cantidad_cuenta'
				)
			)
		);
		$cuentas_almacenes = Hash::combine($cuentas_almacenes, '{n}.AlmacenTransporte.id', '{n}');

		/*if(empty($cuentas_almacenes[0]['AlmacenTransporte']['id'])){
			$cuentas_almacenes = 'NULL';
		}*/
		$this->set(compact('cuentas_almacenes'));

		//el nombre de calidad concatenado esta en una view de MSQL
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
				),
				'fields' => array(
					'Embalaje.nombre',
					'ContratoEmbalaje.peso_embalaje_real'
				)
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
		$restan = $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado;
		$this->set(compact('transportado'));
		$this->set(compact('restan'));

		$this->set('tipo_fecha_transporte', $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
		//mysql almacena la fecha en formato ymd
		//	$this->Date->format($operacion['Contrato']['fecha_transporte']);
		$fecha = $operacion['Contrato']['fecha_transporte'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$this->set('fecha_transporte', $dia.'-'.$mes.'-'.$anyo);
		$this->set('embalaje', $embalaje);
		$this->loadModel('Calidad');
		//mysql almacena la fecha en formato ymd
		//$fecha = $transporte['Transporte']['fecha_carga'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$this->set('fecha_carga', $dia.'-'.$mes.'-'.$anyo);

		$operacion_retiradas = $this->Operacion->Retirada->find(
			'all',
			array(
				'recursive'=>1,
				'conditions' => array(
					'operacion_id' => $id
				),
				'contain'=>array(
					'Asociado'=>array(
						'fields'=>array(
							'id',
							'nombre_corto'
						)
					)
				)
			)
		);

	//Calculamos la cantidad de sacos asignados por asociado en el total de las cuentas de la operacion_id
/*	foreach ($cuentas_almacenes as $almacen_transporte_id => $cuenta_almacen){//Recorro el array
		if($almacen_transporte_id == $sacos_asignados['AlmacenTransporteAsociado']['almacen_transporte_id']){
				foreach()
		}
	}*/



		//ahora el precio que facturamos por asociado
/*  MIRAR ATENTAMENTE PARA CAMBIAR EL CóDIGO POR ESTO SOLO
	   $this->loadModel('PesoFacturacion');
	$peso_asociados = $this->PesoFacturacion->find(
		'all',
		array(
		'conditions' => array(
			'operacion_id' => $id
		)
		)
	);
	$this->set(compact('peso_asociados'));
	$this->PesoFacturacion->virtualFields = array(
		'total_peso_retirado' => 'sum(total_peso_retirado)',
		'total_sacos_pendientes' => 'sum(sacos_pendientes)',
		'total_peso_pendiente' => 'sum(peso_pendiente)',
		'total_peso_total' => 'sum(peso_total)'
	);
	$totales = $this->PesoFacturacion->find(
		'first',
		array(
		'conditions' => array(
			'PesoFacturacion.operacion_id' => $id
		)
		)
	);
$this->set('totales',$totales['PesoFacturacion']);-*/

		$total_sacos = 0;
		$total_peso = 0;
		$total_sacos_retirados = 0;
		$total_peso_retirado = 0;
		$total_pendiente = 0;

		foreach ($operacion['AsociadoOperacion'] as $linea) {
			$peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];

			$cantidad_retirado = 0;
			$peso_retirado = 0;
			$pendiente = $linea['cantidad_embalaje_asociado'];
			$asociados_error=0;

			foreach ($operacion_retiradas as $clave => $operacion_retirada){
				$retirada = $operacion_retirada['Retirada'];
				if($retirada['asociado_id'] == $linea['Asociado']['id']){
					$cantidad_retirado += $retirada['embalaje_retirado'];
					$peso_retirado += $retirada['peso_retirado'];
				}
				$pendiente = $linea['cantidad_embalaje_asociado'] - $cantidad_retirado;
			}

			$lineas_retirada[] = array(
				'asociado_id' => $linea['Asociado']['id'],
				'Nombre' => $linea['Asociado']['nombre_corto'],
				'Cantidad' => $linea['cantidad_embalaje_asociado'],
				'Peso' => $peso,
				'Cantidad_retirado' => $cantidad_retirado,
				'Peso_retirado' => $peso_retirado,
				'Pendiente' => $pendiente
			);

			$total_sacos += $linea['cantidad_embalaje_asociado'];
			$total_peso += $peso;
			$total_sacos_retirados += $cantidad_retirado;
			$total_peso_retirado += $peso_retirado;
			$total_pendiente += $pendiente;
		}

		ksort($lineas_retirada);
		$this->set('lineas_retirada',$lineas_retirada);
		$this->set('total_sacos',$total_sacos);
		$this->set('total_peso',$total_peso);
		$this->set('total_sacos_retirados',$total_sacos_retirados);
		$this->set('total_peso_retirado',$total_peso_retirado);
		$this->set('total_pendiente',$total_pendiente);


		//$this->set(compact('asociados_error'));
		$this->set(compact('operacion_retiradas'));

		//Se declara para acceder al PDF
		$this->set(compact('id'));
	}

	//	public function delete($id = null) {
	//		if (!$id or $this->request->is('get')) {
	//			throw new MethodNotAllowedException();
	//		}
	//		if ($this->Operacion->delete($id)) {
	//			$this->Flash->success('Línea de contrato borrada');
	//			$this->History->back(-1);
	//		}
	//	}

	public function generarFinanciacion($id = null) {
		$this->checkId($id);
		//vamos al add de la nueva financiacion
		$this->redirect(
			array(
				'controller' => 'financiaciones',
				'from_controller' => 'operaciones',
				'from_id' => $id,
				'action' => 'add'
			)
		);

	}

	public function generarFacturacion($id = null) {
		$this->checkId($id);
		//vamos al add de la nueva facturación
		$this->redirect(
			array(
				'controller' => 'facturaciones',
				'from_controller' => 'operaciones',
				'from_id' => $id,
				'action' => 'add'
			)
		);
	}

	public function export() {
		$this->set(
			'operaciones',
			$this->Operacion->find(
				'all',
				array(
					'recursive' => 1,
					'fields' => array(
						'id',
						'referencia'
					)
				)
			)
		);
		$this->layout = null;
		$this->autoLayout = false;
		Configure::write('debug', '0');
		$this->response->download("export".date('Ymd').".csv");
	}

	public function index_pdf() {
		$this->Operacion->virtualFields['calidad']=$this->Operacion->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['order'] = array('Operacion.referencia' => 'asc');
		$this->paginate['limit'] = 100; //Muestra al cantidad de registros por pantalla, así como se podrá ver en el pdf
		$this->paginate['recursive'] = 2;
		$this->paginate['contain'] = array(
			'Contrato' =>array(
				'fields' => array(
					'referencia',
					'fecha_transporte',
					'si_entrega'
				)
			),
			'PesoOperacion',
			'Proveedor',
			'Calidad'
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

		$titulo = $this->filtroPaginador(
			array(
				'Operacion' =>array(
					'Referencia' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => ''
					),
					'Calidad' => array(
						'columna' => 'calidad',
						'exacto' => false,
						'lista' => ''
					)
				),
				'Contrato' => array(
					'Proveedor' => array(
						'columna' => 'proveedor_id',
						'exacto' => true,
						'lista' => $proveedores
					)
				)
			)
		);

		//filtramos por contrato
		if(isset($this->passedArgs['Search.contrato_referencia'])) {
			$criterio = strtr($this->passedArgs['Search.contrato_referencia'],'_','/');
			$this->paginate['conditions']['Contrato.referencia LIKE'] = "%$criterio%";
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['contrato_referencia'] = $criterio;
			//completamos el titulo
			$title[] = 'Contrato: '.$criterio;
		}

		$this->Operacion->bindModel(
			array(
				'belongsTo' => array(
					'Calidad' => array(
						'foreignKey' => false,
						'conditions' => array('Contrato.calidad_id = Calidad.id')
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

	public function envio_asociados ($id) {

		$operacion = $this->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 3,
				'contain' => array(
					'PuertoCarga',
					'PuertoDestino',
					'Contrato' => array(
						'Proveedor',
						'Incoterm',
						'CanalCompra',
						'Calidad'
					),
					'AsociadoOperacion' => array(
						'Asociado'
					),
					'PesoOperacion',
					'PrecioTotalOperacion'
				)
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
		$tipo_fecha_transporte = $operacion['Contrato']['si_entrega'] ? 'entrega' : 'embarque';
		$this->set('tipo_fecha_transporte', $tipo_fecha_transporte);
		$this->set('fecha_transporte', $operacion['Contrato']['fecha_transporte']);

		//Líneas de reparto
		if (!empty($operacion['AsociadoOperacion'])) {
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
		}

		$this->set('fecha_fijacion', $operacion['Operacion']['fecha_pos_fijacion']);

		$asociados_operacion = $this->Operacion->AsociadoOperacion->find(
			'all',
			array(
				'conditions' => array(
					'AsociadoOperacion.operacion_id' => $id
				),
			//	'recursive' => 4,
				'contain' => array(
					'Operacion'=>array(
						'fields'=>array(
							'contrato_id'
						),
						'Contrato'=>array(
							'fields'=> array(
								'id',
								'calidad_id'
							),
							'Calidad' => array(
								'fields' =>array(
									'nombre'
								)
							)
						)
					),
					'Asociado'=>array(
						'fields'=> array(
							'id',
							'nombre_corto'
						)
					)
				)
			)
		);
		$this->set('asociados_operacion', $asociados_operacion);
       //Necesario para volcar los datos en el PDF
        //Contactos de los asociados
		$this->loadModel('Contacto');
		$contactos = $this->Contacto->find(
			'all',
			array(
				'conditions' =>array(
					'departamento_id' => array(3),
					),
				'order' => array('Empresa.nombre_corto' => 'asc'),
				'fields'=> array(
					'Contacto.departamento_id',
					'Contacto.empresa_id',
					'Contacto.nombre',
					'Contacto.email'
				)
			)
		);
		$this->set('contactos',$contactos);

        //Usuarios de la CMPSA
		$this->loadModel('Usuario');
		$usuarios = $this->Usuario->find(
			'all',
			array(
				'conditions' =>array(
					'departamento_id' => array(4,3) //Aquí indicamos el departamento de usuarios
					),
				'contain'=>array(
					'Departamento'=>array(
						'fields'=>array(
							'nombre'
						)
					)
				)
			)
		);
		$this->set('usuarios',$usuarios);

		if (!empty($id)) $this->Operacion->id = $id;
      	if($this->request->is('get')){//Comprobamos si hay datos previos en esa línea de muestras
           $this->request->data = $this->Operacion->read();//Cargo los datos
      	}else{//es un POST
	       	if(empty($this->request->data['email'])){
	       		$this->Flash->set('Los datos del NO fueron enviados. Faltan destinatarios');
	       	}else{
              // $this->Operacion->save($this->request->data['Operacion']); //Guardamos los datos actuales en los campos
            	foreach ($this->data['email'] as $email){
					$lista_email[]= $email;
               	}
			   /*	if(!empty($this->data['trafico'])){
					foreach ($this->data['trafico'] as $email){
						$lista_bcc[]= $email;
					}
				}*/
				if(!empty($this->data['compras'])){
				 	foreach ($this->data['compras'] as $email){
						$lista_bcc[]= $email;
				 	}
				}

				//Asigamos variable previa porque al incluir la funcion en el texto del mensaje redirecciona posteriormente mal
			//	$mes = strftime('%B',$operacion['Contrato']['fecha_transporte']);
			//	$ano = strftime('%Y',$operacion['Contrato']['fecha_transporte']);

               	//GENERAMOS EL PDF
               	App::uses('CakePdf', 'CakePdf.Pdf');
               	require_once(APP."Plugin/CakePdf/Pdf/CakePdf.php");
               	$CakePdf = new CakePdf();
               	$CakePdf->template('view_asociados');
               	$CakePdf->viewVars(array(
				   	'operacion'=>$operacion,
				   	'embalaje' =>$embalaje,
				   	'divisa' => $operacion['Contrato']['CanalCompra']['divisa'],
			   		'columnas_reparto' => $columnas_reparto,
					'lineas_reparto' => $lineas_reparto));
               // Get the PDF string returned
               //$pdf = $CakePdf->output();
               // Or write it to file directly
               $pdf = $CakePdf->write(APP. 'webroot'. DS. 'files'. DS .'distrubucion_asociados' . DS .'ficha_'.strtr($operacion['Operacion']['referencia'],'/','_').'_'.date('Ymd').'.pdf');
                //ENVIAMOS EL CORREO CON EL INFORME
               $Email = new CakeEmail(); //Llamamos la instancia de email
               $Email->config('compras'); //Plantilla de email.php
               $Email->from(array('cmpsa@cmpsa.com' => 'Compras CMPSA'));
               $Email->bcc($lista_email);
               //$Email->readReceipt($lista_bcc); //Acuse de recibo
               if(!empty($lista_bcc)){
               	$Email->bcc($lista_bcc);
               }
               $Email->subject('Ficha de compra '.$operacion['Operacion']['referencia']);
               $Email->attachments(APP. 'webroot'. DS. 'files'. DS .'distrubucion_asociados' . DS . 'ficha_'.strtr($operacion['Operacion']['referencia'],'/','_').'_'.date('Ymd').'.pdf');
               $Email->send('Adjuntamos la ficha de la operación '.$operacion['Operacion']['referencia'].' correspondiente a su '.$tipo_fecha_transporte.' en '.' de ');
               $this->Flash->set('Distribución a los asociados enviado con éxito.');
               $this->redirect(array(
               		'action'=>'view',
               		'controller' =>'Operaciones',
               		$operacion['Operacion']['id']
               		)
               );
       		}
   		}
   	}

	public function view_asociados ($id) {
		$this->view($id);
		$this->render(view);
	}
}
?>
