<?php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {

    public function index() {
	$this->Usuario->recursive = 0;
	$this->set('usuarios', $this->paginate());
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->set('action', $this->action);
	//necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
	$this->set('departamentos',$this->Usuario->Departamento->find('list'));

	if (!empty($id)) {
	    $this->Usuario->id = $id;
	    if (!$this->Usuario->exists()) {
		throw new NotFoundException(__('Usuario inexistente'));
	    }
	}
	if ($this->request->is('post')){
	    if($this->Usuario->save($this->request->data)) {
		$this->Flash->success(__('El usuario se ha guardado'));
		return $this->redirect(array('action' => 'index'));
	    }
	    $this->Flash->error(__('El usuario NO se ha guardado'));
	} else { //es un GET
	    $this->request->data= $this->Usuario->findById($id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) {
	    throw new MethodNotAllowedException();
	}
	if ($this->Usuario->delete($id)) {
	    $this->Flash->set('Usuario borrado');
	    $this->redirect(array(
		'controller' => 'usuarios',
		'action'=>'index',
	    ));
	}
    }

    public function view_pdf($id = null) {
	$this->Usuario->id = $id;
	if (!$this->Usuario->exists()) {
	    throw new NotFoundException(__('Usuario inexistente'));
	}
	// increase memory limit in PHP 
	ini_set('memory_limit', '512M');
	$this->set('usuario', $this->Usuario->findById($id));
    }
}
?>
