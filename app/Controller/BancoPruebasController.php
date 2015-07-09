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
		if (!$id) {
			//$this->set('params',$this->request->params);
			$this->Session->setFlash('URL mal formado BancoPrueba/view ');
			$this->redirect(array('action'=>'index'));
		}
		//sacamos el banco cuyo id se ha pasado al view
		$bancoprueba = $this->BancoPrueba->findById($id);
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
		//los paises que rellenan el desplegable de 'País'
		$this->set('paises', $this->BancoPrueba->Empresa->Pais->find('list'));
		if($this->request->is('post')):
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
			//primero se guarda la empresa y con el id que devuelve
			//mysql guardamos el banco con el mismo id
			$this->BancoPrueba->Empresa->save($this->request->data);
			$this->request->data['BancoPrueba']['id'] = $this->BancoPrueba->Empresa->id;
			if($this->BancoPrueba->save($this->request->data)):
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
				$this->redirect(array('action' => 'index', $id));
			else:
				$this->Session->setFlash('BancoPrueba NO guardado');
			endif;
		endif;
	}
}
?>
