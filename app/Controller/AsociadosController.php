<?php
class AsociadosController extends AppController {

    public function index() {
	$this->bindEmpresa('Asociado');
	$this->set('empresas', $this->paginate());
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Asociado/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$empresa = $this->Asociado->find(
	    'first',
	    array('conditions' => array('Asociado.id' => $id))
	);
	$this->set('empresa',$empresa);
	$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
	$this->set('referencia', $empresa['Empresa']['nombre_corto']);
	//el método iban() definido en AppController necesita
	//como parametro un 'string'
	settype($cuenta_bancaria,"string");
	$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
	$this->set('iban_bancaria',$iban_bancaria);
	$this->set('comisiones', $empresa['AsociadoComision']);
	$asociado_comision = $this->Asociado->AsociadoComision->find('first', array(
	    'conditions' => array(
		'AND' => array(
		    array("AsociadoComision.fecha_inicio <=" => date('Y-m-d')),
		    'OR' => array(
			"AsociadoComision.fecha_fin >" => date('Y-m-d'),
			"AsociadoComision.fecha_fin " => NULL,
		    ),
		    array('Asociado.id' => $id)
		))
	    )
	);
	//si no hay comisión válida a día de hoy, avisar.
	if (!empty($asociado_comision)) {
	    $this->set('comision', $asociado_comision['Comision']['valor']);
	} else
	{
	    $this->set('comision', 'comisión no definida');
	}
    }

    public function add() {
	$this->set('paises', $this->Asociado->Empresa->Pais->find('list'));
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
	$this->Asociado->Empresa->save($this->request->data);
	$this->request->data['Asociado']['id'] = $this->Asociado->Empresa->id;
	if($this->Asociado->save($this->request->data)):
	    $this->Session->setFlash('Asociado guardado');
	$this->redirect(array('action' => 'index'));
endif;
endif;
    }

    public function delete( $id = null) {
	$this->deleteCompany('Asociado', $id);
    }

    public function edit( $id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Asociado->id = $id;
	$this->Asociado->Empresa->id = $id;
	$asociado = $this->Asociado->find('first',array(
	    'conditions' => array('Asociado.id' => $id)));
	$this->set('empresa',$asociado);
	$this->set('paises', $this->Asociado->Empresa->Pais->find('list'));
	if($this->request->is('get')):
	    $this->request->data = $this->Asociado->read();
	else:
	    if ($this->Asociado->Empresa->save($this->request->data) and $this->Asociado->save($this->request->data)):
		$this->Session->setFlash('Asociado '.
		$this->request->data['Empresa']['nombre'].
		' modificado con éxito');
	$this->redirect(array('action' => 'view', $id));
	    else:
		$this->Session->setFlash('Asociado NO guardado');
endif;
endif;
    }
}
?>
