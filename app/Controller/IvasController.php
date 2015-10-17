<?php
class IvasController extends AppController {
    public $paginate = array(
	'limit' => 20,
	'order' => array('Iva.valor' => 'asc')
    );

    public function index() {
	$params = array('order' => 'valor asc');
	$this->set('ivas', $this->paginate());
    }

    public function add() {
	if($this->request->is('post')):
	    if($this->Iva->save($this->request->data) ):
		$this->Session->setFlash('Iva guardado');
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => $this->params['named']['from_action']));
	    endif;
	endif;
    }

    public function edit($id = null) {
	$this->Iva->id = $id;
	if($this->request->is('get')):
	    $this->request->data = $this->Iva->read();
	else:
	    if($this->Iva->save($this->request->data)):
		$this->Session->setFlash('Iva '.$this->request->data['Iva']['valor'].' guardado');
	$this->redirect(array('action' => 'index'));
	    else:
		$this->Session->setFlash('Iva no guardado');
	    endif;
	endif;
    }
    public function delete($id) {
	if($this->request->is('get')):
	    throw new MethodNotAllowedException();
	else:
	    if($this->Iva->delete($id)):
		$this->Session->setFlash('Iva borrado');
		$this->redirect(array('action' => 'index'));
	    endif;
	endif;
    }
}
