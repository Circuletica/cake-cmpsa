<?php
class OperacionesController extends AppController {
	public $paginate = array(
		'recursive' => 3,
		'order' => array('Operacion.referencia' => 'asc')
	);



public function index() {

	$this->set('operaciones', $this->Operacion->find('all'));
	$operaciones =  $this->paginate();
		//generamos el título
		
		//pasamos los datos a la vista
	$this->set(compact('operacion','title'));
}


public function view($id = null) {
		//debug($this->request->params);
		//debug(func_get_args());
		//debug($this->referer());
		if (!$id) {
			$this->Session->setFlash('URL mal formada Operación/view ');
			$this->redirect(array('action'=>'index'));
		}
		$empresa = $this->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id)));
		$this->set('empresa',$empresa);
		$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
		//el método iban() definido en AppController necesita
		//como parametro un 'string'
		settype($cuenta_bancaria,"string");
		//debug($ccc);
		$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
		$this->set('iban_bancaria',$iban_bancaria);
		//debug($iban_cliente);
	}

	public function add() {
		//$this->set('proveedores', $proveedores);
		//$this->set('incoterms', $this->Contrato->Incoterm->find('list'));
		$this->set('almacenes', $this->Operacion->Almacen->find('list'));
		$this->set('calidades', $this->Operacion->CalidadNombre->find('list'));
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
		$this->Operacion->Empresa->id = $id;
		$operacion = $this->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id)));
		$this->set('operacion',$operacion);
		$this->set('paises', $this->Operacion->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Operacion->read();
		else:
			//if ($this->BancoPrueba->save($this->request->data)):
			if ($this->Operacion->Empresa->save($this->request->data) and $this->Operacion->save($this->request->data)):
				$this->Session->setFlash('Operacion '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Operación NO guardada');
			endif;
		endif;
	}
}
?>