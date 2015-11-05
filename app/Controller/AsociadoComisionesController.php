<?php
class AsociadoComisionesController extends AppController {
    function add() {
	//el id y la clase de la entidad de origen vienen en la URL
	if (!$this->params['named']['from_id']) {
	    $this->Session->setFlash('URL mal formado asociado_comisiones/add '.$this->params['named']['from_controller']);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => 'index'));
	}
	$empresa = $this->AsociadoComision->Asociado->Empresa->find('first',
	    array(
		'conditions' => array('Empresa.id' => $this->params['named']['from_id']),
		'recursive' => -1,
		'fields' => array('Empresa.id','Empresa.nombre')
	    ));
	$this->set('empresa',$empresa);
	if($this->request->is('post')):
	    $this->request->data['AsociadoComision']['asociado_id'] = $this->params['named']['from_id'];
	    if($this->AsociadoComision->save($this->request->data) ):
		$this->Session->setFlash('Comisión guardada');
		$this->redirect(array(
		    'controller' => $this->params['named']['from_controller'],
		    'action' => 'view',
		    $this->params['named']['from_id']
	));
	    else:
		$this->Session->setFlash('ERROR. Comisión NO guardada');
	    endif;
	endif;
    }

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
