<?php
class AlmacenTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
		$this->set('almacentransportes', $this->paginate());
	}

	public function add() {

	if($this->request->is('post')):
		$this->request->data['AlmacenTransporte']['transporte_id'] = $this->params['named']['from_id'];
			if($this->AlmacenTransporte->save($this->request->data) ):
				$this->Session->setFlash('Cuenta corriente almacén guardada guardada');
				$this->redirect(array(
					'controller' => 'transportes',
					'action' => 'view',
					$this->params['named']['from_id']));
	endif;
		endif;

	$this->set('almacenes', $this->AlmacenTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	}

	public function edit($id = null) {
		if (!$id) {
			//throw new MethodNotAllowedException();
			$this->Session->setFlash('URL mal formado controller/edit '.$this->params['named']['from_controller'].' '.$this->params['named']['from_id']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action'=>'transportes'));
		}
		$this->AlmacenTransporte->id = $id;
		if($this->request->is('get')):
			$this->request->data = $this->AlmacenTransporte->read();
		else:
			if($this->AlmacenTransporte->save($this->request->data)):
				$this->Session->setFlash('Cuenta corriente almacén modificada');
				$this->redirect(array(
					'controller' => 'transportes',
					'action' => 'view',
					$id
				));
			else:
				$this->Session->setFlash('¡No se ha podido guardar!');
			endif;
		endif;

	$this->set('almacenes', $this->AlmacenTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	}

	public function delete($id) {
		if($this->request->is('post')):
			if($this->Contacto->delete($id)):
				$this->Session->setFlash('Cuenta corriente almacén borrada');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']
				));
			endif;
		else:
			throw new MethodNotAllowedException();
		endif;
	}



}

?>