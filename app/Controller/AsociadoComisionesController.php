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

//    function add() {
//	if($this->request->is('post')):
//	    debug($this->request->data);
//	    if($this->AsociadoComision->save($this->request->data)):
//		$this->Session->setFlash('Comisión guardada'.$this->request->data['AsociadoComision']['asociado_id']);
//		$asociado_id = $this->request->data['AsociadoComision']['asociado_id'];
//		$this->redirect(
//		    array(
//			'controller' => 'asociados',
//			'action' => 'view',
//			$asociado_id
//		    )
//		);
//	    endif;
//	else:
//	    $asociado = $this->AsociadoComision->Asociado->Empresa->find(
//		'first', array(
//		    'conditions' => array(
//			'Empresa.id' => $this->params['named']['from_id']
//		    )
//		)
//	    );
//	    $this->set('asociado_nombre', $asociado['Empresa']['nombre_corto']);
//	    $this->set('asociado_id', $asociado['Empresa']['id']);
//	    $comisiones = $this->AsociadoComision->Comision->find(
//		'list',
//		array('recursive' => -1)
//	    );
//	    $this->set(compact('comisiones'));
//	endif;
//    }
    function add() {
	$this->form($this->params['named']['from_id']);
	$this->render('form');
    }

//    function edit($id = null) {
//	if (!$id) {
//	    //throw new MethodNotAllowedException();
//	    $this->Session->setFlash('URL mal formado asociado_comisiones/edit '.$this->params['named']['from_controller'].' '.$this->params['named']['from_id']);
//	    $this->redirect(array(
//		'controller' => $this->params['named']['from_controller'],
//		'action'=>'index'));
//	}
//	$this->AsociadoComision->id = $id;
//	$comisiones = $this->AsociadoComision->Comision->find(
//	    'list',
//	    array(
//		'order' => array('Comision.valor' => 'ASC')
//	    )
//	);
//	$this->set(compact('comisiones'));
//	if($this->request->is('get')):
//	    $this->request->data = $this->AsociadoComision->read();
//	else:
//	    if($this->AsociadoComision->save($this->request->data)):
//		$this->Session->setFlash('Comisión modificada');
//	$this->redirect(array(
//	    'controller' => $this->params['named']['from_controller'],
//	    'action' => 'view',
//	    $this->params['named']['from_id']));
//	    else:
//		$this->Session->setFlash('No se ha podido guardar!');
//endif;
//endif;
//    }
    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'asociados'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
	if ($this->AsociadoComision->delete($id)){
	    $this->Session->setFlash('Comisión borrada');
	    $this->redirect(array(
		'controller' => 'asociados',
		'action'=>'view',
		$this->params['named']['from_id']
	    ));
	}
    }
}
?>
