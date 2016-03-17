<?php
class TransportesController extends AppController {

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formada Transporte/view ');
	    $this->redirect(array('action'=>'index_trafico'));
	}
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
	$navieras = $this->Naviera->find('list',
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
	$agentes = $this->Agente->find('list',
		array(
		    'fields' => array(
				'Agente.id',
				'Empresa.nombre_corto'),
		    'recursive' => 1)
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
	$almacenes = $this->Almacen->find('list',array(
	    'fields' => array(
		'Almacen.id',
		'Empresa.nombre_corto'),
	    'recursive' => 1)
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
				'cantidad_embalaje'
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
	   	'Contrato' => array(
	   		'fields' => array(
			    'id'
			),
	   		'Incoterm'=>array(
	   			'fields'=> array(
	   				'nombre')
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
		'conditions' => array( 'Pais.nombre' => 'España')
	    )));		
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
	if (!empty($id))$this->Transporte->id = $id;
	
	if (!empty($this->request->data)) {//ES UN POST
		$this->request->data['Transporte']['id'] = $id;
		$this->request->data['Transporte']['operacion_id'] = $operacion_id;
		

		//if($this->request->data['Transporte']['cantidad_embalaje'] <= $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado && $id == NULL){
		if($id == NULL){
				if($this->Transporte->save($this->request->data)){
						$this->Session->setFlash('Línea de transporte guardada');
						$this->redirect(array(
							'controller' => 'operaciones',
							'action' => 'view_trafico',
							$operacion_id
						));
				}else{
		 			$this->Session->setFlash('Línea de transporte NO guardada');
			    }
		}else{
			//	if(($this->request->data['Transporte']['cantidad_embalaje'] <= $transporte['Transporte']['cantidad_embalaje']) xor
			//		($this->request->data['Transporte']['cantidad_embalaje'] > $transporte['Transporte']['cantidad_embalaje'] &&
			//		 $this->request->data['Transporte']['cantidad_embalaje'] - $transporte['Transporte']['cantidad_embalaje'] <= $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado) xor
			//		 ($transporte['Transporte']['cantidad_embalaje'] == NULL)){
						if($this->Transporte->save($this->request->data)){
								$this->Session->setFlash('Línea de transporte modificada');
								$this->redirect(array(
									'controller' => 'transportes',
									'action' => 'view',
									$id
								));
							}
				}		
	//	}else{
	//		$this->Session->setFlash('La cantidad de bultos debe ser inferior');
	//	    }
	}else{//es un GET
	     $this->request->data = $this->Transporte->read(null, $id);
	}

}
    public function delete($id = null) {
	if (!$id or $this->request->is('get')) :
	    throw new MethodNotAllowedException();
	endif;
	if ($this->Transporte->delete($id)):
	    $this->Session->setFlash('Línea de transporte borrada');
	$this->redirect(array(
	    'controller' => 'operaciones',
	    'action' => 'view_trafico',
	    $this->params['named']['from_id']
	));
	endif;
    }

    public function situacion() {
    $this->pdfConfig = array(
		'filename' => 'situacion',
		'paperSize' => 'A4',
        'orientation' => 'landscape',
	);
//	$invoice = $this->Invoice->find('first', array('conditions' => array('id' => $id)));
//	$this->set(compact('invoice');


	$this->paginate['order'] = array('CalidadNombre.nombre' => 'asc');
	$this->paginate['recursive'] = 2;
	$this->paginate['condition'] = array(
	    'Transporte.fecha_despacho_op'=> NULL
		);		
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
					),	
		    	'Contrato'=>array(	
					'fields'=> array(
					    'id',
					    'fecha_transporte',
					    'si_entrega',
						    ),
					'Proveedor'=>array(
					    'id',
					    'nombre_corto'
					),
					'CalidadNombre' => array(
				    	'fields' =>(
						'nombre'
				    	)
				    )
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
}
?>