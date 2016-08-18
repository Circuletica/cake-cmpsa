<?php
class PuertosController extends AppController {

	public function index() {
		$this->paginate['order'] = array('Puerto.nombre' => 'asc');
		$this->set('puertos', $this->paginate());
	}

	public function add() {
		$this->set('paises', $this->Puerto->Pais->find('list'));
		if($this->request->is('post')) {
			if($this->Puerto->save($this->request->data) ) {
				$this->Flash->success('Puerto guardado');
	//			$this->redirect(array(
	//				'controller' => $this->params['named']['from_controller'],
	//				'action' => $this->params['named']['from_action']));
				return $this->History->back(-1);
			}
		}
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Flash->error('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$puerto = $this->Puerto->find('first',array(
			'conditions' => array('Puerto.id' => $id)));
		$this->set('puerto',$puerto);
		$this->Puerto->id = $id;
		$this->set('paises', $this->Puerto->Pais->find('list'));

		if($this->request->is('get')) {
			$this->request->data = $this->Puerto->read();
		} else {
			if ($this->Puerto->save($this->request->data)) {
				$this->Flash->success('Puerto '.
					$this->request->data['Puerto']['nombre'].
					' modificado con éxito');
				$this->redirect(array('action' => 'index', $id));
			} else {
				$this->Flash->error('Puerto NO guardado');
			}
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');
		$this->Puerto->id = $id;
		if (!$this->Puerto->exists()) {
			throw new NotFoundException('Puerto inválido');
		}
		if ($this->Puerto->delete()){
			$this->Flash->success('Puerto borrado');
			return $this->History->Back(-1);
		}
		$this->Flash->error('Puerto NO borrado');
		return $this->History->Back(0);
	}
}
?>
