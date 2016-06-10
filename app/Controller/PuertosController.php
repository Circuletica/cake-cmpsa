<?php
class PuertosController extends AppController {

    public function index() {
	$this->paginate['order'] = array('Puerto.nombre' => 'asc');
	$this->set('puertos', $this->paginate());
    }

    public function add() {
	$this->set('paises', $this->Puerto->Pais->find('list'));
	if($this->request->is('post')):
	    if($this->Puerto->save($this->request->data) ):
		$this->Flash->set('Puerto guardado');
	$this->redirect(array(
	    'controller' => $this->params['named']['from_controller'],
	    'action' => $this->params['named']['from_action']));
endif;
endif;
    }


    public function edit( $id = null) {
	if (!$id) {
	    $this->Flash->set('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$puerto = $this->Puerto->find('first',array(
	    'conditions' => array('Puerto.id' => $id)));
	$this->set('puerto',$puerto);
	$this->Puerto->id = $id;
	$this->set('paises', $this->Puerto->Pais->find('list'));

	if($this->request->is('get')):
	    $this->request->data = $this->Puerto->read();
	else:
	    if  ($this->Puerto->save($this->request->data)):
		$this->Flash->set('Puerto '.
		$this->request->data['Puerto']['nombre'].
		' modificado con éxito');
	$this->redirect(array('action' => 'index', $id));
	    else:
		$this->Flash->set('Puerto NO guardado');
endif;
endif;
    }
    public function delete($id) {
	if($this->request->is('post')):
	    if($this->Puerto->delete($id)):
		$this->Flash->set('Puerto borrado');
	$this->redirect(array(
	    'controller' => $this->params['named']['from_controller'],
	    'action' => 'view',
	    $this->params['named']['from_id']
	));
endif;
else:
    throw new MethodNotAllowedException();
endif;
    }
}




?>
