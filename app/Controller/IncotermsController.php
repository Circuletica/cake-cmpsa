<?php
class IncotermsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session');
	public $paginate = array(
		'limit' => 10,
		'order' => array('Incoterms.nombre' => 'asc')
	);

	public function index() {
		$params = array('order' => 'nombre asc');
		//$this->set('Incoterms', $this->Incoterms->find('all', $params));
		$this->set('incoterms', $this->paginate());
	}
	public function add() {
		if($this->request->is('post')):
			if($this->Incoterms->save($this->request->data) ):
				$this->Flash->set('Incoterm guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			endif;
		endif;
	}
	public function edit($id = null) {
		$this->Incoterms->id = $id;
		if($this->request->is('get')):
			$this->request->data = $this->Incoterms->read();
		else:
			if($this->Incoterms->save($this->request->data)):
				$this->Flash->set('Incoterms '.$this->request->data['Incoterms']['nombre'].' guardado');
		$this->redirect(array('action' => 'index'));
			else:
				$this->Flash->set('Incoterms no guardado');
endif;
endif;
	}
	public function delete($id) {
		if($this->request->is('get')):
			throw new MethodNotAllowedException();
		else:
			if($this->Incoterms->delete($id)):
				$this->Flash->set('Inconterms borrado');
		$this->redirect(array('action' => 'index'));
endif;
endif;
	}
}




?>
