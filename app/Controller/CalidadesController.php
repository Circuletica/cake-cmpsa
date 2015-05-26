<?php
class CalidadesController extends AppController {
//	public $paginate = array(
//		'order' => array('descripcion' => 'asc')
//	);

	public function index() {
		//$this->Calidad->recursive = 1;
		//$this->Calidad->setSource('CalidadNombre');
		$this->set('calidades', $this->paginate());
		$this->set('tipos', $this->tipoMuestras);
	}

	public function add() {
		$this->set('paises', $this->Calidad->Pais->find('list'));
		if($this->request->is('post')):
			if($this->Calidad->save($this->request->data)):
				$this->Session->setFlash('Calidad guardada');
				debug($this->params['named']);
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			endif;
		endif;
	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
		endif;
		if ($this->Calidad->delete($id)):
			$this->Session->setFlash('Calidad borrada');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Calidad->id = $id;
		$calidad = $this->Calidad->find('first',array(
			'conditions' => array('Calidad.id' => $id)));
		$this->set('calidad',$calidad);
		$this->set('paises', $this->Calidad->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Calidad->read();
		else:
			if ($this->Calidad->save($this->request->data)):
				$this->Session->setFlash('Calidad '.
				$this->request->data['Calidad']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'index'));
			else:
				$this->Session->setFlash('Calidad NO guardada');
			endif;
		endif;
	}
}
?>
