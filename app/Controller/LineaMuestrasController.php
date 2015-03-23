<?php
class LineaMuestrasController extends AppController {
	public $paginate = array(
		'order' => array('marca' => 'asc')
	);

	public function index() {
		//$this->Calidad->recursive = 1;
		//debug($this->paginate());
		$this->set('lineas', $this->paginate());
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado lineaMuestra/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'index')
			);
		}
		//sacamos los datos de la muestra a la que pertenece la linea
		//nos sirven en la vista para detallar campos
		$muestra = $this->LineaMuestra->Muestra->find('first', array(
			'conditions' => array('Muestra.id' => $this->params['named']['from_id']),
			'recursive' => 2,
			'fields' => array(
				'Muestra.id',
				'Muestra.referencia',
				'Muestra.proveedor_id',
				'Muestra.almacen_id')
		));
		//debug($referencia_muestra);
		$this->set('muestra',$muestra);
		$this->set('proveedor',$muestra['Proveedor']['Empresa']['nombre']);
		$this->set('almacen',$muestra['Almacen']['Empresa']['nombre']);
		////el titulado completo de la Calidad sale de una vista
		////de MySQL que concatena descafeinado, pais y descripcion
		//$this->loadModel('CalidadNombre');
		//$calidades = $this->CalidadNombre->find('list');
		if($this->request->is('post')):
			//al guardar la linea, se incluye a qué muestra pertenece
			$this->request->data['LineaMuestra']['muestra_id'] = $this->params['named']['from_id'];
			if($this->LineaMuestra->save($this->request->data)):
				$this->Session->setFlash('Linea de Muestra guardada');
			//volvemos a la muestra a la que pertenece la linea creada
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action' => 'view',
				$this->params['named']['from_id']));
			endif;
		endif;
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$linea = $this->LineaMuestra->findById($id);
		//debug($muestra);
		$this->set('linea',$linea);
		//debug($linea);
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
		endif;
		if ($this->Calidad->delete($id)):
			$this->Session->setFlash('Calidad borrada');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array(
				'controller' => 'muestras',
				'action' => 'index'
				));
		}
		$this->LineaMuestra->id = $id;
		$linea = $this->LineaMuestra->findById($id);
		$this->set('linea',$linea);
		if($this->request->is('get')):
			$this->request->data = $this->LineaMuestra->read();
		else:
			if ($this->LineaMuestra->save($this->request->data)):
				$this->Session->setFlash('Línea '.
				$this->request->data['LineaMuestra']['marca'].
			        ' modificada con éxito');
				$this->redirect(array(
					'controller' => 'muestra_lineas',
					'action' => 'view',
					$id));
			else:
				$this->Session->setFlash('Línea NO guardada');
			endif;
		endif;
	}
}
?>
