<?php
class MuestrasController extends AppController {
	public $paginate = array(
		'recursive' => 2,
		'order' => array('Muestra.referencia' => 'asc')
	);

	public function index() {
		//optimizamos la consulta SQL para no sacar
		//datos que no sirven
		$this->paginate = array(
			'order' => array('Muestra.referencia' => 'asc'),
			//'recursive' => 2,
			'Muestra' => array(
				'recursive' => 2,
				'fields' => array(
					'Muestra.id',
					'Muestra.referencia',
					'Muestra.fecha',
					'Muestra.aprobado',
					'Muestra.incidencia',
					'Muestra.calidad_id',
					'Calidad.pais_id',
					'Calidad.descafeinado',
					'Calidad.descripcion'
				)
			),
			'Pais' => array(
				'recursive' => 1,
				'fields' => array('Pais.nombre')
			)
		);
		$muestras = $this->paginate();
		$this->set('muestras', $muestras);
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$muestra = $this->Muestra->find('first', array(
			'conditions' => array('Muestra.id' => $id),
			'recursive' => 2));
		//debug($this->Muestra->LineaMuestra);
		//debug($muestra['LineaMuestra']);
		$this->set('muestra',$muestra);
		//debug($muestra);
		$this->loadModel('CalidadNombre');
		//el nombre de calidad concatenado esta en una view de MSQL
		$calidad_nombre = $this->CalidadNombre->findById($muestra['Calidad']['id']);
		$this->set('calidad_nombre',$calidad_nombre);
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
		endif;
		if ($this->Muestra->delete($id)):
			$this->Session->setFlash('Muestra borrada');
			$this->redirect(array('action'=>'index'));
		endif;
	}

	public function add() {
		//el titulado completo de la Calidad sale de una vista
		//de MySQL que concatena descafeinado, pais y descripcion
		$this->loadModel('CalidadNombre');
		$calidades = $this->CalidadNombre->find('list');
		//debug($calidades);
		$this->set('calidades',$calidades);
		$this->set('proveedores', $this->Muestra->Proveedor->find('list', array(
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

	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Muestra->id = $id;
		$muestra = $this->Muestra->findById($id);
		$this->set('muestra',$muestra);
		//el titulado completo de la Calidad sale de una vista
		//de MySQL que concatena descafeinado, pais y descripcion
		$this->loadModel('CalidadNombre');
		$calidades = $this->CalidadNombre->find('list');
		//debug($calidades);
		$this->set('calidades',$calidades);
		$this->set('proveedores', $this->Muestra->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			))
		);
		$this->set('almacenes', $this->Muestra->Almacen->find('list', array(
			'fields' => array('Almacen.id','Empresa.nombre'),
			'recursive' => 1))
		);
		if($this->request->is('get')):
			$this->request->data = $this->Muestra->read();
		else:
			if ($this->Muestra->save($this->request->data)):
				$this->Session->setFlash('Muestra '.
				$this->request->data['Muestra']['referencia'].
			        ' modificada con éxito');
				$this->redirect(array(
					'action' => 'view',
					$id
					)
				);
			else:
				$this->Session->setFlash('Muestra NO guardada');
			endif;
		endif;
	}
}
?>
