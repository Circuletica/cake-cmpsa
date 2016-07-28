<?php
class TransportesController extends AppController {

	public function index() {

		$this->paginate['order'] = array('Transporte.fecha_despacho_op' => 'asc');
		$this->paginate['recursive'] = 2;
<<<<<<< HEAD
		$this->paginate['condition'] = array('Transporte.fecha_despacho_op'=> NULL);	
=======
		$this->paginate['condition'] = array(
			'Transporte.fecha_despacho_op'=> NULL
		);
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
		$this->paginate['contain'] = array(
			'Operacion' => array(
				'fields'=> array(
					'id',
					'referencia',
					'contrato_id'
				),
				'PesoOperacion'=> array(
					'fields' =>array(
						'peso',
						'cantidad_embalaje'
					)
<<<<<<< HEAD
				),	
				'Contrato'=>array(	
=======
				),
				'Contrato'=>array(
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
					'fields'=> array(
						'id',
						'fecha_transporte',
						'si_entrega',
					),
					'Proveedor'=>array(
						'id',
						'nombre_corto'
					),
					'Calidad' => array(
						'fields' =>(
							'nombre'
						)
					)
<<<<<<< HEAD
				)
			),
			'PuertoDestino' => array(
				'fields' => array(
					'id',
					'nombre'
				)
			)
		);

		$transportes = $this->paginate();
		$this->set(compact('transportes'));
	}

