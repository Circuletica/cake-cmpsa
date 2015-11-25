<?php
class AgentesController extends AppController {
    public function index() {
	$this->bindEmpresa('Agente');
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
	$this->set('referencia', $empresa['Empresa']['nombre_corto']);
	$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
	//el método iban() definido en AppController necesita
	//como parametro un 'string'
	settype($cuenta_bancaria,"string");
	$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
	$this->set('iban_bancaria',$iban_bancaria);
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'agentes'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->set('paises', $this->Agente->Empresa->Pais->find('list'));
	$this->set('action', $this->action);
	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) {
	    $this->Agente->id = $id;
	    $this->Agente->Empresa->id = $id;
	    $empresa = $this->Agente->Empresa->find('first',array(
		'conditions' => array( 'Empresa.id' => $id)
	    ));
	    $this->set('object', $empresa['Empresa']['nombre_corto']);
	}

	if (!empty($this->request->data)) { //es un POST
	    if ($this->Agente->Empresa->save($this->request->data)) {
		$this->request->data['Agente']['id'] = $this->Agente->Empresa->id;
		if($this->Agente->save($this->request->data)) {
		    $this->Session->setFlash('Agente guardado');
		    $this->redirect(array(
			'action' => 'view',
			$this->Agente->Empresa->id
		    ));
		} else { $this->Session->setFlash('Agente NO guardado'); }
	    } else { $this->Session->setFlash('Empresa NO guardada'); }
	} else { //es un GET
	    $this->request->data = $this->Agente->read(null, $id);
	}
    }

    public function delete( $id = null) {
	$this->deleteCompany('Agente', $id);
    }
}
?>
