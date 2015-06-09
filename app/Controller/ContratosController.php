<?php
class ContratosController extends AppController {
	var $scaffold = 'admin';
	var $displayField = 'referencia';
	public $paginate = array(
		'order' => array('Contrato.referencia' => 'asc')
	);

	public function index() {
		$proveedores = $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			)
		);
		$this->set('proveedores', $proveedores);
		$contratos = $this->paginate();
		$this->set('contratos', $this->paginate());
	}

	public function add() {
		$proveedores = $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			)
		);
		$this->set('proveedores', $proveedores);
		$this->set('incoterms', $this->Contrato->Incoterm->find('list'));
		$this->set('calidades', $this->Contrato->CalidadNombre->find('list'));
		if($this->request->is('post')):
			if($this->Contrato->save($this->request->data)):
				$this->Session->setFlash('Contrato guardado');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Contrato/view');
			$this->redirect(array('action'=>'index'));
		}
		$contrato = $this->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $id),
			'recursive' => 2));
		$this->set('contrato',$contrato);
		$this->loadModel('CalidadNombre');
		//el nombre de calidad concatenado esta en una view de MSQL
	}



}
?>
