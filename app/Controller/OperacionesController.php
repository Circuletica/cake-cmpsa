<?php
class OperacionesController extends AppController {
	var $displayField = 'referencia';
	
	public $paginate = array(
		'recursive' => 3,
		'order' => array('Operacion.referencia' => 'asc')
	);


	public function index() {
	$proveedores = $this->Operacion->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
		)
	);
	$calidades = $this->Operacion->Contrato->CalidadNombre->find('list', array(
		'fields' => array('CalidadNombre.nombre'),
		'recursive' => 1
		)
	);	
	$this->set('proveedores', $proveedores);
	$this->set('calidades', $calidades);
	$this->set('operaciones', $this->paginate());

	}

public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formada Operación/view ');
			$this->redirect(array('action'=>'index'));
		}
		$operacion = $this->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3));
		$this->set('operacion',$operacion);
		$this->loadModel('CalidadNombre');

	}

	public function add() {
	$proveedores = $this->Operacion->Contrato->Proveedor->find('list', array(
		'fields' => array('Proveedor.id','Empresa.nombre'),
		'recursive' => 1
		)
	);
	$calidades = $this->Operacion->Contrato->CalidadNombre->find('list', array(
		'fields' => array('CalidadNombre.nombre'),
		'recursive' => 1
		)
	);
		$this->set('proveedores', $proveedores);
		$this->set('incoterms', $this->Operacion->Contrato->Incoterm->find('list'));
		$this->set('calidades', $calidades);

		if($this->request->is('post')):
			if($this->Operacion->save($this->request->data) ):
				$this->Session->setFlash('Operación guardada');
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
		$operacion = $this->Operacion->findById($id);
		$this->set('operacion',$operacion);
		if($this->request->is('get')):
			$this->request->data = $this->Operacion->read();
		else:
			if ($this->Operacion->save($this->request->data) and $this->Operacion->save($this->request->data)):
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
