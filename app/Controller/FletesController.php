<?php
class FletesController extends AppController {
	var $scaffold = 'admin';
	function index() {
		$this->set('fletes', $this->paginate());
	}

	function add() {
		$navieras = $this->Flete->Naviera->find('list', array(
			'fields' => array('Naviera.id','Empresa.nombre_corto'),
			'order' => array('Empresa.nombre_corto' => 'ASC'),
			'recursive' => 1
			)
		);
		$this->set('navieras', $navieras);
		$puerto_cargas = $this->Flete->PuertoCarga->find(
			'list', array(
				'order' => array('PuertoCarga.nombre' => 'ASC')
			)
		);
		$this->set('puerto_cargas', $puerto_cargas);
		$puerto_destinos = $this->Flete->PuertoDestino->find(
			'list', array(
				'order' => array('PuertoDestino.nombre' => 'ASC')
			)
		);
		$this->set('puerto_destinos', $puerto_destinos);
		$embalajes = $this->Flete->Embalaje->find(
			'list', array(
				'order' => array('Embalaje.nombre' => 'ASC')
			)
		);
		$this->set('embalajes', $embalajes);
		if($this->request->is('post')):
			if($this->Flete->save($this->request->data)):
				$this->Session->setFlash('Flete guardado');
				//debug($this->params['named']);
				$this->redirect(array(
					//'controller' => $this->params['named']['from_controller'],
					'controller' => 'fletes',
					//'action' => $this->params['named']['from_action']));
					'action' => 'index'));
			endif;
		endif;
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Flete/view');
			$this->redirect(array('action'=>'index'));
		}
		$flete = $this->Flete->find('first', array(
			'conditions' => array('Flete.id' => $id),
			'recursive' => 2));
		$this->set('flete',$flete);
		$this->set('referencia', $flete['PuertoCarga']['Pais']['nombre'].'-'.$flete['PuertoDestino']['nombre']);
		$costes = $this->Flete->PrecioFlete->find(
			'all',
			array(
				'conditions' => array('PrecioFlete.id' => $id)
			)
		);
		$this->set('costes',$costes);
	}
	
}
?>
