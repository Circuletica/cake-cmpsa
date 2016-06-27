<?php
class CalidadesController extends AppController {
    public $paginate = array(
	'order' => array(
	    'Pais.nombre' => 'asc',
	    'Calidad.descripcion' => 'asc'
	)
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'Pais'
	);
	$this->set('calidades', $this->paginate());
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit( $id = null) {
	if (!$id) {
	    $this->Flash->set('URL mal formado');
	    $this->redirect(array('action'=>'index'));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
        $this->set('action', $this->action);
        $this->set('paises', $this->Calidad->Pais->find('list'));
        if (!empty($id)) {
            $calidad = $this->Calidad->findById($id);
            $this->set('referencia', $calidad['Calidad']['nombre']);
        }
        if (!empty($this->request->data)){  //es un POST
            if($this->Calidad->save($this->request->data)) {
                $this->Flash->set('Calidad guardada');
                $this->redirect(
                    array(
                    'action' =>
                        isset($this->params['named']['from_action']) ?
                        $this->params['named']['from_action'] : 'index',
                    'controller' =>
                        isset($this->params['named']['from_controller']) ? 
                        $this->params['named']['from_controller'] : 'calidades',
                    //si venimos de Muestras::add()
                    'tipo_id' =>
                        isset($this->params['named']['from_type']) ?
                        $this->params['named']['from_type'] : ''
                    )
                );
            } else {
            $this->Flash->set('Calidad NO guardada');
            }
        } else { //es un GET
            $this->request->data= $this->Calidad->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$id or $this->request->is('get')) {
            throw new MethodNotAllowedException('URL mal formada o id ausente');
        }
        if ($this->Calidad->delete($id)) {
            $this->Flash->set('Calidad borrada');
            $this->History->Back(0);
        } else {
            $this->Flash->set('Calidad NO borrada');
            $this->History->Back(0);
        }
    }
}
?>
