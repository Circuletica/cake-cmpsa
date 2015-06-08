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


}
?>
