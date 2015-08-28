<?php
class PrecioFletesController extends AppController {
	function index() {
		$this->set('precio_fletes', $this->PrecioFlete->find('all'));
	}
	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado controller/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'index'));
		}
		//necesitamos el nombre del flete para el breadcrumb y el título de la vista
		$flete = $this->PrecioFlete->Flete->find('first',
			array(
				'conditions' => array('Flete.id' => $this->params['named']['from_id']),
				'recursive' => -1
		));
		$this->set('flete',$flete);
		if($this->request->is('post')):
			$this->request->data['PrecioFlete']['flete_id'] = $this->params['named']['from_id'];
			if($this->PrecioFlete->save($this->request->data) ):
				$this->Session->setFlash('Precio de flete guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from'],
					'action' => 'view',
					$this->params['named']['from_id']
				));
			endif;
		endif;
	}

	//el $id es del precio del flete
	public function delete($id) {
		if($this->request->is('post')):
			if($this->PrecioFlete->delete($id)):
				$this->Session->setFlash('Precio de flete borrado');
				$this->redirect(array(
					'controller' => $this->params['named']['from'],
					'action' => 'view',
					$this->params['named']['from_id']
				));
			endif;
		else:
			throw new MethodNotAllowedException();
		endif;
	}

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado controller/edit '.$this->params['named']['from'].' '.$this->params['named']['from_id']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action'=>'index'));
		}
		$flete = $this->PrecioFlete->Flete->find('first',
			array(
				'conditions' => array('Flete.id' => $this->params['named']['from_id']),
				'recursive' => -1
		));
		$this->set('flete',$flete);
		$this->PrecioFlete->id = $id;
		if($this->request->is('get')):
			$this->request->data = $this->PrecioFlete->read();
		else:
			if($this->PrecioFlete->save($this->request->data)):
				$this->Session->setFlash('Precio de flete modificado');
				$this->redirect(array(
					'controller' => $this->params['named']['from'],
					'action' => 'view',
					$this->params['named']['from_id']));
			else:
				$this->Session->setFlash('No se ha podido guardar!');
			endif;
		endif;
	}
}
?>
