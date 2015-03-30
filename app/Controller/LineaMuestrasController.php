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
			//comprobamos que el total de criba es de 100%
			$suma_criba = $this->request->data['LineaMuestra']['criba20']+
				$this->request->data['LineaMuestra']['criba19']+
				$this->request->data['LineaMuestra']['criba13p']+
				$this->request->data['LineaMuestra']['criba18']+
				$this->request->data['LineaMuestra']['criba12p']+
				$this->request->data['LineaMuestra']['criba17']+
				$this->request->data['LineaMuestra']['criba11p']+
				$this->request->data['LineaMuestra']['criba16']+
				$this->request->data['LineaMuestra']['criba10p']+
				$this->request->data['LineaMuestra']['criba15']+
				$this->request->data['LineaMuestra']['criba9p']+
				$this->request->data['LineaMuestra']['criba14']+
				$this->request->data['LineaMuestra']['criba8p']+
				$this->request->data['LineaMuestra']['criba13']+
				$this->request->data['LineaMuestra']['criba12'];
			debug($this->request->data['LineaMuestra']);
			debug($suma_criba);
			if($suma_criba != 100){
				$this->Session->setFlash('Linea de Muestra no guardada, la suma de criba no es 100%');
				$this->redirect(array(
					'controller' => 'linea_muestras',
					'action' => 'add',
					'from_controller' => $this->params['named']['from_controller'],
					'from_id' => $this->params['named']['from_id']));
			}
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
		$this->set('linea',$linea);
		//debug($linea['LineaMuestra']);
		//Sacamos la criba ponderada correspondiente
		//$this->loadModel('CribaPonderada');
		//$this->CribaPonderada->findById($id);
		$suma_linea = $linea['LineaMuestra']['criba20'] +
			$linea['LineaMuestra']['criba19'] +
			$linea['LineaMuestra']['criba13p'] +
			$linea['LineaMuestra']['criba18'] +
			$linea['LineaMuestra']['criba12p'] +
			$linea['LineaMuestra']['criba17'] +
			$linea['LineaMuestra']['criba11p'] +
			$linea['LineaMuestra']['criba16'] +
			$linea['LineaMuestra']['criba10p'] +
			$linea['LineaMuestra']['criba15'] +
			$linea['LineaMuestra']['criba9p'] +
			$linea['LineaMuestra']['criba14'] +
			$linea['LineaMuestra']['criba8p'] +
			$linea['LineaMuestra']['criba13'] +
			$linea['LineaMuestra']['criba12'];
		$suma_ponderada = $linea['CribaPonderada']['criba20'] +
			$linea['CribaPonderada']['criba19'] +
			$linea['CribaPonderada']['criba18'] +
			$linea['CribaPonderada']['criba17'] +
			$linea['CribaPonderada']['criba16'] +
			$linea['CribaPonderada']['criba15'] +
			$linea['CribaPonderada']['criba14'] +
			$linea['CribaPonderada']['criba13'] +
			$linea['CribaPonderada']['criba12'];
		//debug($linea);
		$this->set('suma_linea',$suma_linea);
		$this->set('suma_ponderada',$suma_ponderada);
		//debug($suma_linea);
	}

	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
		endif;
		if ($this->LineaMuestra->delete($id)):
			$this->Session->setFlash('Línea de muestra borrada');
		$this->redirect(array(
			'controller' => $this->params['named']['from_controller'],
			'action'=>'view',
			$this->params['named']['from_id']
		));
		endif;
	}

	public function edit( $id = null) {
		//DRY, guardamos la página de donde venimos,
		//para volver después de editar
		$anterior = array(
			'controller' => $this->params['named']['from_controller'],
			'action'=>'view',
			$this->params['named']['from_id']
		);
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect($anterior);
	//		$this->redirect(array(
	//			'controller' => $this->params['named']['from_controller'],
	//			'action'=>'view',
	//			$this->params['named']['from_id']
	//			)
	//		);
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
				$this->redirect($anterior);
			else:
				$this->Session->setFlash('Línea NO guardada');
			endif;
		endif;
	}
}
?>
