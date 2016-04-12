<?php
class AgentesController extends AppController {

    public $class = 'Agente';

    public function index() {
	$this->bindCompany($this->class);
	$this->set('empresas', $this->paginate());
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado '.$this->class.'/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$this->viewCompany($this->class, $id);
	$this->set(compact('id'));
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => Inflector::tableize($this->class)
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->formCompany($this->class, $id);
    }

    public function delete( $id = null) {
	$this->deleteCompany($this->class, $id);
    }
}
?>
