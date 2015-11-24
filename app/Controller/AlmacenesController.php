<?php
class AlmacenesController extends AppController {

    public function index() {
	$this->bindEmpresa('Almacen');
	$this->set('empresas', $this->paginate());
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Almacen/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$empresa = $this->Almacen->find('first',array(
	    'conditions' => array('Almacen.id' => $id)));
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
	$this->set('paises', $this->Almacen->Empresa->Pais->find('list'));
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
	$this->Almacen->Empresa->save($this->request->data);
	$this->request->data['Almacen']['id'] = $this->Almacen->Empresa->id;
	if($this->Almacen->save($this->request->data)):
	    $this->Session->setFlash('Almacen guardado');
	$this->redirect(array('action' => 'index'));
endif;
endif;
    }

    public function delete( $id = null) {
	$this->deleteCompany('Almacen',$id);
    }

    public function edit( $id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Almacen->id = $id;
	$this->Almacen->Empresa->id = $id;
	$almacen = $this->Almacen->find('first',array(
	    'conditions' => array('Almacen.id' => $id)));
	$this->set('empresa',$almacen);
	$this->set('paises', $this->Almacen->Empresa->Pais->find('list'));
	if($this->request->is('get')):
	    $this->request->data = $this->Almacen->read();
	else:
	    if ($this->Almacen->Empresa->save($this->request->data) and $this->Almacen->save($this->request->data)):
		$this->Session->setFlash('Almacen '.
		$this->request->data['Empresa']['nombre'].
		' modificado con éxito');
	$this->redirect(array('action' => 'view', $id));
	    else:
		$this->Session->setFlash('Almacen NO guardado');
endif;
endif;
    }
}
?>