	public function view($id = null) {
		$this->pdfConfig = array(
			'filename' => 'linea'.date('Ymd'),
			//'output'=> 'files/Report.pdf'  
			//'download' => (bool)$this->request->query('download')
		);
		$linea = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				)
			)
		);

	/*$pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');
	$this->set(compact('pdf'));*/
		//$CakePdf = new CakePdf();
		//  $CakePdf->template('default');
		//$CakePdf->viewVars($this->viewVars);
		// Get the PDF string returned
		//$pdf = $CakePdf->output();
		// Or write it to file directly
 /*   $pdf = $this->write(APP . 'files' . DS . 'newsletter.pdf');
$this->set(compact('pdf'));
  */

 /*$Email = new CakeEmail();
 $Email->config('smtp')
	->template('default')
	->emailFormat('html')
	->subject('AVISO PREVISIÓN LLEGADA')
	->to('info@circuletica.org')
	->from('rodolgl@gmail.com')
	->cc('rodolgl@gmail.com')
 ->send('Un mensaje');*/

	/*if (!$id) {
		$this->Session->setFlash('URL mal formada Transporte/view ');
		$this->redirect(array('action'=>'index_trafico'));
	}*/
		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Incoterm'=>array(
								'fields'=> array(
									'nombre'
								)
							)
						),
						'Embalaje' => array(
							'fields' => array(
								'nombre'
							)
						)
					),
					'Naviera' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Agente'=> array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'PuertoCarga' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre_corto'
						)
					),
					'AlmacenTransporte' => array(
						'fields' => array(
							'id',
							'cuenta_almacen',
							'almacen_id',
							'cantidad_cuenta',
							'peso_bruto',
							'marca_almacen'),
						'Almacen' => array(
							'fields' => (
								'nombre_corto'
							)
						),
						'Retirada'=> array(
							'fields' => array(
								'id'
							)
						)
					)	
				)
			)
		);
		$this->set('transporte',$transporte);
		//Calculamos la cantidad de sacos almacenados en la línea
		if(!empty($transporte['Transporte']['id'])){
			$suma = 0;
			$almacenado=0;
			foreach ($transporte['AlmacenTransporte'] as $suma):
				if ($almacenTransporte['transporte_id'] = $transporte['Transporte']['id']):
					$almacenado = $almacenado + $suma['cantidad_cuenta'];
endif;
endforeach;
		}
		$restan = $transporte['Transporte']['cantidad_embalaje'] - $almacenado; 
		$this->set(compact('restan'));
		$this->set('almacenado',$almacenado);

		$embalaje = $transporte['Operacion']['Embalaje']['nombre'];	
		$this->set('embalaje',$embalaje);

		//Necesario para exportar en PDf
		$this->set(compact('id'));
	}

	public function add() {
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado transporte/add '.$this->params['named']['from_controller']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'index')
			);
		}
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash('error en URL');
			$this->redirect(array(
				'action' => 'view_trafico',
				'controller' => 'operaciones',
				$this->params['from_id']
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) { //esta acción vale tanto para edit como add
		$this->set('action', $this->action);
		//Listamos navieras
		$this->loadModel('Naviera');	
		$navieras = $this->Naviera->find(
			'list',
			array(
				'fields' => array(
					'Naviera.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('navieras'));

		$this->loadModel('Agente');
		$agentes = $this->Agente->find(
			'list',
			array(
				'fields' => array(
					'Agente.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('agentes'));
		$this->loadModel('Aseguradora');
		$aseguradoras = $this->Aseguradora->find('list',
			array(
				'fields' => array(
					'Aseguradora.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('aseguradoras'));
		$this->loadModel('Almacen');
		$almacenes = $this->Almacen->find(
			'list',
			array(
				'fields' => array(
					'Almacen.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('almacenes'));
		//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos

		if(empty($this->params['named']['from_id'])){
			$transporte = $this->Transporte->find(
				'first',
				array(
					'conditions' =>array(
						'Transporte.id' => $id
					),
					'fields' => array(
						'operacion_id',
						'cantidad_embalaje',
						'linea'
					)
				)
			);
			$operacion_id =  $transporte['Transporte']['operacion_id'];
		}else{
			$operacion_id = $this->params['named']['from_id'];
		}

		$operacion = $this->Transporte->Operacion->find(
			'first', 
			array(
				'conditions' => array(
					'Operacion.id' => $operacion_id
				),
				'recursive' => 2,
				'fields' => array(
					'id',
					'precio_compra',
					'referencia',
					'embalaje_id',
					'contrato_id'
				),
				'Transporte' => array(
					'fields' => array(
						'id',
						'operacion_id',
						'linea'
					)
				),
				'PrecioTotalOperacion'=> array(
					'fields' => array(
						'precio_euro_kilo_total'
					)
				),
				'Contrato' => array(
					'fields' => array(
						'id'
					),
					'Incoterm'=>array(
						'fields'=> array(
							'nombre'
						)
					)
				)
			)
		);
=======
				)
			),
			'PuertoDestino' => array(
				'fields' => array(
					'id',
					'nombre'
				)
			)
		);

		$transportes = $this->paginate();
		$this->set(compact('transportes'));
	}

	public function view($id = null) {
		if (!$id)
			throw new NotFoundException(__('URL mal formado Transporte/view'));
		$this->pdfConfig = array(
			'filename' => 'linea'.date('Ymd'),
		);

		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Incoterm'=>array(
								'fields'=> array(
									'nombre'
								)
							)
						),
						'Embalaje' => array(
							'fields' => array(
								'nombre'
							)
						)
					),
					'Naviera' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Agente'=> array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'PuertoCarga' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre_corto'
						)
					),
					'AlmacenTransporte' => array(
						'fields' => array(
							'id',
							'cuenta_almacen',
							'almacen_id',
							'cantidad_cuenta',
							'peso_bruto',
							'marca_almacen'),
						'Almacen' => array(
							'fields' => (
								'nombre_corto'
							)
						),
						'Retirada'=> array(
							'fields' => array(
								'id'
							)
						)
					)
				)
			)
		);
		if (!$transporte)
			throw new NotFoundException(__('No existe ese transporte'));
		$this->set('transporte',$transporte);
		//Calculamos la cantidad de sacos almacenados en la linea
		if(!empty($transporte['Transporte']['id'])){
			$suma = 0;
			$almacenado=0;
			foreach ($transporte['AlmacenTransporte'] as $suma) {
				if ($almacenTransporte['transporte_id'] = $transporte['Transporte']['id']) {
					$almacenado = $almacenado + $suma['cantidad_cuenta'];
				}
			}
		}
		$restan = $transporte['Transporte']['cantidad_embalaje'] - $almacenado;
		$this->set(compact('restan'));
		$this->set('almacenado',$almacenado);

		$embalaje = $transporte['Operacion']['Embalaje']['nombre'];
		$this->set('embalaje',$embalaje);

		//Necesario para exportar en PDf
		$this->set(compact('id'));
	}

	public function add() {
		if (!$this->params['named']['from_id']) {
			$this->Flash->set('URL mal formado transporte/add '.$this->params['named']['from_controller']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'index')
			);
		}
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Flash->set('error en URL');
			$this->redirect(array(
				'action' => 'view_trafico',
				'controller' => 'operaciones',
				$this->params['from_id']
			));
		}
		$this->form($id);
		$this->render('form');
	}
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458

	public function form($id = null) { //esta acción vale tanto para edit como add
		$this->set('action', $this->action);

<<<<<<< HEAD
		$embalaje = $operacion['Embalaje']['nombre'];		
		$this->set('embalaje',$embalaje); //Tipo de bulto para la cantidad en el titulo.

		$this->set('puertoCargas', $this->Transporte->PuertoCarga->find(
			'list',
			array(
				'order' => array(
					'PuertoCarga.nombre' => 'ASC'
				)
			)
		));
		//Puertos de destino españoles
		$this->set('puertoDestinos', $this->Transporte->PuertoDestino->find(
			'list',
			array(
				'contain' => array('Pais'),
				'conditions' => array( 'Pais.nombre' => 'España')
			)
		));		
		//Obligatoriedad de que sea rellenado debido a la tabla de la bbdd

		//Calculo la cantidad de bultos transportados
		if(!empty($operacion['Operacion']['id'])) {
			$suma = 0;
			$transportado=0;
			foreach ($operacion['Transporte'] as $suma){
				if ($transporte['operacion_id']=$operacion['Operacion']['id']) {
					$transportado = $transportado + $suma['cantidad_embalaje'];

				}
			}
		}

		$this->set(compact('operacion'));
		$this->set(compact('transportado'));
		//CALCULAMOS EL NÚMERO DE LÍNEA DE TRANSPORTE
		//Saco el número del array para numerar las líneas de transporte

		//Línea primera para comenzar desde el array que es 0. Si $clave es 5, $num será 6.
		//Sumamos 2 para saltar el 0 y agregar el número que corresponde como nueva línea.
		//Este proceso genera la línea de nuevo siempre para que el contador lo haga desde el principio
		$num = 0;	
		foreach ($operacion['Transporte'] as $clave=>$transporte){
			$num++;
		}
		if (empty($id)){ //En el ADD
			if(empty($operacion['Transporte'])){ //Primera línea
				$num = 1;
			}else{ //A partir de la primera
				$num = $num+1;
			};
		}
		$this->set(compact('num'));


		if (!empty($id)) $this->Transporte->id = $id;

		//if (!empty($this->request->data)) {//ES UN POST
		if ($this->request->is(array('post', 'put'))) {//ES UN POST
			$this->request->data['Transporte']['id'] = $id;
			$this->request->data['Transporte']['operacion_id'] = $operacion_id;

			if($id == NULL){;
			if($this->Transporte->save($this->request->data)){
				$this->Session->setFlash('L�nea de transporte guardada');
				$this->redirect(array(
					'controller' => 'operaciones',
					'action' => 'view_trafico',
					$operacion_id
				));
			}else{
				$this->Session->setFlash('L�nea de transporte NO guardada');
			}
			}else{
				if($this->Transporte->save($this->request->data)){
					$this->Session->setFlash('L�nea de transporte modificada');
					$this->redirect(array(
						'controller' => 'transportes',
						'action' => 'view',
						$id
					));
				}
			}		
		}else{ //es un GET
			$this->request->data = $this->Transporte->read(null, $id);
		}

	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) :
			throw new MethodNotAllowedException();
