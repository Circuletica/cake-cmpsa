<?php
class MuestrasController extends AppController {
	public $paginate = array(
		'order' => array('referencia' => 'asc')
	);

	public funcion search() {
		//la página a la que redirigimos después de mandar  el formulario de filtro
		$url['action'] = 'index';
		//construimos una URL con los elementos de filtro, que luego se usan en el paginator
		//la URL final tiene ese aspecto:
		//http://cake-cmpsa.gargantilla.net/muestras/index/Search.palabras:mipalabra/Search.id:3
		foreach ($this->data as $k=>$v){ 
			foreach ($v as $kk=>$vv){ 
			$url[$k.'.'.$kk]=$vv; 
			} 
		}
		$this->redirect($url,null,true);
	
	public function index() {
		//$this->Calidad->recursive = 1;
		//debug($this->paginate());
		//los elementos de la URL pasados como Search.* son almacenados por cake en $this->passedArgs[]
		//por ej.
		//$passedArgs['Search.palabras'] = mipalabra
		//$passedArgs['Search.id'] = 3
		
		//Si queremos un titulo con los criterios de busqueda
		$titulo = array();

		//primero el filtro por id
		if(isset($this->passedArgs['id'])) {
			//ponemos la condicion
			$this->paginate['conditions'][]['Muestra.id'] = $this->passedArgs['id'];
			//guardamos los datos de búsqueda para que el formulario 'se acuerde' de la opcion
			$this->data['Search']['id'] = $this->passedArgs['id'];
			//generamos el titulo
			$title[] = __('ID',true).': '.$this->passedArgs['id'];
		}
		//filtramos por referencia
		if(isset($this->passedArgs['Search.referencia'])) {
			$palabras = $this->passedArgs['Search.referencia'];
			$this->paginate['conditions'][]['Muestra.referencia LIKE'] => "%$referencia%";
			//guardamos el criterio para el formulario de vuelta
			$this->data['Search']['referencia'] = $referencia;
			//completamos el titulo
			$title[] = __('Calidad',true).': '.$referencia;
		}
		//filtramos por calidad
		if(isset($this->passedArgs['Search.calidad'])) {
			$palabras = $this->passedArgs['Search.calidad'];
			$this->paginate['conditions'][]['Muestra.referencia LIKE'] => "%$calidad%";
			//guardamos el criterio para el formulario de vuelta
			$this->data['Search']['calidad'] = $calidad;
			//completamos el titulo
			$title[] = __('Calidad',true).': '.$calidad;
		}

		$this->set('muestras', $this->paginate());
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
		debug($muestra);
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
