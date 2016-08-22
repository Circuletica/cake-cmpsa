<?php
class ValorTipoIvasController extends AppController {

	public function index() {
		$paginate['order'] = array('ValorTipoIva.valor' => 'asc');
		$this->set('valor_tipo_ivas', $this->paginate());
	}

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Flash->error('error en URL');
			$this->redirect(array(
				'action' => 'view',
				'controller' => $this->params['named']['from_controller'],
				$this->params['named']['from_id']
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) { //esta acción vale tanto para edit como add
		//según es un add o edit, cambia el texto del formulario
		$this->set('action', $this->action);
		//necesitamos el nombre del flete para el breadcrumb y el título de la vista
		$tipo_iva = $this->ValorTipoIva->TipoIva->find('first',
			array(
				'conditions' => array('TipoIva.id' => $this->params['named']['from_id']),
				'recursive' => -1
			));
		$this->set('tipo_iva', $tipo_iva['TipoIva']);

		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) $this->ValorTipoIva->id = $id;
		if(!empty($this->request->data)) { //la vuelta de 'guardar' el formulario
			$this->request->data['ValorTipoIva']['tipo_iva_id'] = $this->params['named']['from_id'];
			if($this->ValorTipoIva->save($this->request->data)){
				$this->Flash->success('Valor de IVA guardada');
				$this->redirect(array(
					'action' => 'view',
					'controller' => $this->params['named']['from_controller'],
					$this->params['named']['from_id']
				));
			} else {
				$this->Flash->error('Valor NO guardado');
			}
		} else { //es un edit, hay que pasar los datos ya existentes
			$this->request->data = $this->ValorTipoIva->read(null, $id);
		}
	}

//	public function delete($id = null) {
//		if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
//		if ($this->ValorTipoIva->delete($id)){
//			$this->Flash->success('Valor borrado');
//			$this->redirect(array(
//				'controller' => $this->params['named']['from_controller'],
//				'action'=>'view',
//				$this->params['named']['from_id']
//			));
//		}
//	}
}
?>
