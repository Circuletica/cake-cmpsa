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

		$embalaje = $this->Transporte->EmbalajeTransporte->find(
			'first',
			array(
				'fields' => array('Embalaje.nombre', 'EmbalajeTransporte.cantidad')
			)
		);		
		$this->set('embalaje',$embalaje);


	}

	public function add() {

		if($this->request->is('post')):
			//al guardar la linea, se incluye a qué operacion pertenece
			//debug($this->params['named']['from_id']);
			$this->request->data['Transporte']['operacion_id'] = $this->params['named']['from_id'];
			if($this->Transporte->save($this->request->data) ):
				$this->Session->setFlash('Línea de transporte guardada');
				$this->redirect(array(
					'controller' => 'operaciones',
					'action' => 'view_trafico',
					$this->params['named']['from_id']));
			endif;
		endif;


//		$this->set('embalaje', $this->Transporte->Operacion->Embalaje->find('list'));
		$this->set('puertos', $this->Transporte->Puerto->find('list'));
		
//		$incoterm = $this->Transporte->Operacion->Contrato->Incoterm->find('first', array(
//			'conditions' => array('Operacion.id' => $this->params['named']['from_id']),
//			'recursive' =>3,
//			'fields' => array(
//				'Incoterm.id',
//				'Incoterms.nombre')
//		));
//		$this->set('incoterm',$incoterm);
		$this->set('embalajes', $this->Transporte->EmbalajeTransporte->Embalaje->find('list'));
		$this->set('navieras', $this->Transporte->Naviera->find('list',array(
			'fields' => array('Naviera.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('agentes', $this->Transporte->Agente->find('list',array(
			'fields' => array('Agente.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('almacenes', $this->Transporte->AlmacenesTransporte->Almacen->find('list', array(
			'fields' => array('Almacen.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('almacenes_transportes', $this->Transporte->AlmacenesTransporte->Almacen->find('list'));
		//$this->set('marca_almacenes', $this->Transporte->AlmacenesTransporte->MarcaAlmacen->find('list'));
		$this->set('aseguradoras', $this->Transporte->Aseguradora->find('list', array(
			'fields' => array('Aseguradora.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$embalaje_transporte = $this->Transporte->EmbalajeTransporte->find('all');
		$this->set('embalaje_transportes',$embalaje_transporte);
	//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$operacion = $this->Transporte->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $this->params['named']['from_id']),
			'recursive' => 3,
			'fields' => array(
				'Operacion.id',
				'Operacion.precio_compra',
				'Operacion.referencia')
		));
		$this->set('operacion',$operacion);

		$transporte = $this->Transporte->find('all');	
		$this->set('transporte',$transporte);
//NO NECESARIO SE PASA A INDEX LINEA TRANSPORTE
		$almacenaje = $this->Transporte->AlmacenesTransporte->find('first', array(
			'conditions' => array('Transporte.id' => $this->params['named']['from_id']),
			'recursive' => 2,
			'fields' => array(
				'AlmacenesTransporte.cantidad_cuenta',
				'AlmacenesTransporte.cuenta_almacen')
		));
		$this->set('almacenajes',$almacenaje);		


	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formada');
			$this->redirect(array(
					'controller' => 'operaciones',
					'action' => 'view_trafico',
					$this->params['named']['from_id']));
		}
		$this->Transporte->id = $id;
		$this->set('puertos', $this->Transporte->Puerto->find('list'));
		$this->set('navieras', $this->Transporte->Naviera->find('list',array(
			'fields' => array('Naviera.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('agentes', $this->Transporte->Agente->find('list',array(
			'fields' => array('Agente.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('almacenes', $this->Transporte->AlmacenesTransporte->Almacen->find('list', array(
			'fields' => array('Almacen.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
		$this->set('almacenes_transportes', $this->Transporte->AlmacenesTransporte->Almacen->find('list'));
		//$this->set('marca_almacenes', $this->Transporte->AlmacenesTransporte->MarcaAlmacen->find('list'));
		$this->set('aseguradoras', $this->Transporte->Aseguradora->find('list', array(
			'fields' => array('Aseguradora.id','Empresa.nombre_corto'),
			'recursive' => 1))
		);
	//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$operacion = $this->Transporte->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 2
		));
		$this->set('operacion',$operacion);

		$transporte = $this->Transporte->find('all');	
		$this->set('transporte',$transporte);

		$almacenaje = $this->Transporte->AlmacenesTransporte->find('first', array(
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
