<?php
class IncotermsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session');

	public function index() {
		$paginate['order'] = array('Incoterm.nombre' => 'asc');
		$params = array('order' => 'nombre asc');
		$this->set('incoterms', $this->paginate());
	}

	public function add() {
		if($this->request->is('post')) {
			if($this->Incoterm->save($this->request->data) ) {
				$this->Flash->success('Incoterm guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			}
		}
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
				$this->Flash->set('Incoterm no guardado');
			}
		}
	}

	public function delete($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		} else {
			if($this->Incoterm->delete($id)) {
				$this->Flash->set('Inconterm borrado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
?>