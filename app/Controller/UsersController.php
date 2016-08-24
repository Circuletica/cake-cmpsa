<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('add','logout');
		$this->Auth->allow('logout');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inexistente'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('El usuario se ha guardado'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(
				__('El usuario NO se ha guardado.')
			);
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inexistente'));
		}
		if ($this->request->is(array('post','put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('El usuario se ha guardado'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error( __('El usuario NO se ha guardado'));
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inexistente'));
		}
		if ($this->User->delete()) {
			$this->Flash->success(__('El usuario ha sido borrado'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('El usuario NO ha sido borrado'));
		return $this->redirect(array('action' => 'index'));
	}
}
?>