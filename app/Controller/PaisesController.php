<?php
class PaisesController extends AppController {

    public function index() {
	//por defecto ordenar la lista por nombre de Agente
	$this->paginate['order'] => array('Pais.nombre' => 'asc');
	$this->set('paises', $this->paginate());
    }

    public function add() {
	if($this->request->is('post')):
	    if($this->Pais->save($this->request->data) ):
		$this->Session->setFlash('Pais guardado');
	$this->redirect(array(
	    'controller' => $this->params['named']['from_controller'],
	    'action' => $this->params['named']['from_action']));
endif;
endif;
    }
    public function addPopup() {
	if($this->request->is('post')):
	    if($this->Pais->save($this->request->data) ):
		$this->Session->setFlash('Pais guardado');
	$this->redirect(array(
	    'controller' => $this->params['named']['from_controller'],
	    'action' => $this->params['named']['from_action']));
endif;
endif;
    }
    public function edit($id = null) {
	$this->Pais->id = $id;
	if($this->request->is('get')):
	    $this->request->data = $this->Pais->read();
	else:
	    if($this->Pais->save($this->request->data)):
		$this->Session->setFlash('Pais '.$this->request->data['Pais']['nombre'].' guardado');
	$this->redirect(array('action' => 'index'));
	    else:
		$this->Session->setFlash('Pais no guardado');
endif;
endif;
    }
    public function delete($id) {
	if($this->request->is('get')):
	    throw new MethodNotAllowedException();
	else:
	    if($this->Pais->delete($id)):
		$this->Session->setFlash('Pais borrado');
	$this->redirect(array('action' => 'index'));
endif;
endif;
    }
}
