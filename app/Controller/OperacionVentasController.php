<?php
class OperacionVentasController extends AppController {
	//use beforeRender to send session parameters to the layout view
	public function beforeRender() {
			parent::beforeRender();
			$params = $this->Session->read('form.params');
			$this->set('params', $params);
	}
	//delete session values when going back to index you may want to keep the session alive instead
	public function msf_index() {
			$this->Session->delete('form');
	}
	//this method is executed before starting the form and retrieves one important parameter: the form steps number you can hardcode it, but in this example we are getting it by counting the number of files that start with msf_step_
	public function msf_setup() {
			App::uses('Folder', 'Utility');
			$OperacionVentaViewFolder = new Folder(APP.'View'.DS.'OperacionVentas');
			$steps = count($OperacionVentaViewFolder->find('msf_step_.*\.ctp'));
			$this->Session->write('form.params.steps', $steps);
			$this->Session->write('form.params.maxProgress', 0);
			$this->redirect(array('action' => 'msf_step', 1));
	}

// this is the core step handling method  it gets passed the desired step number, performs some checks to prevent smart users skipping steps checks fields validation, and when succeding, it saves the array in a session, merging with previous results
//if we are at last step, data is saved when no form data is submitted (not a POST request) it sets this->request->data to the values stored in session
	public function msf_step($stepNumber) {
// check if a view file for this step exists, otherwise redirect to index
		if (!file_exists(APP.'View'.DS.'OperacionVenta'.DS.'msf_step_'.$stepNumber.'.ctp')) {
				$this->redirect('/operacion_ventas/index');
		}
		// determines the max allowed step (the last completed + 1) if choosen step is not allowed (URL manually changed) the user gets redirected otherwise we store the current step value in the session
			$maxAllowed = $this->Session->read('form.params.maxProgress') + 1;
			if ($stepNumber > $maxAllowed) {
					$this->redirect('/operacion_ventas/msf_step/'.$maxAllowed);
			} else {
					$this->Session->write('form.params.currentStep', $stepNumber);
			}
 			//check if some data has been submitted via POST if not, sets the current data to the session data, to automatically populate previously saved fields
			if ($this->request->is('post')) {
				// set passed data to the model, so we can validate against it without saving
					$this->User->set($this->request->data);
					// if data validates we merge previous session data with submitted data, using CakePHP powerful Hash class (previously called Set)
					if ($this->User->validates()) {
							$prevSessionData = $this->Session->read('form.data');
							$currentSessionData = Hash::merge( (array) $prevSessionData, $this->request->data);

							/**
							 * if this is not the last step we replace session data with the new merged array
							 * update the max progress value and redirect to the next step
							 */
							if ($stepNumber < $this->Session->read('form.params.steps')) {
									$this->Session->write('form.data', $currentSessionData);
									$this->Session->write('form.params.maxProgress', $stepNumber);
									$this->redirect(array('action' => 'msf_step', $stepNumber+1));
							} else {
									/**
									 * otherwise, this is the final step, so we have to save the data to the database
									 */
									$this->User->save($currentSessionData);
									$this->Session->setFlash('Operación de venta creada');
									$this->redirect('/operacion_ventas/index');
							}
					}
			} else {
					$this->request->data = $this->Session->read('form.data');
			}
			// here we load the proper view file, depending on the stepNumber variable passed via GET
			$this->render('msf_step_'.$stepNumber);
	}

