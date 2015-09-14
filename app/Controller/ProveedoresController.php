<?php
class ProveedoresController extends AppController {
	public $paginate = array(
		'order' => array('Empresa.nombre' => 'asc')
	);

		function index() {
		$this->set('proveedores', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			//$this->set('params',$this->request->params);
			$this->Session->setFlash('URL mal formado Proveedor/view ');
			$this->redirect(array('action'=>'index'));
		}
		$proveedor = $this->Proveedor->find('first',array(
			'conditions' => array('Proveedor.id' => $id)));
		$this->set('proveedor',$proveedor);
		$cuenta_bancaria = $proveedor['Empresa']['cuenta_bancaria'];
		//el método iban() definido en AppController necesita
		//como parametro un 'string'
		settype($cuenta_bancaria,"string");
		//debug($ccc);
		$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
		$this->set('iban_bancaria',$iban_bancaria);
		//debug($iban_cliente);
	}

	public function add() {
		//debug($this->params['named']);
		$this->set('paises', $this->Proveedor->Empresa->Pais->find('list'));
		if($this->request->is('post')):
			//$empresa = $this->BancoPrueba->Empresa->save($this->request->data);
			//debug($this->BancoPrueba->Empresa);
			//quitamos los guiones de la entrada de formulario
			$numero_form = $this->data['Empresa']['cuenta_bancaria'];
			$cuenta_bancaria = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
			$this->Proveedor->Empresa->save($this->request->data);
			$this->request->data['Proveedor']['id'] = $this->Proveedor->Empresa->id;
			if($this->Proveedor->save($this->request->data)):
				$this->Session->setFlash('Proveedor guardado');
				//$this->redirect(array('action' => 'index'));
				debug($this->params['named']);
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => $this->params['named']['from_action']
				));
			endif;
		endif;
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
			//$this->Session->setFlash('URL mal formado');
			//$this->redirect(array('action'=>'index'));
		endif;
		if ($this->Proveedor->Empresa->delete($id)):
			$this->Session->setFlash('Proveedor borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Proveedor->id = $id;
		$this->Proveedor->Empresa->id = $id;
		$proveedor = $this->Proveedor->find('first',array(
			'conditions' => array('Proveedor.id' => $id)));
		$this->set('proveedor',$proveedor);
		$this->set('paises', $this->Proveedor->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Proveedor->read();
		else:
			//if ($this->BancoPrueba->save($this->request->data)):
			if ($this->Proveedor->Empresa->save($this->request->data) and $this->Proveedor->save($this->request->data)):
				$this->Session->setFlash('Proveedor '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Proveedor NO guardado');
			endif;
		endif;
	}
}
?>
