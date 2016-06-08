<?php
class UsuariosController extends AppController {
 var $name = 'Usuarios';
    function index() {
	$this->set('usuarios', $this->Usuario->find('all'));
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->set('action', $this->action);
	//necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
	$this->set('departamentos',$this->Usuario->Departamento->find('list'));

	if (!empty($id)) {
	    $this->Usuario->id = $id;
	    $usuario = $this->Usuario->findById($id);
	    $this->set('usuario', $usuario['Usuario']['nombre']);
	}
	if (!empty($this->request->data)){  //es un POST
	    if($this->Usuario->save($this->request->data)) {
		$this->Session->setFlash('Usuario guardado');
		$this->redirect(
		    array(
			'action' => 'index'
		    )
		);
	    } else {
		$this->Session->setFlash('Usuario NO guardado');
	    }
	} else { //es un GET
	    $this->request->data= $this->Usuario->read(null, $id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) {
	    throw new MethodNotAllowedException();
	}
	if ($this->Usuario->delete($id)) {
	    $this->Session->setFlash('Usuario borrado');
	    $this->redirect(array(
		'controller' => 'usuarios',
		'action'=>'index',
	    ));
	}
    }

	public function view_pdf($id = null) {
    $this->Usuario->id = $id;
    if (!$this->Usuario->exists()) {
        throw new NotFoundException(__('Invalid Usuario'));
    }
    // increase memory limit in PHP 
    ini_set('memory_limit', '512M');
    $this->set('usuario', $this->Usuario->read(null, $id));
}


}
?>