	public function index() {
		$this->set('action', $this->action);	//Se usa para tener la misma vista

		//$this->OperacionVenta->virtualFields['calidad']=$this->OperacionVenta->OperacionCompra->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['order'] = array('OperacionVenta.referencia' => 'asc');
		$this->paginate['recursive'] = -1;
		$this->paginate['contain'] = array(
			'OperacionCompra'=>array(
				'Contrato' =>array(
					'Calidad'
				)
			),
//PENDIENTE//'PesoOperacionVenta'
		);

		$titulo = $this->filtroPaginador(
			array(
				'OperacionVenta' =>array(
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

		$this->OperacionVenta->bindModel(
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
		$this->OperacionVenta->id = $id;
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
		$operacion = $this->OperacionVenta->find(
			'first',
			array(
				'conditions' => array('OperacionVenta.id' => $id),
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
		$contrato_id =  $operacion['OperacionVenta']['contrato_id'];
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
			$this->OperacionVenta->PuertoCarga->find(
				'list',
				array(
					'order' => array('PuertoCarga.nombre' =>'ASC')
				)
			)
		);
		$this->set(
			'puertoDestinos',
			$this->OperacionVenta->PuertoDestino->find(
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
			$this->request->data = $this->OperacionVenta->read();
			foreach ($asociados_operacion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['cantidad_embalaje_asociado'];
			}
		} else {
			if ($this->OperacionVenta->save($this->request->data)){
				//Los registros de AsociadoOperacion se van sumando
				//asi que hay que borrarlos todos porque el saveAll() los
				//vuelve a crear y no queremos duplicados.
				$this->OperacionVenta->AsociadoOperacion->deleteAll(array(
					'AsociadoOperacion.operacion_id' => $id
				));
				foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
					if ($cantidad != NULL) {
						$this->request->data['AsociadoOperacion']['operacion_id'] = $this->OperacionVenta->id;
						$this->request->data['AsociadoOperacion']['asociado_id'] = $asociado_id;
						$this->request->data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
						$this->OperacionVenta->AsociadoOperacion->saveAll($this->request->data['AsociadoOperacion']);
					}
				}
				$this->Flash->success(
					'OperacionVenta '.
					$this->request->data['OperacionVenta']['referencia'].
					' modificada con éxito'
				);
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error('OperacionVenta NO guardada');
			}
		}
		//	$this->set('action', $this->action);
		//	$this->render('form');
	}

	//// AQUI EMPIEZA EL FORM ()

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function form($id=null) {
		$this->set('action', $this->action);
//Necesitamos la lista completa de calidades para filtrar posteriormente en las cuentas de almacen
		$this->set('calidades',
			$this->OperacionVenta->OperacionCompra->Contrato->Calidad->find(
				'list',
				array(
					'order' => array('Calidad.nombre' => 'ASC')
				)
			)
		);

		$this->loadModel('Calidad');
		$calidades = $this->Calidad->find(
			'list',
			array(
				'fields' => array(
					'Calidad.id',
					'Calidad.descripcion'),
				'order' => array(
					'Calidad.descripcion' => 'asc'),
				'recursive' => 1
			)
		);
		$this->set('calidades',$calidades);

		//Sacamos el valor de la operación si es un ADD
		if (empty($this->params['named']['from_id'])){
			$op_venta = $this->OperacionVenta->find(
				'first',
				array(
					'conditions' =>array(
						'OperacionVenta.id' => $id
					)
				)
			);
		}
		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos
		//$this->OperacionVenta->Contrato->virtualFields['calidad']=$this->OperacionVenta->Contrato->Calidad->virtualFields['nombre'];

		//Queremos la lista de costes de fletes
		//$precio_fletes = $this->OperacionVenta->Contrato->PrecioFleteContrato->find(
		if (!empty($id))$this->OperacionVenta->id = $id;


		/*if ($this->request->is('post')) {//ES UN POST
			$data = &$this->request->data;
			//al guardar la linea, se incluye a qué contrato pertenece
			$this->request->data['OperacionVenta']['contrato_id'] = $contrato_id;
			if($id == NULL){
				//primero guardamos los datos de OperacionVenta
				if($this->OperacionVenta->save($this->request->data)){
					//luego las cantidades de cada asociado en AsociadoOperacion
					foreach ($data['CantidadAsociado'] as $asociado_id => $cantidad) {
						if ($cantidad != NULL) {
							$data['AsociadoOperacion']['operacion_id'] = $this->OperacionVenta->id;
							$data['AsociadoOperacion']['asociado_id'] = $asociado_id;
							$data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
							if (!$this->OperacionVenta->AsociadoOperacion->saveAll($data['AsociadoOperacion']))
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
						$this->OperacionVenta->id
					));
				}else{
					$this->Flash->error('Operación NO guardada');
				}
			}else{
			if($this->OperacionVenta->save($this->request->data)){
					$this->Flash->success('Operación modificada');
					$this->redirect(array(
						'controller' => 'operaciones',
						'action' => 'view',
						$id
						)
					);
			}
			}
		}else{//es un GET
			$this->request->data = $this->OperacionVenta->read(null, $id);
		}*/
	}
	public function view($id = null) {
		$this->checkId($id);
		$this->set('action', $this->action);	//Se usa para tener la misma info

		$op_venta = $this->OperacionVenta->find(
			'first',
			array(
				'conditions' => array('OperacionVenta.id' => $id),
				'recursive' => 3,
				'contain' => array(
					'OperacionCompra'=>array(
						'Contrato' => array(
							'Calidad'
							)
						)
					),
					'Distribucion' => array(
						'Asociado'
					),
			//		'PesoOperacion',
			//		'PrecioTotalOperacion'
			)
		);
		$this->set('op_venta', $op_venta);
		$this->set('referencia', $op_venta['OperacionVenta']['referencia']);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $op_venta['OperacionCompra']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $op_venta['OperacionVenta']['embalaje_id']
				),
				'fields' => array('Embalaje.nombre', 'ContratoEmbalaje.peso_embalaje_real')
			)
		);
		$this->set('embalaje', $embalaje);

		//Líneas de reparto
		if (!empty($op_venta['AsociadoOperacion'])) {
			foreach ($op_venta['AsociadoOperacion'] as $linea) {
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
		//comprobamos si ya existe una financiacion para esta operación
//PENDIENTE		if ($this->OperacionVenta->Financiacion->hasAny(array('Financiacion.id' => $id))) {
//			$this->set('existe_financiacion', 1);
//		}
//		//comprobamos si ya existe una facturación para esta operación
//		if ($this->OperacionVenta->Facturacion->hasAny(array('Facturacion.id' => $id))) {
//			$this->set('existe_facturacion', 1);
//		}
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
		$op_venta = $this->OperacionVenta->find(
			'first',
			array(
				'conditions' => array(
					'OperacionVenta.id' => $id
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
		$cuentas_almacenes = $this->OperacionVenta->Transporte->AlmacenTransporte->find(
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
					'ContratoEmbalaje.contrato_id' => $op_venta['OperacionVenta']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $op_venta['OperacionVenta']['embalaje_id']
				),
				'fields' => array(
					'Embalaje.nombre',
					'ContratoEmbalaje.peso_embalaje_real'
				)
			)
		);

		//Calculo la cantidad de bultos transportados
		if($op_venta['OperacionVenta']['id']!= NULL){
			$suma = 0;
			$transportado=0;
			foreach ($op_venta['Transporte'] as $suma){
				if ($transporte['operacion_id']=$op_venta['OperacionVenta']['id']){
					$transportado = $transportado + $suma['cantidad_embalaje'];
				}
			}
		}
		$restan = $op_venta['PesoOperacion']['cantidad_embalaje'] - $transportado;
		$this->set(compact('transportado'));
		$this->set(compact('restan'));

		$this->set('tipo_fecha_transporte', $op_venta['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque');
		//mysql almacena la fecha en formato ymd
		//	$this->Date->format($op_venta['Contrato']['fecha_transporte']);
		$fecha = $op_venta['Contrato']['fecha_transporte'];
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

		$operacion_retiradas = $this->OperacionVenta->Retirada->find(
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
	//		if ($this->OperacionVenta->delete($id)) {
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
			$this->OperacionVenta->find(
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
		$this->OperacionVenta->virtualFields['calidad']=$this->OperacionVenta->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['order'] = array('OperacionVenta.referencia' => 'asc');
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
				'OperacionVenta' =>array(
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

		$this->OperacionVenta->bindModel(
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

		$operacion = $this->OperacionVenta->find(
			'first',
			array(
				'conditions' => array('OperacionVenta.id' => $id),
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

		$this->set('referencia', $operacion['OperacionVenta']['referencia']);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['OperacionVenta']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['OperacionVenta']['embalaje_id']
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

		$this->set('fecha_fijacion', $operacion['OperacionVenta']['fecha_pos_fijacion']);

		$asociados_operacion = $this->OperacionVenta->AsociadoOperacion->find(
			'all',
			array(
				'conditions' => array(
					'AsociadoOperacion.operacion_id' => $id
				),
				//	'recursive' => 4,
				'contain' => array(
					'OperacionVenta'=>array(
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

		if (!empty($id)) $this->OperacionVenta->id = $id;
		if($this->request->is('get')){//Comprobamos si hay datos previos en esa línea de muestras
			$this->request->data = $this->OperacionVenta->read();//Cargo los datos
		}else{//es un POST
			if(empty($this->request->data['email'])){
				$this->Flash->set('Los datos del NO fueron enviados. Faltan destinatarios');
			}else{
				// $this->OperacionVenta->save($this->request->data['OperacionVenta']); //Guardamos los datos actuales en los campos
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
				$pdf = $CakePdf->write(APP. 'webroot'. DS. 'files'. DS .'distrubucion_asociados' . DS .'ficha_'.strtr($operacion['OperacionVenta']['referencia'],'/','_').'_'.date('Ymd').'.pdf');
				//ENVIAMOS EL CORREO CON EL INFORME
				$Email = new CakeEmail(); //Llamamos la instancia de email
				$Email->config('compras'); //Plantilla de email.php
				$Email->from(array('cmpsa@cmpsa.com' => 'Compras CMPSA'));
				$Email->bcc($lista_email);
				//$Email->readReceipt($lista_bcc); //Acuse de recibo
				if(!empty($lista_bcc)){
					$Email->bcc($lista_bcc);
				}
				$Email->subject('Ficha de compra '.$operacion['OperacionVenta']['referencia']);
				$Email->attachments(APP. 'webroot'. DS. 'files'. DS .'distrubucion_asociados' . DS . 'ficha_'.strtr($operacion['OperacionVenta']['referencia'],'/','_').'_'.date('Ymd').'.pdf');
				$Email->send('Adjuntamos la ficha de la operación '.$operacion['OperacionVenta']['referencia'].' correspondiente a su '.$tipo_fecha_transporte.' en '.' de ');
				$this->Flash->set('Distribución a los asociados enviado con éxito.');
				$this->redirect(array(
					'action'=>'view',
					'controller' =>'Operaciones',
					$operacion['OperacionVenta']['id']
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
