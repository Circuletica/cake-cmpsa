<?php
class LineaMuestrasController extends AppController {
    public $scaffold = 'admin';
    public $paginate = array(
	'order' => array('marca' => 'asc')
    );

    public function index() {
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
	$muestra = $this->LineaMuestra->Muestra->find(
	    'first',
	    array(
		'conditions' => array(
		    'Muestra.id' => $this->params['named']['from_id']
		),
		'recursive' => 2,
		'contain' => array(
		    'CalidadNombre',
		    'Operacion' => array(
			'fields' => array(
			    'id',
			    'referencia',
			    'embalaje_id'
			),
			'Transporte' => array(
			    'fields' => array(
				'id'
			    ),
			    'AlmacenTransporte'
			)
		    )
		)
	    )
	);
	$this->set('muestra',$muestra);

	//necesitamos un array de tipo 'list' de cakephp
	//primero se sacan todos los almacen_transportes
	//de todos los transportes de la operacion relativa
	//de la muestra
	$transportes = $muestra['Operacion']['Transporte'];
	$almacen_transportes = array();
	foreach ($transportes as $transporte) {
	    $almacen_transportes = array_merge($almacen_transportes, $transporte['AlmacenTransporte']);
	}
	//Recombinamos para pasar de:
	//array(
	//	(int) 0 => array(
	//		'id' => '8',
	//		'almacen_id' => '59',
	//		'transporte_id' => '45',
	//		'cuenta_almacen' => '54131',
	//		'cantidad_cuenta' => '20.00'
	//	),
	//	(int) 1 => array(
	//		'id' => '9',
	//		'almacen_id' => '50',
	//		'transporte_id' => '53',
	//		'cuenta_almacen' => '251478/5451',
	//		'cantidad_cuenta' => '33.00'
	//
	//A
	//
	//array(
	//	(int) 8 => '54131',
	//	(int) 9 => '251478/5451',
	//)
	$almacen_transportes = Hash::combine($almacen_transportes,'{n}.id','{n}.cuenta_almacen');
	$this->set('almacenTransportes', $almacen_transportes);

	if($this->request->is('post')){
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
	    if(number_format($suma_criba,2) != 100){
		//debug($suma_criba);
		$this->Session->setFlash('Linea de Muestra no guardada, la suma de criba no es 100%');
	    } else {
		if($this->LineaMuestra->save($this->request->data)){
		    $this->Session->setFlash('Linea de Muestra guardada');
		    //volvemos a la muestra a la que pertenece la linea creada
		    $this->redirect(array(
			'controller' => $this->params['named']['from_controller'],
			'action' => 'view',
			$this->params['named']['from_id']));
		}
	    }
	}
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Muestra/view');
	    $this->redirect(array('action'=>'index'));
	}
	$linea = $this->LineaMuestra->findById($id);
	$this->set('tipos', $this->tipoMuestras);
	$this->set('linea',$linea);
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
debug ($this->params['named']);
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
	//		$anterior = array(
	//			'controller' => $this->params['named']['from_controller'],
	//			'action'=>'view',
	//			$this->params['named']['from_id']
	//		);
	if (!$id) {
	    $this->Session->setFlash('URL mal formado');
	    $this->redirect(array(
		'controller' => 'muestras',
		'action'=>'index'
	    )
	);
	}
	$this->LineaMuestra->id = $id;
	//sacamos los datos de la muestra a la que pertenece la linea
	//nos sirven en la vista para detallar campos
	$linea_muestra = $this->LineaMuestra->find('first', array(
	    'conditions' => array('LineaMuestra.id' => $id),
	    'recursive' => 3
	)
    );
	$this->set('linea_muestra',$linea_muestra);
	$this->set('proveedor',$linea_muestra['Muestra']['Proveedor']['Empresa']['nombre']);
	$this->set('almacen',$linea_muestra['Muestra']['Almacen']['Empresa']['nombre']);
	if($this->request->is('get')) {
	    $this->request->data = $this->LineaMuestra->read();
	} else {
	    if ($this->LineaMuestra->save($this->request->data)) {
		$this->Session->setFlash('Línea '.
		    $this->request->data['LineaMuestra']['marca'].
		    ' modificada con éxito');
		$this->redirect($anterior);
	    } else {
		$this->Session->setFlash('Línea NO guardada');
	    }
	}
    }
}
?>
