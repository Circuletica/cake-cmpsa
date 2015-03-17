<?php
class BancoPruebasController extends AppController {
	public $paginate = array(
		'order' => array('Empresa.nombre' => 'asc')
	);

		function index() {
		//$this -> set('bancopruebas', $this->BancoPrueba->find('all'));
		$this->set('bancopruebas', $this->paginate());
	}

	public function view($id = null) {
		//debug($this->request->params);
		//debug(func_get_args());
		//debug($this->referer());
		if (!$id) {
			//$this->set('params',$this->request->params);
			$this->Session->setFlash('URL mal formado BancoPrueba/view ');
			$this->redirect(array('action'=>'index'));
		}
		//sacamos el banco cuyo id se ha pasado al view
		$bancoprueba = $this->BancoPrueba->find('first',array(
			'conditions' => array('BancoPrueba.id' => $id)));
		$this->set('bancoprueba',$bancoprueba);
		//calculamos el IBAN
		$cuenta_cliente = $bancoprueba['BancoPrueba']['cuenta_cliente_1'];
		//la funcion necesita una cadena como parametro
		settype($cuenta_cliente,"string");
		//debug($ccc);
		$iban_cliente = $this->iban("ES",$cuenta_cliente);
		$this->set('iban_cliente',$iban_cliente);
		//debug($iban_cliente);
	}

	public function add() {
		$this->set('paises', $this->BancoPrueba->Empresa->Pais->find('list'));
		if($this->request->is('post')):
			//$empresa = $this->BancoPrueba->Empresa->save($this->request->data);
			//debug($this->BancoPrueba->Empresa);
			//quitamos los guiones de la entrada de formulario
			$numero_form = $this->data['BancoPrueba']['cuenta_cliente_1'];
			$cuenta_cliente_1 = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$numero_form = $this->data['Empresa']['cuenta_bancaria'];
			$cuenta_bancaria = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$this->request->data['BancoPrueba']['cuenta_cliente_1'] = $cuenta_cliente_1;
			$this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
			$this->BancoPrueba->Empresa->save($this->request->data);
			$this->BancoPrueba->Empresa->save($this->request->data);
			$this->request->data['BancoPrueba']['id'] = $this->BancoPrueba->Empresa->id;
			//$this->request->data['BancoPrueba']['id'] = $empresa;
			if($this->BancoPrueba->save($this->request->data)):
			//if($this->BancoPrueba->save(array('id'=>$this->BancoPrueba->Empresa->id))):
				$this->Session->setFlash('Banco guardado');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
			//$this->Session->setFlash('URL mal formado');
			//$this->redirect(array('action'=>'index'));
		endif;
		if ($this->BancoPrueba->Empresa->delete($id)):
			$this->Session->setFlash('Banco borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->BancoPrueba->id = $id;
		$this->BancoPrueba->Empresa->id = $id;
		$this->set('paises', $this->BancoPrueba->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->BancoPrueba->read();
		else:
			//if ($this->BancoPrueba->save($this->request->data)):
			if ($this->BancoPrueba->Empresa->save($this->request->data) and $this->BancoPrueba->save($this->request->data)):
				$this->Session->setFlash('BancoPrueba '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('BancoPrueba NO guardado');
			endif;
		endif;
	}
}
?>
