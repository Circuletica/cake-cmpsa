<?php
class TransportesController extends AppController {
		public function index() {
		//$this->Calidad->recursive = 1;
		//$this->Calidad->setSource('CalidadNombre');
		$this->set('transportes', $this->paginate());

		}

public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formada Transporte/view ');
			$this->redirect(array('action'=>'index_trafico'));
		}
		
		$transporte = $this->Transporte->find('first',array(
			'conditions' => array('Transporte.id' => $id),
			'recursive' => 2));

		$this->set('transporte',$transporte);
		/*$embalaje = $this->Transporte->Operacion->Contrato->ContratoEmbalaje->find(
			'first',
			array(
			'fields' => array('Embalaje.nombre')
			)
		);*/
		$embalaje = $transporte['Operacion']['Embalaje']['nombre'];	
		$this->set('embalaje',$embalaje);

		$almacenes = $this->Transporte->AlmacenTransporte->Almacen->find('list');
	    $this->set('almacenes',$almacenes);
	}


    public function add() {
	$this->form($this->params['named']['from_id']);
	$this->render('form');
    }
  /*  public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'view_trafico',
		'controller' => $this->params['named']['from_controller'],
		$this->params['from_id']
	    ));
	$this->form($id);
	$this->render('form');
    }*/

    public function form($id) { //esta acción vale tanto para edit como add
	if (!$id) {
			$this->Session->setFlash('URL mal formado controller/add '.$id);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'view'));
		}
	//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos
	$operacion = $this->Transporte->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3,
			'fields' => array(
				'Operacion.id',
				'Operacion.precio_compra',
				'Operacion.referencia',
				'Operacion.embalaje_id')
		));
	

		//opcion 1 = 2 queries
	//	$transportes = $this->Transporte->find('all');
	//	$contrato_embalajes = $this->Transporte->Operacion->Contrato->ContratoEmbalaje->find('all');

		//opcion 2 = 1 query
	//	$transportes = $this->Transporte->find('all');
	//	$contrato_embalajes = $transportes['Operacion']['Contrato']['ContratoEmbalaje'];

		$this->set('action', $this->action);

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

		//Listamos navieras
		$this->loadModel('Naviera');	
		$navieras = $this->Naviera->find('list',
			array(
			'fields' => array(
				'Naviera.id',
				'Empresa.nombre_corto'),
			'recursive' => 1)
			);
 		$this->set(compact('navieras'));

		$this->loadModel('Agente');
		$agente = $this->Agente->find('list',array(
			'fields' => array(
				'Agente.id',
				'Empresa.nombre_corto'),
			'recursive' => 1)
		);
 		$this->set(compact('agentes'));

		$this->set('almacenes', $this->Transporte->AlmacenTransporte->Almacen->find('list'));
		$this->set('almacen_transportes', $this->Transporte->AlmacenTransporte->Almacen->find('list'));
		//$this->set('marca_almacenes', $this->Transporte->AlmacenesTransporte->MarcaAlmacen->find('list'));
		$this->set('aseguradoras', $this->Transporte->Aseguradora->find('list', array(
			'fields' => array(
				'Aseguradora.id',
				'Aseguradora.nombre_corto'),
			'recursive' => 1))
		);

		$this->set('operacion',$operacion);
		$transporte = $this->Transporte->find('all');	
		$this->set('transporte',$transporte);
//Calculo la cantidad de bultos transportados
    if($operacion['Operacion']['id']!= NULL):
    $suma = 0;
    $transportado=0;
        foreach ($operacion['Transporte'] as $suma):
            if ($transporte['operacion_id']=$operacion['Operacion']['id']):
            $transportado = $transportado + $suma['cantidad_embalaje'];
            endif;
        endforeach;
    endif;
    $this->set('transportado',$transportado);


//NO NECESARIO SE PASA A INDEX LINEA TRANSPORTE
		$almacenaje = $this->Transporte->AlmacenTransporte->find('first', array(
			'conditions' => array('Transporte.id' => $id),
			'recursive' => 2,
			'fields' => array(
				'AlmacenTransporte.cantidad_cuenta',
				'AlmacenTransporte.cuenta_almacen')
		));
		$this->set('almacenajes',$almacenaje);		



		if($this->request->is('post')){
			//al guardar la linea, se incluye a qué operacion pertenece
			//debug($this->params['named']['from_id']);
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

//PENDIENTE DE CAMBIAR POR EL FORM

public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formada');
			$this->redirect(array(
					'controller' => 'operaciones',
					'action' => 'view_trafico',
					$this->params['named']['from_id']));
		}
		$this->Transporte->id = $id;
		//$transporte = $this->Transporte->find('all');	

		//$this->set('transporte',$transporte);

		$embalaje = $this->Transporte->Operacion->Contrato->ContratoEmbalaje->find(
			'first',
			array(
				'fields' => array('Embalaje.nombre')
			)
		);	
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
	//	$this->set('navieras', $this->Transporte->Naviera->find('list'));
	//	$this->set('agentes', $this->Transporte->Agente->find('list'));
		$this->set('almacenes', $this->Transporte->AlmacenTransporte->Almacen->find('list'));
		$this->set('almacen_transportes', $this->Transporte->AlmacenTransporte->Almacen->find('list'));
		$this->set('aseguradoras', $this->Transporte->Aseguradora->find('list'));
	//sacamos los datos de la operacion  al que pertenece la linea
		$operacion = $this->Transporte->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3,
			'fields' => array(
				'Operacion.id',
				'Operacion.precio_compra',
				'Operacion.referencia')
		));
		$this->set('operacion',$operacion);



		$almacenaje = $this->Transporte->AlmacenTransporte->find('first', array(
			'conditions' => array('Transporte.id' => $id),
			'recursive' => 2
		));
		$this->set('almacenajes',$almacenaje);	

		if($this->request->is('get')): //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->Transporte->read();
		else:
			if ($this->Transporte->save($this->request->data)):	
				$this->Session->setFlash('Transporte '.
				$this->request->data['Transporte']['matricula'].
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