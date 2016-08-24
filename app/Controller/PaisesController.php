<?php
class PaisesController extends AppController {

	public function index() {
		//por defecto ordenar la lista por nombre de Agente
		$this->paginate['order'] = array('Pais.nombre' => 'asc');
		$this->set('paises', $this->paginate());
	}

	public function add() {
		if($this->request->is('post')) {
			if($this->Pais->save($this->request->data) ) {
				$this->Flash->success('Pais guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			}
		}
	}

	public function addPopup() {
		if($this->request->is('post')) {
			if($this->Pais->save($this->request->data) ) {
				$this->Flash->success('Pais guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			}
		}
	}

	public function edit($id = null) {
		$this->Pais->id = $id;
		if($this->request->is('get')) {
			$this->request->data = $this->Pais->read();
		} else {
			if($this->Pais->save($this->request->data)) {
				$this->Flash->success('Pais '.$this->request->data['Pais']['nombre'].' guardado');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error('Pais no guardado');
			}
		}
	}

	public function delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		} else {
			if($this->Pais->delete($id)) {
				$this->Flash->success('Pais borrado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
