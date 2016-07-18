<?php
class AsociadoComisionesController extends AppController {
    public function view($id = null) {
	if (!$id) {
	    $this->Flash->set('URL mal formado AsociadoComision/view');
	    $this->redirect(array(
		'controller' => 'asociados',
		'action'=>'index'
	    ));
	}
	$asociado = $this->AsociadoComision->Asociado->find(
	    'first', array(
		'conditions' => array('Asociado.id' => $id),
		'recursive' => 2)
	    );
	if (empty($asociado)) {
	    $this->Flash->set('No existe asociado con id: '.$id);
	    $this->History->Back(0);
	}
	$this->set(compact('asociado'));
	$this->set('referencia','Comisiones '.$asociado['Empresa']['nombre_corto']);
	$this->set('comisiones', $asociado['AsociadoComision']);
	$this->set(compact('id'));
    }

    public function add() {
	$this->form($this->params['named']['from_id']);
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Flash->set('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'asociados'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id) { //esta acción vale tanto para edit como add
	$asociado = $this->AsociadoComision->Asociado->Empresa->find(
	    'first', array(
		'conditions' => array(
		    'Empresa.id' => $this->params['named']['from_id']
		)
	    )
	);
	$this->set('asociado_nombre', $asociado['Empresa']['nombre_corto']);
	$this->set('asociado_id', $asociado['Empresa']['id']);
	$comisiones = $this->AsociadoComision->Comision->find(
	    'list',
	    array(
		'recursive' => -1,
		'order' => array('Comision.valor' => 'ASC')
	    )
	);
	$this->set(compact('comisiones'));
	//según es un add o edit, cambia el texto del formulario
	$this->set('action', $this->action);

	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) $this->AsociadoComision->id = $id;
	if(!empty($this->request->data)) { //la vuelta de 'guardar' el formulario
	    if($this->AsociadoComision->save($this->request->data)){
		$this->Flash->set('Comisión guardada');
		$this->redirect(array(
		    'action' => 'view',
		    'controller' => 'asociados',
		    $this->params['named']['from_id']
		));
	    } else {
		$this->Flash->set('Comisión NO guardada');
	    }
	} else { //es un edit, hay que pasar los datos ya existentes
	    $this->request->data = $this->AsociadoComision->read(null, $id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
	if ($this->AsociadoComision->delete($id)){
	    $this->Flash->set('Comisión borrada');
	    $this->redirect(array(
		'controller' => 'asociados',
		'action'=>'view',
		$this->params['named']['from_id']
	    ));
	}
    }
}
?>
