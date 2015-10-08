<?php
class FletesController extends AppController {
	public $components = array('Paginator');

	function index() {
		$this->Flete->bindModel(array(
			'belongsTo' => array(
				'Pais' => array(
					'foreignKey' => false,
					'conditions' => array('Pais.id = PuertoCarga.pais_id')
				),
				'Empresa' => array(
					'foreignKey' => false,
					'conditions' => array('Empresa.id = Flete.naviera_id')
				)
			)
		));
		$this->paginate = array(
			'contain' => array(
				'Naviera',
				'Empresa',
				'PuertoCarga',
				'Pais',
				'PuertoDestino.nombre',
				'Embalaje.nombre',
				'PrecioActualFlete'
			),
			'order' => array(
				'Pais.nombre' => 'ASC',
				'PuertoCarga.nombre' => 'ASC',
				'PuertoDestino.nombre' => 'ASC'
			),
			'recursive' => 2
		);
		$fletes = $this->paginate();
		$this->set(compact('fletes'));
	}

	function add() {
		$navieras = $this->Flete->Naviera->find('list', array(
			'fields' => array('Naviera.id','Empresa.nombre_corto'),
			'order' => array('Empresa.nombre_corto' => 'ASC'),
			'recursive' => 1
			)
		);
		$this->set(compact('navieras'));
		$puerto_cargas = $this->Flete->PuertoCarga->find(
			'list', array(
				'order' => array('PuertoCarga.nombre' => 'ASC')
			)
		);
		//$this->set('puerto_cargas', $puerto_cargas);
		$this->set(compact('puerto_cargas'));
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

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Flete->id = $id;
		$flete = $this->Flete->find('first', array(
			'conditions' => array('Flete.id' => $id),
			'recursive' => 2
			)
		);
		$this->set('flete', $flete);
		$this->set('referencia', $flete['PuertoCarga']['Pais']['nombre'].'-'.$flete['PuertoDestino']['nombre']);
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
		if($this->request->is('get')): //al abrir el edit metemos los datos existentes
			$this->request->data = $this->Flete->read();
		else:
			if($this->Flete->save($this->request->data)):
				$this->Session->setFlash('Flete guardado');
				$this->redirect(array(
					//'controller' => $this->params['named']['from_controller'],
					'controller' => 'fletes',
					//'action' => $this->params['named']['from_action']));
					'action' => 'view'));
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
		$this->set('referencia',
			$flete['PuertoCarga']['nombre']
			.' ('.$flete['PuertoCarga']['Pais']['nombre'].')'
			.' - '.$flete['PuertoDestino']['nombre']);
		$costes = $this->Flete->PrecioFleteTonelada->find(
			'all',
			array(
				'conditions' => array('PrecioFleteTonelada.flete_id' => $id),
				'order' => array('PrecioFleteTonelada.fecha_inicio' => 'ASC')
			)
		);
		$this->set('costes',$costes);
	}
	
}
?>
