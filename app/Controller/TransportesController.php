<?php
class TransportesController extends AppController {
		public function index() {
		//$this->Calidad->recursive = 1;
		//$this->Calidad->setSource('CalidadNombre');
		$this->set('transportes', $this->paginate());

		}

public function view($id = null) {

		if (!$id) {
			$this->Session->setFlash('URL mal formada Transporte/view ');
			$this->redirect(array('action'=>'index'));
		}
		$transporte = $this->Transporte->find('first',array(
			'conditions' => array('Transporte.id' => $id),
			'recursive' => 2));
		$this->set('transporte',$transporte);
	}

	public function add() {
		$this->set('puertos', $this->Transporte->Puerto->find('list'));
		$this->set('navieras', $this->Transporte->Naviera->find('list'));		
		$this->set('agentes', $this->Transporte->Agente->find('list'));
	//	$this->set('puertos', $this->Transporte->Puerto->find('list'));		
		if($this->request->is('post')):
			if($this->Operacion->save($this->request->data) ):
				$this->Session->setFlash('Línea de transporte guardada');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']));
			endif;
		endif;
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
			//$this->Session->setFlash('URL mal formado');
			//$this->redirect(array('action'=>'index'));
		endif;
		if ($this->Operacion->delete($id)):
			$this->Session->setFlash('Operación borrada');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Operacion->id = $id;
		$operacion = $this->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id)));
		$this->set('operacion',$operacion);
		if($this->request->is('get')):
			$this->request->data = $this->Operacion->read();
		else:
			//if ($this->BancoPrueba->save($this->request->data)):
			if ($this->Operacion->Empresa->save($this->request->data) and $this->Operacion->save($this->request->data)):
				$this->Session->setFlash('Operacion '.
				$this->request->data['Operacion']['referencia'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Operación NO guardada');
			endif;
		endif;
	}
}
?>
