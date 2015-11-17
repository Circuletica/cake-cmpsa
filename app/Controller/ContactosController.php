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
			$this->Session->setFlash('URL mal formado controller/add '.$this->params['named']['from_controller']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'index'));
		}
		//necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
		$empresa = $this->Contacto->Empresa->find('first',
			array(
				'conditions' => array('Empresa.id' => $this->params['named']['from_id']),
				'recursive' => -1,
				'fields' => array('Empresa.id','Empresa.nombre')
		));
		$this->set('empresa',$empresa);
		if($this->request->is('post')):
			$this->request->data['Contacto']['empresa_id'] = $this->params['named']['from_id'];
			if($this->Contacto->save($this->request->data) ):
				$this->Session->setFlash('Contacto guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']
				));
			endif;
		endif;
	}

	//el $id es del contacto, sacamos el id y la clase de empresa de la URL
	public function delete($id) {
		if($this->request->is('post')):
			if($this->Contacto->delete($id)):
				$this->Session->setFlash('Contacto borrado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']
				));
			endif;
		else:
			throw new MethodNotAllowedException();
		endif;
	}

	public function edit($id = null) {
		if (!$id) {
			//throw new MethodNotAllowedException();
			$this->Session->setFlash('URL mal formado controller/edit '.$this->params['named']['from_controller'].' '.$this->params['named']['from_id']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action'=>'index'));
		}
		$this->Contacto->id = $id;
		if($this->request->is('get')):
			$this->request->data = $this->Contacto->read();
		else:
			if($this->Contacto->save($this->request->data)):
				$this->Session->setFlash('Contacto modificado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']));
			else:
				$this->Session->setFlash('No se ha podido guardar!');
			endif;
		endif;
	}
}
?>
