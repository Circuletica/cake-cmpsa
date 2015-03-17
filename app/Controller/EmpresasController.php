<?php
class EmpresasController extends AppController {
var $name = 'Empresas';
function index() {
$this->set('empresas', $this->Empresa->find('all'));
$this->set('paises', $this->Empresa->Pais->find('list'));
}
  public function add() {
	  $this->set('paises', $this->Empresa->Pais->find('list',
	  array('fields' => 'nombre')));
   if($this->request->is('post')):
    if($this->Empresa->save($this->request->data) ):
     $this->Session->setFlash('Empresa guardada');
     $this->redirect(array('action' => 'index'));
    endif;
   endif;
  }
}
?>
