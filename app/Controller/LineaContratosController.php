<?php
class LineaContratosController extends AppController {
	public $scaffold = 'admin';
	public $paginate = array(
		'order' => array('referencia' => 'asc')
	);

	public function index() {
		$this->set('lineas', $this->paginate());
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado lineaContrato/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'index')
			);
		}
		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$contrato = $this->LineaContrato->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $this->params['named']['from_id']),
			'recursive' => 2,
			'fields' => array(
				'Contrato.id',
				'Contrato.referencia',
				'Contrato.proveedor_id',
				'Contrato.peso_comprado',
				'CalidadNombre.nombre')
		));
		$this->set('contrato',$contrato);
		$this->set('proveedor',$contrato['Proveedor']['Empresa']['nombre']);
		if($this->request->is('post')):
			if($this->LineaContrato->save($this->request->data)):
				$this->Session->setFlash('Linea de Contrato guardada');
				//volvemos a la muestra a la que pertenece la linea creada
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']));
			endif;
		endif;
}
}
?>
