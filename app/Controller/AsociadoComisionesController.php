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
	$asociado = $this->AsociadoComision->Asociado->find('first', array(
	    'conditions' => array('Asociado.id' => $id),
	    'recursive' => 2));
	$this->set(compact('asociado'));
	$this->set('referencia','Comisiones '.$asociado['Empresa']['nombre_corto']);
	$this->set('comisiones', $asociado['AsociadoComision']);
    }
}
?>
