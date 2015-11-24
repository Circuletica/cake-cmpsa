<?php
class AseguradorasController extends AppController {

    public function index() {
	//hay que cambiar el 'hasOne' del Model por un 'belongsTo'
	//para que el LEFT JOIN de 3r nivel de la query se haga
	//después del de 2o nivel, es decir primero el JOIN con Empresa,
	//luego el JOIN con Pais si no queremos errores de SQL
	$this->Aseguradora->unbindModel(array(
	    'hasOne' => array('Empresa')
	));
	$this->Aseguradora->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array('Aseguradora.id = Empresa.id')
		),
		'Pais' => array(
		    'foreignKey' => false,
		    'conditions' => array('Pais.id = Empresa.pais_id')
		)
	    )
	));
	$this->paginate = array(
	    'contain' => array(
		'Empresa',
		'Pais.nombre',
	    ),
	    'recursive' => 1,
	    'order' => array('Empresa.nombre_corto' => 'ASC')
	);
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
	if($this->request->is('post')):
	    //mysql guardamos la aseguradora con el mismo id
	    $this->Aseguradora->Empresa->save($this->request->data);
	$this->request->data['Aseguradora']['id'] = $this->Aseguradora->Empresa->id;
	if($this->Aseguradora->save($this->request->data)):
	    $this->Session->setFlash('Aseguradora guardada');
	$this->redirect(array('action' => 'index'));
endif;
endif;
    }
    public function edit( $id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Aseguradora->id = $id;
	$this->Aseguradora->Empresa->id = $id;
	$naviera = $this->Aseguradora->find('first',array(
	    'conditions' => array('Aseguradora.id' => $id)));
	$this->set('empresa',$aseguradora);
	$this->set('paises', $this->Aseguradora->Empresa->Pais->find('list'));
	if($this->request->is('get')):
	    $this->request->data = $this->Aseguradora->read();
	else:
	    //if ($this->BancoPrueba->save($this->request->data)):
	    if ($this->Aseguradora->Empresa->save($this->request->data) and $this->Aseguradora->save($this->request->data)):
		$this->Session->setFlash('Aseguradora '.
		$this->request->data['Empresa']['nombre'].
		' modificada con éxito');
	$this->redirect(array('action' => 'view', $id));
	    else:
		$this->Session->setFlash('Aseguradora NO guardada');
endif;
endif;
    }

    public function delete( $id = null) {
	if (!$id or $this->request->is('get')) :
	    throw new MethodNotAllowedException();
	//$this->Session->setFlash('URL mal formado');
	//$this->redirect(array('action'=>'index'));
endif;
if ($this->Aseguradora->delete($id)):
    $this->Session->setFlash('Aseguradora borrada');
$this->Aseguradora->Empresa->delete($id);
$this->redirect(array('action'=>'index'));
endif;
    }
}
?>
