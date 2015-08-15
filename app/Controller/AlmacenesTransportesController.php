<?php
class AlmacenesTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
		$this->set('almacenestransportes', $this->paginate());
	}

	public function add() {

	if($this->request->is('post')){
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado AlmacenesTransportes/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'view'));
		}
	}

	$this->set('almacenes', $this->AlmacenesTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	$this->set('almacenestransportes', $this->AlmacenesTransporte->Almacen->find('list'));

	}

}?>