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

    function add() {
    }

    function edit($id = null) {
	if (!$id) {
	    //throw new MethodNotAllowedException();
	    $this->Session->setFlash('URL mal formado asociado_comisiones/edit '.$this->params['named']['from_controller'].' '.$this->params['named']['from_id']);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action'=>'index'));
	}
	$this->AsociadoComision->id = $id;
	$comisiones = $this->AsociadoComision->Comision->find(
	    'list',
	    array(
		'order' => array('Comision.valor' => 'ASC')
	    )
	);
	$this->set(compact('comisiones'));
	if($this->request->is('get')):
	    $this->request->data = $this->AsociadoComision->read();
	else:
	    if($this->AsociadoComision->save($this->request->data)):
		$this->Session->setFlash('Comisión modificada');
	$this->redirect(array(
	    'controller' => $this->params['named']['from_controller'],
	    'action' => 'view',
	    $this->params['named']['from_id']));
	    else:
		$this->Session->setFlash('No se ha podido guardar!');
	    endif;
	endif;
    }

    function delete($id) {
    }
}
?>
