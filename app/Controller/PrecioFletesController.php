<?php
class PrecioFletesController extends AppController {

	public function index() {
		$this->set('precio_fletes', $this->PrecioFlete->find('all'));
	}

	public function add() {
		$from_controller = $this->params['named']['from_controller'];
		if (!$this->params['named']['from_id']) {
			$this->Flash->set('URL mal formado controller/add '.$from_controller);
			$this->redirect(array(
				'controller' => $from_controller,
				'action' => 'index'));
		}
		//el id y la clase de la entidad de origen vienen en la URL
		$from_id = $this->params['named']['from_id'];
		//necesitamos el nombre del flete para el breadcrumb y el título de la vista
		$flete = $this->PrecioFlete->Flete->find('first',
			array(
				'conditions' => array('Flete.id' => $from_id),
				'recursive' => -1
			));
		$this->set('flete',$flete);
		if($this->request->is('post')):
			$this->request->data['PrecioFlete']['flete_id'] = $from_id;
		if($this->PrecioFlete->save($this->request->data) ):
			$this->Flash->set('Precio de flete guardado');
		$this->redirect(array(
			'controller' => $from_controller,
			'action' => 'view',
			$from_id
		));
endif;
endif;
	}

	//el $id es del precio del flete
	public function delete($id) {
		if($this->request->is('get'))
			throw new MethodNotAllowedException();
		if($this->PrecioFlete->delete($id)) {
			$this->Flash->set('Precio de flete borrado');
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'view',
				$this->params['named']['from_id']
			));
		} else {
			$this->Flash->set('Precio de flete NO borrado');
			$this->History->Back(0);
		}
	}

	public function edit($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		$from_controller = $this->params['named']['from_controller'];
		$from_id = $this->params['named']['from_id'];
		if (!$id) 
			throw new NotFoundException(__('URL mal formado Contrato/view'));
		$flete = $this->PrecioFlete->Flete->find('first',
			array(
				'conditions' => array('Flete.id' => $from_id),
				'recursive' => -1
			));
		$this->set('flete',$flete);
		$this->PrecioFlete->id = $id;
		if($this->request->is('get')) {
			$this->request->data = $this->PrecioFlete->read();
		} else {
			if($this->PrecioFlete->save($this->request->data)) {
				$this->Flash->set('Precio de flete modificado');
				$this->redirect(array(
					'controller' => $from_controller,
					'action' => 'view',
					$from_id));
			} else {
				$this->Flash->set('No se ha podido guardar!');
			}
		}
	}
}
?>
