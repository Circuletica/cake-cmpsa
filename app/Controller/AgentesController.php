<?php
class AgentesController extends AppController {

    public $class = 'Agente';

    public function index() {
	$this->bindCompany($this->class);
	$this->set('empresas', $this->paginate());
    }

    public function view($id = null) {
	if (!$id)
	    throw new NotFoundException(__('URL mal formado Agentes/view'));
	$this->viewCompany($this->class, $id);
	$this->set(compact('id'));
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Flash->set('error en URL');
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
