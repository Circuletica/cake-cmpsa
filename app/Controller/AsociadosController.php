<?php
class AgentesController extends AppController {
	public $paginate = array(
		'order' => array('Empresa.nombre' => 'asc')
	);

	public function index() {
		$this->set('empresas', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Agente/view ');
			$this->redirect(array('action'=>'index'));
		}
		$empresa = $this->Agente->find('first',array(
			'conditions' => array('Agente.id' => $id)));
		$this->set('empresa',$empresa);
		$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
		//el método iban() definido en AppController necesita
		//como parametro un 'string'
		settype($cuenta_bancaria,"string");
		//debug($ccc);
		$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
		$this->set('iban_bancaria',$iban_bancaria);
	}

	public function add() {
		$this->set('paises', $this->Agente->Empresa->Pais->find('list'));
		if($this->request->is('post')):
			//quitamos los guiones  de la CCC
			$numero_form = $this->data['Empresa']['cuenta_bancaria'];
			$cuenta_bancaria = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
			//primero se guarda la nueva empresa y con
			//el ID que le da mysql, se guarda la entidad
			//con el mismo ID
			$this->Agente->Empresa->save($this->request->data);
			$this->request->data['Agente']['id'] = $this->Agente->Empresa->id;
			if($this->Agente->save($this->request->data)):
				$this->Session->setFlash('Agente guardado');
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
		if ($this->Agente->Empresa->delete($id)):
			$this->Session->setFlash('Agente borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Agente->id = $id;
		$this->Agente->Empresa->id = $id;
		$agente = $this->Agente->find('first',array(
			'conditions' => array('Agente.id' => $id)));
		$this->set('empresa',$agente);
		$this->set('paises', $this->Agente->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Agente->read();
		else:
			//if ($this->BancoPrueba->save($this->request->data)):
			if ($this->Agente->Empresa->save($this->request->data) and $this->Agente->save($this->request->data)):
				$this->Session->setFlash('Agente '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Agente NO guardado');
			endif;
		endif;
	}
}
?>