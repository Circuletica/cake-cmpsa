<?php
class AseguradorasController extends AppController {

    public function index() {
	$this->bindEmpresa('Aseguradora');
	$this->set('empresas', $this->paginate());
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Aseguradora/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$empresa = $this->Aseguradora->find('first',array(
	    'conditions' => array('Aseguradora.id' => $id)));
	$this->set('empresa',$empresa);
	$this->set('referencia', $empresa['Empresa']['nombre_corto']);
	$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
	//el método iban() definido en AppController necesita
	//como parametro un 'string'
	settype($cuenta_bancaria,"string");
	$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
	$this->set('iban_bancaria',$iban_bancaria);

    }
    public function add(){
	//los paises que rellenan el desplegable de 'País'
	$this->set('paises', $this->Aseguradora->Empresa->Pais->find('list'));
	if($this->request->is('post')){
	    //quitamos los guiones  de la CCC
	    $numero_form = $this->data['Empresa']['cuenta_bancaria'];
	    $cuenta_bancaria = substr($numero_form,0,4).
		substr($numero_form,5,4).
		substr($numero_form,10,2).
		substr($numero_form,13,10);
	    $this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
	    //mysql guardamos la aseguradora con el mismo id
	    $this->Aseguradora->Empresa->save($this->request->data);
	    $this->request->data['Aseguradora']['id'] = $this->Aseguradora->Empresa->id;
	    debug($this->request->data);
	    if($this->Aseguradora->save($this->request->data)) {
		$this->Session->setFlash('Aseguradora guardada');
		$this->redirect(array('action' => 'index'));
	    }
	}
    }
    public function edit( $id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Aseguradora->id = $id;
	$this->Aseguradora->Empresa->id = $id;
	$aseguradora = $this->Aseguradora->find('first',array(
	    'conditions' => array('Aseguradora.id' => $id)));
	$this->set('empresa',$aseguradora);
	$this->set('paises', $this->Aseguradora->Empresa->Pais->find('list'));
	if($this->request->is('get')):
	    $this->request->data = $this->Aseguradora->read();
	else:
	    if ($this->Aseguradora->Empresa->save($this->request->data) and $this->Aseguradora->save($this->request->data)):
		$this->Session->setFlash('Aseguradora '.
		$this->request->data['Empresa']['nombre_corto'].
		' modificada con éxito');
	$this->redirect(array('action' => 'view', $id));
	    else:
		$this->Session->setFlash('Aseguradora NO guardada');
endif;
endif;
    }

    public function delete( $id = null) {
	$this->deleteCompany('Aseguradora', $id);
    }
}
?>