endif;

if ($this->Transporte->delete($id)):
	$this->Session->setFlash('L�nea de transporte borrada');
$this->redirect(array(
	'controller' => 'operaciones',
	'action' => 'view_trafico',
	$this->params['named']['from_id']
));
endif;
=======
		//Listamos navieras
		$this->loadModel('Naviera');
		$navieras = $this->Naviera->find(
			'list',
			array(
				'fields' => array(
					'Naviera.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('navieras'));

		$this->loadModel('Agente');
		$agentes = $this->Agente->find(
			'list',
			array(
				'fields' => array(
					'Agente.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('agentes'));
		$this->loadModel('Aseguradora');
		$aseguradoras = $this->Aseguradora->find('list',
			array(
				'fields' => array(
					'Aseguradora.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('aseguradoras'));
		$this->loadModel('Almacen');
		$almacenes = $this->Almacen->find(
			'list',
			array(
				'fields' => array(
					'Almacen.id',
					'Empresa.nombre_corto'
				),
				'recursive' => 1
			)
		);
		$this->set(compact('almacenes'));
		//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos

		if(empty($this->params['named']['from_id'])){
			$transporte = $this->Transporte->find(
				'first',
				array(
					'conditions' =>array(
						'Transporte.id' => $id
					),
					'fields' => array(
						'operacion_id',
						'cantidad_embalaje',
						'linea'
					)
				)
			);
			$operacion_id =  $transporte['Transporte']['operacion_id'];
		}else{
			$operacion_id = $this->params['named']['from_id'];
		}

		$operacion = $this->Transporte->Operacion->find(
			'first',
			array(
				'conditions' => array(
					'Operacion.id' => $operacion_id
				),
				'recursive' => 2,
				'fields' => array(
					'id',
					'precio_compra',
					'referencia',
					'embalaje_id',
					'contrato_id'
				),
				'Transporte' => array(
					'fields' => array(
						'id',
						'operacion_id',
						'linea'
					)
				),
				'PrecioTotalOperacion'=> array(
					'fields' => array(
						'precio_euro_kilo_total'
					)
				),
				'Contrato' => array(
					'fields' => array(
						'id',
						'puerto_carga_id',
						'puerto_destino_id'
					),
					'Incoterm'=>array(
						'fields'=> array(
							'nombre'
						)
					)
				)
			)
		);


		$embalaje = $operacion['Embalaje']['nombre'];
		$this->set('embalaje',$embalaje); //Tipo de bulto para la cantidad en el titulo.

		$this->set('puertoCargas', $this->Transporte->PuertoCarga->find(
			'list',
			array(
				'order' => array(
					'PuertoCarga.nombre' => 'ASC'
				)
			)
		));

		//Puertos de destino españoles
		$this->set('puertoDestinos', $this->Transporte->PuertoDestino->find(
			'list',
			array(
				'contain' => array('Pais'),
				'conditions' => array( 'Pais.iso3166' => 'es')
			)
		));

		//Obligatoriedad de que sea rellenado debido a la tabla de la bbdd

		//Calculo la cantidad de bultos transportados
		if(!empty($operacion['Operacion']['id'])) {
			$suma = 0;
			$transportado=0;
			foreach ($operacion['Transporte'] as $suma){
				if ($transporte['operacion_id']=$operacion['Operacion']['id']) {
					$transportado = $transportado + $suma['cantidad_embalaje'];
				}
			}
		}

		$this->set(compact('operacion'));
		$this->set(compact('transportado'));
		//CALCULAMOS EL NÚMERO DE LINEA DE TRANSPORTE
		//Saco el número del array para numerar las lineas de transporte

		//Linea primera para comenzar desde el array que es 0. Si $clave es 5, $num será 6.
		//Sumamos 2 para saltar el 0 y agregar el número que corresponde como nueva linea.
		//Este proceso genera la linea de nuevo siempre para que el contador lo haga desde el principio
		$num = 0;
		foreach ($operacion['Transporte'] as $clave=>$transporte){
			$num++;
		}
		if (empty($id)){ //En el ADD
			if(empty($operacion['Transporte'])){ //Primera linea
				$num = 1;
			}else{
				$num = $num+1;
			}

		}
		$this->set(compact('num'));


		if (!empty($id)) $this->Transporte->id = $id;

		if ($this->request->is(array('post', 'put'))) {//ES UN POST
			$this->request->data['Transporte']['id'] = $id;
			$this->request->data['Transporte']['operacion_id'] = $operacion_id;

			if($id == NULL){
				if($this->Transporte->save($this->request->data)){
					$this->Flash->set("Linea de transporte guardada correctamente");
					$this->redirect(array(
						'controller' => 'operaciones',
						'action' => 'view_trafico',
						$operacion_id
					));
				}else{
					$this->Flash->set('Linea de transporte NO guardada');
				}
			}else{
				if($this->Transporte->save($this->request->data)){
					$this->Flash->set('Linea de transporte modificada correctamente');
					$this->redirect(array(
						'controller' => 'transportes',
						'action' => 'view',
						$id
					));
				}
			}
		}else{ //es un GET
			$this->request->data = $this->Transporte->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')):
			throw new MethodNotAllowedException();
endif;

if ($this->Transporte->delete($id)){
	$this->Flash->set('Linea de transporte borrada correctamente');
	$this->redirect(array(
		'controller' => 'operaciones',
		'action' => 'view_trafico',
		$this->params['named']['from_id']
	));//No usar History aquí
}else{
	$this->Flash->set('Linea de transporte NO borrada. Hay cuenta de almacen');
	$this->redirect(array(
		'action' => 'view',
		$id
	));
}
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
	}

	public function info_embarque() {
		$this->pdfConfig = array(
			'filename' => 'info_embarque',
			'paperSize' => 'A4',
			'orientation' => 'landscape',
		);
		//	$invoice = $this->Invoice->find('first', array('conditions' => array('id' => $id)));
		//	$this->set(compact('invoice');


		$this->paginate['order'] = array('Calidad.nombre' => 'asc');
		$this->paginate['recursive'] = 2;
		$this->paginate['condition'] = array(
			'Transporte.fecha_despacho_op'=> NULL
		);
		$this->paginate['contain'] = array(
			'Operacion' => array(
				'fields'=> array(
					'id',
					'referencia',
					'contrato_id',
<<<<<<< HEAD
				)				    				    	
=======
				)
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
			),
			'PesoOperacion'=> array(
				'fields' =>array(
					'id',
					'peso',
					'cantidad_embalaje'
<<<<<<< HEAD
				)
			),
			'Contrato'=>array(	
				'fields'=> array(
					'id',
					'fecha_transporte',
					'si_entrega',
					'proveedor_id'
				)
			),
			'Proveedor'=>array(
				'fields'=>array(
					'id',
					'nombre_corto'
				)
			),
			'PuertoDestino' => array(
				'fields' => array(
					'id',
					'nombre'
=======
				)
			),
			'Contrato'=>array(
				'fields'=> array(
					'id',
					'fecha_transporte',
					'si_entrega',
					'proveedor_id'
				)
			),
			'Proveedor'=>array(
				'fields'=>array(
					'id',
					'nombre_corto'
				)
			),
			'PuertoDestino' => array(
				'fields' => array(
					'id',
					'nombre'
				)
			)
		);

		$this->Transporte->bindModel(
			array(
				'belongsTo' => array(
					'Contrato' => array(
						'foreignKey' => false,
						'conditions' => array('Operacion.contrato_id = Contrato.id')
					),
					'Proveedor' => array(
						'className' => 'Empresa',
						'foreignKey' => false,
						'conditions' => array('Contrato.proveedor_id = Proveedor.id')
					)
				),
				'hasOne' => array(
					'PesoOperacion' => array(
						'foreignKey' => false,
						'conditions' => array('Transporte.operacion_id = PesoOperacion.id')
					)
				)
			)
		);

		$this->set('transportes',$this->paginate());

	}
	public function info_despacho() {
		//	$this ->info_embarque();
		//	$this ->render('info_despacho');
		$this->pdfConfig = array(
			'filename' => 'info_embarque',
			'paperSize' => 'A4',
			'orientation' => 'landscape',
		);

		//$this->paginate['order'] = array('Transporte.fecha_despacho_op' => 'asc');
		//$this->paginate['recursive'] = 3;
		//$this->Transporte->virtualFields['calidad']=$this->Transporte->Operacion->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['conditions'] = array(
			'Transporte.fecha_despacho_op IS NOT NULL'
		);

		$this->paginate['contain'] = array(
			'Calidad',
			'Contrato' => array(
				'fields' => array(
					'referencia',
					'calidad_id'
				)
			),
			'Operacion' =>array(
				'fields'=> array(
					'id',
					'referencia',
					'contrato_id'
				)
			)
		);

		$this->Transporte->bindModel(
			array(
				'belongsTo' => array(
					'Contrato' => array(
						'foreignKey' => false,
						'conditions' => array('Operacion.contrato_id = Contrato.id')
					),
					'Calidad' => array(
						'foreignKey' => false,
						'conditions' => array('Contrato.calidad_id = Calidad.id')
					)
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
				)
			)
		);

<<<<<<< HEAD
		$this->Transporte->bindModel(
			array(
				'belongsTo' => array(
					'Contrato' => array(
						'foreignKey' => false,
						'conditions' => array('Operacion.contrato_id = Contrato.id')
					),	  
					'Proveedor' => array(
						'className' => 'Empresa',
						'foreignKey' => false,
						'conditions' => array('Contrato.proveedor_id = Proveedor.id')
					)
				),
				'hasOne' => array(
					'PesoOperacion' => array(
						'foreignKey' => false,
						'conditions' => array('Transporte.operacion_id = PesoOperacion.id')
=======
		$title = $this->filtroPaginador(
			array(
				'Transporte' => array(
					'OperaciÃn' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => ''
					)
				),
				'Calidad' => array(
					'Calidad' => array(
						'columna' => 'nombre',
						'exacto' => false,
						'lista' => ''
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
					)
				)
			)
		);

<<<<<<< HEAD
		$this->set('transportes',$this->paginate());

	}
	public function info_despacho() {
		//	$this ->info_embarque();
		//	$this ->render('info_despacho');
		$this->pdfConfig = array(
			'filename' => 'info_embarque',
			'paperSize' => 'A4',
			'orientation' => 'landscape',
		);

		//$this->paginate['order'] = array('Transporte.fecha_despacho_op' => 'asc');
		//$this->paginate['recursive'] = 3;
		//$this->Transporte->virtualFields['calidad']=$this->Transporte->Operacion->Contrato->Calidad->virtualFields['nombre'];
		$this->paginate['conditions'] = array(
			'Transporte.fecha_despacho_op IS NOT NULL'
		);

		$this->paginate['contain'] = array(
			'Calidad',
			'Contrato' => array(
				'fields' => array(
					'referencia',
					'calidad_id'
				)
			),
			'Operacion' =>array(
				'fields'=> array(
					'id',
					'referencia',
					'contrato_id'
				)
			)
		);

		$this->Transporte->bindModel(
			array(
				'belongsTo' => array(
					'Contrato' => array(
						'foreignKey' => false,
						'conditions' => array('Operacion.contrato_id = Contrato.id')
					),
					'Calidad' => array(
						'foreignKey' => false,
						'conditions' => array('Contrato.calidad_id = Calidad.id')
					)
				)
			)
		);

		$title = $this->filtroPaginador(
			array(
				'Transporte' => array(
					'Operaci�n' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => ''
					)
				),
				'Calidad' => array(
					'Calidad' => array(
						'columna' => 'nombre',
						'exacto' => false,
						'lista' => ''
=======
		//filtramos por fecha
		if(isset($this->passedArgs['Search.fechadesde'])) {
			$fechadesde = $this->passedArgs['Search.fechadesde'];
			//Si solo se ha introducido un año (aaaa)
			if (preg_match('/^\d{4}$/',$fechadesde)) {
				$anyo = $fechadesde;
			}
			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fechadesde)) {
				list($mes,$anyo) = explode('-',$fechadesde);
			} else {
				$this->Flash->set('Error de fecha');
				$this->redirect(array('action' => 'index'));
			}
			//si se ha introducido un año, filtramos por el año
			if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
			//si se ha introducido un mes, filtramos por el mes
			if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
			$this->request->data['Search']['fecha'] = $fechadesd;
			//completamos el titulo
			$title .= '|Fecha: '.$fechadesde;
		}
		if(isset($this->passedArgs['Search.fechahasta'])) {
			$fecha = $this->passedArgs['Search.fechasta'];
			//Si solo se ha introducido un año (aaaa)
			if (preg_match('/^\d{4}$/',$fecha)) { $anyo = $fechahasta; }
			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fechahasta)) {
				list($mes,$anyo) = explode('-',$fechahasta);
			} else {
				$this->Flash->set('Error de fecha');
				$this->redirect(array('action' => 'index'));
			}
			//si se ha introducido un año, filtramos por el año
			if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
			//si se ha introducido un mes, filtramos por el mes
			if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
			$this->request->data['Search']['fecha'] = $fechahasta;
			//completamos el titulo
			$title .= '|Fecha: '.$fechahasta;
		}



		$despachos =  $this->paginate();
		$title = 'Despachos | '.$title;

		//pasamos los datos a la vista
		$this->set(compact('despachos','title'));
	}

	public function reclamacion($id = null) {
		$this->pdfConfig = array(
			'filename' => 'reclamacion',
			'paperSize' => 'A4',
			'orientation' => 'portrait',
			'layout' =>'facturas'
		);

		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Calidad'=>array(
								'fields'=> array(
									'nombre'
								)
							)
						),
						'PrecioTotalOperacion'
					),
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					)
				)
			)
		);
		$this->set('transporte',$transporte);

		$dia = date ('d');
		//$mes=date('m');
		$mes=date('F');
		$ano = date('Y');

		$this->set(compact('dia'));
		$this->set(compact('mes'));
		$this->set(compact('ano'));


		$parte = $this->Transporte->Operacion->find(
			'first',
			array(
				'conditions' => array(
					'Operacion.id' => $transporte['Operacion']['id']
				),
				'recursive' => -1,
				'fields' => array(
					'id'
				),
				'contain' => array(
					'Transporte' => array(
						'fields' => array(
							'id',
							'operacion_id'
						)
					)
				)
			)
		);
	}

	public function asegurar($id = null) {

		setlocale(LC_TIME, "es_ES.UTF-8");
		$this->pdfConfig = array(
			'filename' => 'asegurar',
			'paperSize' => 'A4',
			'orientation' => 'portrait'
		);

		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Calidad'=>array(
								'fields'=> array(
									'nombre'
								)
							),
							'Proveedor'	=> array(
								'fields' => array(
									'id',
									'nombre'
								)
							)
						),
						'PrecioTotalOperacion',
						'Embalaje' => array(
							'fields' => array(
								'peso_embalaje'
							)
						)
					),
					'PuertoCarga' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Naviera' => array(
						'fields' => array(
							'id',
							'nombre'
						)
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
					)
				)
			)
		);
