<?php
class ComisionesController extends AppController {
    public $paginate = array(
	'limit' => 20,
	'order' => array('Iva.valor' => 'asc')
    );

    public function index() {
	$params = array('order' => 'valor asc');
	$this->set('comisiones', $this->paginate());
    }

    public function add() {
	if($this->request->is('post')):
	    if($this->Comision->save($this->request->data) ):
		$this->Session->setFlash('Comisión guardada');
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => $this->params['named']['from_action']));
	    endif;
	endif;
    }

    public function edit($id = null) {
	$this->Comision->id = $id;
	if($this->request->is('get')):
	    $this->request->data = $this->Comision->read();
	else:
	    if($this->Comision->save($this->request->data)):
		$this->Session->setFlash('Iva '.$this->request->data['Comision']['valor'].' guardada');
	$this->redirect(array('action' => 'index'));
	    else:
		$this->Session->setFlash('Comision no guardada');
	    endif;
	endif;
    }
    public function delete($id) {
	if($this->request->is('get')):
	    throw new MethodNotAllowedException();
	else:
	    if($this->Comision->delete($id)):
		$this->Session->setFlash('Comision borrada');
		$this->redirect(array('action' => 'index'));
	    endif;
	endif;
    }
}
