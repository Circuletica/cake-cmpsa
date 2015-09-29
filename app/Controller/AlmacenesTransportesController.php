<?php
class AlmacenesTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
		$this->set('almacenestransportes', $this->paginate());
	}

	public function add() {

	if($this->request->is('post')):
		$this->request->data['AlmacenesTransporte']['transporte_id'] = $this->params['named']['from_id'];
			if($this->AlmacenesTransporte->save($this->request->data) ):
				$this->Session->setFlash('Cuenta corriente almacén guardada guardada');
				$this->redirect(array(
					'controller' => 'transportes',
					'action' => 'view',
					$this->params['named']['from_id']));
	endif;
		endif;

	$this->set('almacenes', $this->AlmacenesTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	}

}

?>