<?php
class ContactosController extends AppController {
	var $name = 'Contactos';
	function index() {
		$this->set('contactos', $this->Contacto->find('all'));
		$this->set('empresas', $this->Contacto->Empresa->find('list'));
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Flash->error('URL mal formado Contactos/add '.$this->params['named']['from_controller']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'index'
			));
		}
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		//		$this->Contacto->id = $id;
		//		if (!$this->Contacto->exists()) {
		//			throw new NotFoundException(__('Contacto inválido'));
		//		}
		if (!$id && empty($this->request->data)) {
			$this->Flash->error('error en URL Contactos/edit');
			$this->redirect(array(
				'action' => 'index',
				'controller' => $this->params['named']['from_controller'],
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) {
		$this->set('action', $this->action);
		$empresa_id = $this->params['named']['from_id'];
		//necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
		$this->set(
			'empresa',
			$this->Contacto->Empresa->findById($empresa_id)
		);
		$this->set('departamentos',$this->Contacto->Departamento->find('list'));

		if (!empty($id)) {
			$this->Contacto->id = $id;
			$contacto = $this->Contacto->findById($id);
			$this->set('referencia', $contacto['Contacto']['nombre']);
		}
		if ($this->request->is(array('post','put'))){  //es un POST
			$this->request->data['Contacto']['empresa_id'] = $empresa_id;
			if($this->Contacto->save($this->request->data)) {
				$this->Flash->success('Contacto guardado');
				return $this->History->back(-1);
			} 
			$this->Flash->error('Contacto NO guardado');
			return $this->History->Back(0);
		} else { //es un GET
			$this->request->data= $this->Contacto->read(null, $id);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');
		//el $id es del contacto, sacamos el id y la clase de empresa de la URL
		$this->Contacto->id = $id;
		if(!$this->Contacto->exists()) throw new NotFoundException(__('Contacto inválido'));;
		if($this->Contacto->delete()) {
			$this->Flash->success('Contacto borrado');
			return $this->History->Back(0);
		}
		$this->Flash->error('Contacto NO borrado');
		return $this->History->Back(0);
	}
}
?>