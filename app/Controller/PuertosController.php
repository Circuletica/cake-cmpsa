<?php
class PuertosController extends AppController {
	public $paginate = array(
		'limit' => 10,
		'order' => array('Puertos.nombre' => 'asc')
	);

	public function index() {
		$params = array('order' => 'nombre asc');
		$this->set('puertos', $this->paginate());
	}
	public function add() {
		$this->set('paises', $this->Puerto->Pais->find('list'));
		if($this->request->is('post')):
			if($this->Puerto->save($this->request->data) ):
				$this->Session->setFlash('Puerto guardado');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			endif;
		endif;
	}


public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$puerto = $this->Puerto->find('first',array(
		'conditions' => array('Puerto.id' => $id)));
		$this->set('puerto',$puerto);
		$this->Puerto->id = $id;
		$this->set('paises', $this->Puerto->Pais->find('list'));

		if($this->request->is('get')):
			$this->request->data = $this->Puerto->read();
		else:
			if  ($this->Puerto->save($this->request->data)):
				$this->Session->setFlash('Puerto '.
				$this->request->data['Puerto']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'index', $id));
			else:
				$this->Session->setFlash('Puerto NO guardado');
			endif;
		endif;
	}
	public function delete($id) {
		if($this->request->is('get')):
			throw new MethodNotAllowedException();
		else:
			if($this->Puerto->delete($id)):
				$this->Session->setFlash('Puerto borrado');
		$this->redirect(array('action' => 'index'));
endif;
endif;
	}
}




?>