<<<<<<< HEAD

		//filtramos por fecha
		if(isset($this->passedArgs['Search.fechadesde'])) {
			$fechadesde = $this->passedArgs['Search.fechadesde'];
			//Si solo se ha introducido un año (aaaa)
			if (preg_match('/^\d{4}$/',$fechadesde)) {
				$anyo = $fechadesde;
			}
			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fechadesde)) {
				list($mes,$anyo) = explode('-',$fechadesde);
			} else {
				$this->Session->setFlash('Error de fecha');
				$this->redirect(array('action' => 'index'));
			}
			//si se ha introducido un año, filtramos por el año
			if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
			//si se ha introducido un mes, filtramos por el mes
			if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
			$this->request->data['Search']['fecha'] = $fechadesd;
			//completamos el titulo
			$title .= '|Fecha: '.$fechadesde;
		}
		if(isset($this->passedArgs['Search.fechahasta'])) {
			$fecha = $this->passedArgs['Search.fechasta'];
			//Si solo se ha introducido un año (aaaa)
			if (preg_match('/^\d{4}$/',$fecha)) { $anyo = $fechahasta; }
			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fechahasta)) {
				list($mes,$anyo) = explode('-',$fechahasta);
			} else {
				$this->Session->setFlash('Error de fecha');
				$this->redirect(array('action' => 'index'));
			}
			//si se ha introducido un año, filtramos por el año
			if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
			//si se ha introducido un mes, filtramos por el mes
			if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
			$this->request->data['Search']['fecha'] = $fechahasta;
			//completamos el titulo
			$title .= '|Fecha: '.$fechahasta;
		}



		$despachos =  $this->paginate();
		$title = 'Despachos | '.$title;

		//pasamos los datos a la vista
		$this->set(compact('despachos','title'));
	}

	public function reclamacion($id = null) {
		$this->pdfConfig = array(
			'filename' => 'reclamacion',
			'paperSize' => 'A4',
			'orientation' => 'portrait',
			'layout' =>'facturas'
		);	

		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Calidad'=>array(
								'fields'=> array(
									'nombre'
								)
							)
						),
						'PrecioTotalOperacion'
					),
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					)
				)	
			)
		);
		$this->set('transporte',$transporte);

		$dia = date ('d');
		//$mes=date('m');
		$mes=date('F');
		$ano = date('Y');

		//	    if ($mes=="1") $mes="Enero";
		//	    if ($mes=="2") $mes="Febrero";
		//	    if ($mes=="3") $mes="Marzo";
		//	    if ($mes=="4") $mes="Abril";
		//	    if ($mes=="5") $mes="Mayo";
		//	    if ($mes=="6") $mes="Junio";
		//	    if ($mes=="7") $mes="Julio";
		//	    if ($mes=="8") $mes="Agosto";
		//	    if ($mes=="9") $mes="Setiembre";
		//	    if ($mes=="10") $mes="Octubre";
		//	    if ($mes=="11") $mes="Noviembre";
		//	    if ($mes=="12") $mes="Diciembre";
		$this->set(compact('dia'));
		$this->set(compact('mes'));
		$this->set(compact('ano'));


		$parte = $this->Transporte->Operacion->find(
			'first',
			array(
				'conditions' => array(
					'Operacion.id' => $transporte['Operacion']['id']
				),
				'recursive' => -1,
				'fields' => array(
					'id'
				),	
				'contain' => array(
					'Transporte' => array(
						'fields' => array(
							'id',
							'operacion_id'
=======
		$this->set('transporte',$transporte);

		$dia = date ('d');
		//$mes=date('m');
		$mes=date('F');
		$ano = date('Y');

		$this->set(compact('dia'));
		$this->set(compact('mes'));
		$this->set(compact('ano'));

		$parte = $this->Transporte->Operacion->find(
			'first',
			array(
				'conditions' => array(
					'Operacion.id' => $transporte['Operacion']['id']
				),
				'recursive' => -1,
				'fields' => array(
					'id'
				),
				'contain' => array(
					'Transporte' => array(
						'fields' => array(
							'id',
							'operacion_id'
						)
					)
				)
			)
		);
	}

	public function export() {

		$this->set('transportes', $this->Transporte->find(
			'all',
			array(
				'conditions'=> array(
					'Transporte.fecha_despacho_op' => NULL
				),
				'recursive' => 1,
				'fields' => array(
					'matricula',
					'nombre_vehiculo',
					'fecha_carga',
					'fecha_llegada',
					'fecha_prevista',
					'observaciones'
				),
				'contain'=>array(
					'Operacion'=>array(
						'PesoOperacion',
						'Contrato'=>array(
							'fields'=>array(
								'fecha_transporte'
							),
							'Proveedor' => array(
								'fields'=>array(
									'nombre_corto'
								)
							)
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
						)
					)
				)
			)
<<<<<<< HEAD
		);
	}	

	public function asegurar($id = null) {
		// $this->reclamacion();
		//$this->render('asegurar');

		setlocale(LC_TIME, "es_ES.UTF-8");
		$this->pdfConfig = array(
			'filename' => 'asegurar',
			'paperSize' => 'A4',
			'orientation' => 'portrait'
		);	

		$transporte = $this->Transporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.id' => $id
				),
				'recursive' => 3,
				'contain' => array(
					'Operacion' => array(
						'Contrato' => array(
							'fields' => array(
								'id',
								'referencia'
							),
							'Calidad'=>array(
								'fields'=> array(
									'nombre'
								)
							),
							'Proveedor'	=> array(
								'fields' => array(
									'id',
									'nombre'
								)
							)			   		
						),
						'PrecioTotalOperacion',
						'Embalaje' => array(
							'fields' => array(
								'peso_embalaje'
							)
						)
					),
					'PuertoCarga' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),				
					'PuertoDestino' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Aseguradora' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					),
					'Naviera' => array(
						'fields' => array(
							'id',
							'nombre'
						)
					)
				)
			)
		);
		$this->set('transporte',$transporte);

		$dia = date ('d');
		//$mes=date('m');
		$mes=date('F');
		$ano = date('Y');

		//	    if ($mes=="1") $mes="Enero";
		//	    if ($mes=="2") $mes="Febrero";
		//	    if ($mes=="3") $mes="Marzo";
		//	    if ($mes=="4") $mes="Abril";
		//	    if ($mes=="5") $mes="Mayo";
		//	    if ($mes=="6") $mes="Junio";
		//	    if ($mes=="7") $mes="Julio";
		//	    if ($mes=="8") $mes="Agosto";
		//	    if ($mes=="9") $mes="Setiembre";
		//	    if ($mes=="10") $mes="Octubre";
		//	    if ($mes=="11") $mes="Noviembre";
		//	    if ($mes=="12") $mes="Diciembre";
		$this->set(compact('dia'));
		$this->set(compact('mes'));
		$this->set(compact('ano'));

		$parte = $this->Transporte->Operacion->find(
			'first',
			array(
				'conditions' => array(
					'Operacion.id' => $transporte['Operacion']['id']
				),
				'recursive' => -1,
				'fields' => array(
					'id'
				),	
				'contain' => array(
					'Transporte' => array(
						'fields' => array(
							'id',
							'operacion_id'
						)
					)
				)
			)
		);
	}
=======

		)

	);
		$this->layout = null;
		$this->autoLayout = false;
		Configure::write('debug', '0');
		$this->response->download("export".date('Ymd').".csv");
	}

  /*  'Transporte.fecha_despacho_op'=> NULL
	);
	$this->paginate['contain'] = array(
		'Operacion' => array(
		'fields'=> array(
			'id',
			'referencia',
			'contrato_id',
		)
		),
		'PesoOperacion'=> array(
		'fields' =>array(
			'id',
			'peso',
			'cantidad_embalaje'
		)
		),
		'Contrato'=>array(
		'fields'=> array(
			'id',
			'fecha_transporte',
			'si_entrega',
			'proveedor_id'
		)
		),
		'Proveedor'=>array(
		'fields'=>array(
			'id',
			'nombre_corto'
		)
		),
		'PuertoDestino' => array(
		'fields' => array(
			'id',
			'nombre'
		)
		)
	);
   */
>>>>>>> 40113e7a4fcf47fde3d64a9963c895b51ae3f458
}
?>
