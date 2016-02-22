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
	if($transporte['Transporte']['id']!= NULL){
	    $suma = 0;
	    $almacenado=0;
	    foreach ($transporte['AlmacenTransporte'] as $suma):
	        if ($almacenTransporte['transporte_id'] = $transporte['Transporte']['id']):
	            $almacenado = $almacenado + $suma['cantidad_cuenta'];
	        endif;
	    endforeach;
	}
	$this->set('almacenado',$almacenado);
	
	$embalaje = $transporte['Operacion']['Embalaje']['nombre'];	
	$this->set('embalaje',$embalaje);
    }
    public function add() {
	$this->form($this->params['named']['from_id']);
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
	if (!$id) {
	    $this->Session->setFlash('URL mal formado controller/add '.$id);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => 'view'));
	}

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
	$operacion = $this->Transporte->Operacion->find(
		'first', 
		array(
	    'conditions' => array(
	    	'Operacion.id' => $id
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
	$this->set('operacion',$operacion);
	//Calculo la cantidad de bultos transportados
	if($operacion['Operacion']['id']!= NULL) {
	    $suma = 0;
	    $transportado=0;
	    foreach ($operacion['Transporte'] as $suma){
		if ($transporte['operacion_id']=$operacion['Operacion']['id']) {
		    $transportado = $transportado + $suma['cantidad_embalaje'];
		}
	    }
	}
	$this->set('transportado',$transportado);
	//NO NECESARIO SE PASA A INDEX LINEA TRANSPORTE
	$almacenaje = $this->Transporte->AlmacenTransporte->find(
		'first', 
		array(
	    'conditions' => array(
	    	'Transporte.id' => $id
	    	),
	    'recursive' => 2,
	    'fields' => array(
			'cantidad_cuenta',
			'cuenta_almacen'
			)
	    )
	);
	$this->set('almacenajes',$almacenaje);		
	if($this->request->is('post')){
	    //al guardar la linea, se incluye a qué operacion pertenece
	    $this->request->data['Transporte']['operacion_id'] = $id;
	    if($this->request->data['Transporte']['cantidad_embalaje'] <= ($operacion['PesoOperacion']['cantidad_embalaje'] - $transportado)){
		if($this->Transporte->save($this->request->data)){
		    $this->Session->setFlash('Línea de transporte guardada');
		    $this->redirect(array(
			'controller' => $this->params['named']['from_controller'],
			'action' => 'view_trafico',
			$id
		    ));
		}else{
		    $this->Session->setFlash('Línea de transporte NO guardada');
		}
	    }else{
		$this->Session->setFlash('La cantidad de bultos debe ser inferior');
	    }
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
}
?>