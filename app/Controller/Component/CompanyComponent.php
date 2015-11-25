<?php
App::uses('Component','Controller');
class CompanyComponent extends Component {


    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado '.$this->class.'/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$empresa = $this->{$this->class}->find('first',array(
	    'conditions' => array($this->class.'.id' => $id)));
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
		'controller' => Inflector::tableize($this->class)
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->formCompany($this->class, $id);
    }

    public function delete( $id = null) {
	$this->deleteCompany($this->class, $id);
    }
}
?>
