<?php
class MuestrasController extends AppController {
	public $paginate = array(
		'order' => array('referencia' => 'asc')
	);

	public function index() {
		//$this->Calidad->recursive = 1;
		//debug($this->paginate());
		$this->set('muestras', $this->paginate());
	}

	public function add() {
		//$this->Muestra->Calidad->setSource('calidad_nombres');
		//debug($this->Muestra->Calidad->find('all'));
		//$this->set('calidades', $this->Muestra->Calidad->find('list'));
//		$this->set('calidades',$this->Muestra->Calidad->find('list', array(
//			'recursive' => 2,
//			'fields' => array('Calidad.id', 'Calidad.nombre'),
//			'contain' => array('Pais')
//			))
//		);
		//$this->loadModel('Calidad');
		//$calidades = $this->Calidad->find('all', array(
		//	'contain' => array(
		//		'Pais' => array('nombre')
		//	)
		//));
		//el titulado completo de la Calidad sale de una vista
		//de MySQL que concatena descafeinado, pais y descripcion
		$this->loadModel('CalidadNombre');
		$calidades = $this->CalidadNombre->find('list');
		//debug($calidades);
		//$calidades = Hash::combine($calidades, '{n}.Calidad.id', '{n}.Pais.nombre');
		$this->set('calidades',$calidades);
		$this->set('proveedores', $this->Muestra->Proveedor->find('list', array(
			//'conditions' => array('Proveedor.id !=' => null)
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			))
		);
		$this->set('almacenes', $this->Muestra->Almacen->find('list', array(
			'fields' => array('Almacen.id','Empresa.nombre'),
			'recursive' => 1))
		);
		if($this->request->is('post')):
			if($this->Muestra->save($this->request->data)):
				$this->Session->setFlash('Muestra guardada');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$muestra = $this->Muestra->find('first', array(
			'conditions' => array('Muestra.id' => $id),
			'recursive' => 2));
		//debug($muestra);
		$this->set('muestra',$muestra);
		$this->loadModel('CalidadNombre');
		//el nombre de calidad concatenado esta en una view de MSQL
		$calidad_nombre = $this->CalidadNombre->findById($muestra['Calidad']['id']);
		$this->set('calidad_nombre',$calidad_nombre);
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
			$this->redirect(array('action'=>'index'));
		}
		$this->Calidad->id = $id;
		$calidad = $this->Calidad->find('first',array(
			'conditions' => array('Calidad.id' => $id)));
		$this->set('calidad',$calidad);
		$this->set('paises', $this->Calidad->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Calidad->read();
		else:
			if ($this->Calidad->save($this->request->data)):
				$this->Session->setFlash('Calidad '.
				$this->request->data['Calidad']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'index'));
			else:
				$this->Session->setFlash('Calidad NO guardada');
			endif;
		endif;
	}
}
?>
