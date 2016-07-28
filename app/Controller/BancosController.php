<?php
class BancosController extends AppController {

	public $class = 'Banco';

	public function index() {
		$this->bindCompany($this->class);
		$this->set('empresas', $this->paginate());
	}

	public function view($id = null) {
		$this->viewCompany($this->class, $id);
		$this->set(compact('id'));
	}

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Flash->error('error en URL');
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

	public function view_pdf($id = null) {
		$this->Banco->id = $id;
		if (!$this->Banco->exists()) {
			throw new NotFoundException(__('No existe banco con tal id'));
		}
		// increase memory limit in PHP
		ini_set('memory_limit', '512M');
		$this->set('banco', $this->Banco->read(null, $id));
	}
}
?>
