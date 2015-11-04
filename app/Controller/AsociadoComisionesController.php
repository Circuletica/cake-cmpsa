<?php
class AsociadoComisionesController extends AppController {
    function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado AsociadoComision/view');
	    $this->redirect(array(
		'controller' => 'asociados',
		'action'=>'index'
	    ));
	}
	$asociado = $this->AsociadoComision->Asociado->Empresa->find('first', array(
	    'conditions' => array('Empresa.id' => $id),
	    'recursive' => 2));
	$this->set(compact('asociado'));
    }
}
?>
