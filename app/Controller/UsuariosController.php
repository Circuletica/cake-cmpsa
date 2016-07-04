<?php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('add','logout');
        $this->Auth->allow('logout');
    }
    
    public function index() {
	$this->Usuario->recursive = 0;
	$this->set('usuarios', $this->paginate());
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	$this->Usuario->id = $id;
	if (!$this->Usuario->exists()) {
	    throw new NotFoundException(__('Usuario inexistente'));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->Usuario->id = $id;
	$this->set('action', $this->action);
	//necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
	$this->set('departamentos',$this->Usuario->Departamento->find('list'));

	if ($this->request->is('post')){
	    if (!$this->Usuario->exists()) {
		$this->Usuario->create();
	    }
	    if($this->Usuario->save($this->request->data)) {
		$this->Flash->success(__('El usuario se ha guardado'));
		return $this->redirect(array('action' => 'index'));
	    }
	    $this->Flash->error(__('El usuario NO se ha guardado'));
	} else { //es un GET
	    $this->request->data= $this->Usuario->findById($id);
	    unset($this->request->data['Usuario']['password']);
	}
    }

    public function delete($id = null) {
	$this->request->allowMethod('post');
	$this->Usuario->id = $id;
	if (!$this->Usuario->exists()) {
	    throw new NotFoundException(__('Usuario inexistente'));
	}
	if ($this->Usuario->delete()) {
	    $this->Flash->success(__('El usuario ha sido borrado'));
	    return $this->redirect(array('action' => 'index'));
	}
	$this->Flash->error(__('El usuario NO ha sido borrado'));
	return $this->redirect(array('action' => 'index'));
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

    public function login() {
	if ($this->request->is('post')) {
	    if ($this->Auth->login()) {
		return $this->redirect($this->Auth->redirectUrl());
	    }
	    $this->Flash->error(__('Usuario o contrasena incorrectos, intentelo de nuevo'));
	}
    }

    public function logout() {
	return $this->redirect($this->Auth->logout());
    }
}
?>
