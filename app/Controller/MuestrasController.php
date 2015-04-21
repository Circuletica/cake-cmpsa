<?php
class MuestrasController extends AppController {
	public $paginate = array(
		'recursive' => 2,
		'order' => array('Muestra.referencia' => 'asc')
	);

	public function search() {
		//debug($proveedores);
		//la página a la que redirigimos después de mandar  el formulario de filtro
		$url['action'] = 'index';
		//construimos una URL con los elementos de filtro, que luego se usan en el paginator
		//la URL final tiene ese aspecto:
		//http://cake-cmpsa.gargantilla.net/muestras/index/Search.referencia:mireferencia/Search.id:3
		foreach ($this->data as $k=>$v){ 
			foreach ($v as $kk=>$vv){ 
			if ($vv) {$url[$k.'.'.$kk]=$vv;} 
			} 
		}
		$this->redirect($url,null,true);
	}
	
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
					'Muestra.proveedor_id',
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
		//necesitamos la lista de proveedor_id/nombre para rellenar el select
		//del formulario de busqueda
		$proveedores = $this->Muestra->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			)
		);
		$this->set('proveedores',$proveedores);
		//los elementos de la URL pasados como Search.* son almacenados por cake en $this->passedArgs[]
		//por ej.
		//$passedArgs['Search.palabras'] = mipalabra
		//$passedArgs['Search.id'] = 3
		
		//Si queremos un titulo con los criterios de busqueda
		$titulo = array();

		//primero el filtro por id
//		if(isset($this->passedArgs['Search.id'])) {
//			//ponemos la condicion
//			debug($this->passedArgs['Search.id']);
//			$this->paginate['conditions'][]['Muestra.id'] = $this->passedArgs['Search.id'];
//			//guardamos los datos de búsqueda para que el formulario 'se acuerde' de la opcion
//			$this->request->data['Search']['id'] = $this->passedArgs['Search.id'];
//			//generamos el titulo
//			$title[] = 'ID: '.$this->passedArgs['Search.id'];
//		}
		//filtramos por referencia
		if(isset($this->passedArgs['Search.referencia'])) {
			$referencia = $this->passedArgs['Search.referencia'];
			$this->paginate['conditions'][]['Muestra.referencia LIKE'] = "%$referencia%";
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['referencia'] = $referencia;
			//completamos el titulo
			$title[] = 'Referencia: '.$referencia;
		}
		//filtramos por proveedor
		if(isset($this->passedArgs['Search.proveedor_id'])) {
			$proveedor_id = $this->passedArgs['Search.proveedor_id'];
			$this->paginate['conditions'][]['Proveedor.id LIKE'] = "$proveedor_id";
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['proveedor_id'] = $proveedor_id;
			//completamos el titulo
			$title[] ='Proveedor: '.$proveedores[$proveedor_id];
		}
		//filtramos por calidad
		if(isset($this->passedArgs['Search.calidad'])) {
			$calidad = $this->passedArgs['Search.calidad'];
			$this->paginate['conditions'][]['Muestra.referencia LIKE'] = "%$calidad%";
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['calidad'] = $calidad;
			//completamos el titulo
			$title[] ='Calidad: '.$calidad;
		}
		//filtramos por aprobado
//		if(isset($this->passedArgs['Search.aprobado'])) {
//			$this->paginate['conditions'][]['Muestra.aprobado'] = $this->passedArgs['Search.aprobado']?1:0;
//			$this->data['Search']['aprobado'] = $this->passedArgs['Search.aprobado'];
//			$titulo[] = ($this->passedArgs['Search.aprobado']) ?
//				'Muestras aprobadas' : 'Muestras rechazadas';
//		}

		$muestras = $this->paginate();
		$this->set('muestras', $muestras);
		//generamos el título
		if (isset($title)) {$title = implode(' | ', $title);}
		$title = (isset($title)&&$title)?$title:'Todas las muestras';
		//pasamos los datos a la vista
		$this->set(compact('muestras','title'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$muestra = $this->Muestra->find('first', array(
			'conditions' => array('Muestra.id' => $id),
			'recursive' => 2));
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
