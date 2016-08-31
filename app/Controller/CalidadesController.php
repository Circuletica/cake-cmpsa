<?php
class CalidadesController extends AppController {

	public function index() {
		$this->paginate['contain'] = array(
			'Pais'
		);
		$this->paginate['order'] = array(
			'Pais.nombre' => 'asc',
			'Calidad.descripcion' => 'asc'
		);
		$this->set('calidades', $this->paginate());
	}

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit( $id = null) {
		$this->Calidad->id = $id;
		if (!$this->Calidad->exists()) {
			throw new NotFoundException(__('Calidad inválida'));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) {
		$this->set('action', $this->action);
		$this->set('paises', $this->Calidad->Pais->find('list'));
		if (!empty($id)) {
			$calidad = $this->Calidad->findById($id);
			$this->set('referencia', $calidad['Calidad']['nombre']);
		}
		if (!empty($this->request->data)){  //es un POST
			if($this->Calidad->save($this->request->data)) {
				$this->Flash->success('Calidad guardada');
				$this->redirect(
					array(
						'action' =>
						isset($this->params['named']['from_action']) ?
						$this->params['named']['from_action'] : 'index',
						'controller' =>
						isset($this->params['named']['from_controller']) ?
						$this->params['named']['from_controller'] : 'calidades',
						//si venimos de Muestras::add()
						'tipo_id' =>
						isset($this->params['named']['from_type']) ?
						$this->params['named']['from_type'] : ''
					)
				);
			} else {
				$this->Flash->error('Calidad NO guardada');
			}
		} else { //es un GET
			$this->request->data= $this->Calidad->read(null, $id);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->Calidad->id = $id;
		if (!$this->Calidad->exists()) {
			throw new NotFoundException(__('Calidad inválida'));
		}
		if ($this->Calidad->delete($id)) {
			$this->Flash->success('Calidad borrada');
			return $this->History->Back(0);
		}
		$this->Flash->error('Calidad NO borrada');
		return $this->History->Back(0);
	}
}
?>
