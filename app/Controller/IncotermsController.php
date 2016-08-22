<?php
class IncotermsController extends AppController {

	public function index() {
		$paginate['order'] = array('Incoterm.nombre' => 'asc');
		$params = array('order' => 'nombre asc');
		$this->set('incoterms', $this->paginate());
	}

	public function add() {
		if($this->request->is('post')):
			if($this->Incoterms->save($this->request->data) ):
				$this->Flash->success('Incoterm guardado');
		$this->redirect(array(
			'controller' => $this->params['named']['from_controller'],
			'action' => $this->params['named']['from_action']));
endif;
endif;
	}
	public function edit($id = null) {
		$this->Incoterm->id = $id;
		if($this->request->is('get')) {
			$this->request->data = $this->Incoterm->read();
		} else {
			if($this->Incoterm->save($this->request->data)) {
				$this->Flash->success('Incoterm '.$this->request->data['Incoterm']['nombre'].' guardado');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error('Incoterm no guardado');
			}
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->Incoterm->id = $id;
		if (!$this->Incoterm->exists()) {
			throw new NotFoundException(__('Incoterm inválido'));
		}
		if($this->Incoterm->delete($id)) {
			$this->Flash->success('Inconterm borrado');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('Incoterm NO borrado'));
		return $this->History->back(0);
	}
}
?>