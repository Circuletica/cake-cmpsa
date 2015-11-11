<?php
class ValorTipoIvasController extends AppController {
    public $paginate = array(
	'limit' => 20,
	'order' => array('TipoIva.valor' => 'asc')
    );

    public function index() {
	$params = array('order' => 'nombre asc');
	$this->set('valor_tipo_ivas', $this->paginate());
    }

    public function add() {
	//el id y la clase de la entidad de origen vienen en la URL
	$from_id = $this->params['named']['from_id'];
	//necesitamos el nombre del flete para el breadcrumb y el título de la vista
	$tipo_iva = $this->ValorTipoIva->TipoIva->find('first',
	    array(
		'conditions' => array('TipoIva.id' => $from_id),
		'recursive' => -1
	    ));
	$this->set(compact('tipo_iva'));
	if($this->request->is('post')):
	    $this->request->data['ValorTipoIva']['tipo_iva_id'] = $from_id;
	    if($this->ValorTipoIva->save($this->request->data)):
		$this->Session->setFlash('Valor IVA guardado');
		$this->redirect(array(
		    'controller' => 'tipo_ivas',
		    'action' => 'view',
		    $from_id
		));
	    endif;
	endif;
    }
}
?>
