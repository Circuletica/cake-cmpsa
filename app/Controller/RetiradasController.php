<?php
class RetiradasController extends AppController {
	public $scaffold = 'admin';

	public function index() {
	/*$this->Retirada->bindModel(
		array(
			'belongsTo' => array(
				'Operacion'=> array(
					'foreignKey' => false,
					'conditions' => array('OperacionRetirada.id = Operacion.id')
					)
				)
			)
		);*/


	$this->paginate['order'] = array('Retirada.fecha_retirada' => 'asc');
	$this->paginate['contain'] = array(
			'Asociado',
			'AlmacenTransporte' => array (
				'Almacen' => array (
					'fields' => ('nombre_corto')
					)
				),
			'OperacionRetirada' => array (
				'Operacion' => array (
					'fields' => array(
						'id',
						'referencia')
				)
			),
			//'Operacion',
	);

	$retiradas = $this->paginate();
	$this->set(compact('retiradas'));

	}

	public function view($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Retirada/view');
			$this->redirect(array('action'=>'index'));
		}
		
	$retirada = $this->Retirada->find('first',array(
	    'conditions' => array('Retirada.id' => $id),
	    'recursive' => 3));
	$this->set('retirada',$retirada);

	//Sacamos la referencia de operaciones ligada a retiradas
	$this->loadModel('OperacionRetirada');

	$operacion = $this->Retirada->OperacionRetirada->find(
				'first',
				array(
		    		'conditions' => array(
		    			'OperacionRetirada.retirada_id' => $retirada['Retirada']['id']
		    		)
		    	)
			);	
	$this->set('operacion',$operacion);
	}

    public function add() {
    echo $this->form($this->params['named']['from_id']); 

	/*if($this->form($this->params['named']['from_id']) != NULL){
		echo "SI FROM_ID ES NULL SE VE EL DESPLEGABLE DE OPERACIONES.
		SI FROM_ID TIENE UN VALOR SE OCULTA POR TENER YA ASIGNADA LA OPERACION";
	}
	*/
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'retiradas'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

     public function form($id = null) { //esta acción vale tanto para edit como add




	//Sacamos id de operaciones para listarla
	$operaciones = $this->Retirada->OperacionRetirada->Operacion->find(
				'list'
		    	);
	$this->set('operacion_id',$this->passedArgs['from_id']);
	$this->set(compact('operaciones'));



	//Listamos el nombre de asociados
	$this->loadModel('Asociado');	
	$asociados = $this->Asociado->find(
		'list',
		array(
		'fields' => array(
			'Asociado.id',
			'Empresa.nombre_corto'),
		'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1)
	);
	$this->set(compact('asociados'));

	//Listamos las cuentas corrientes de los almacenes
	//$this->loadModel('AlmacenTransporte');
	$almacenTransportes = $this->Retirada->AlmacenTransporte->find(
		'list',
		array(
			//'conditions' => array('AlmacenTransporte.id' => $id)
			'fields' => array(
				'AlmacenTransporte.id',
				'AlmacenTransporte.cuenta_almacen'),
			'order' => array('AlmacenTransporte.cuenta_almacen' => 'asc')
			)
		);

	$this->set(compact('almacenTransportes'));

	$this->set('action', $this->action);

	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) $this->Retirada->id = $id; 
	if(!empty($this->request->data)) { //la vuelta de 'guardar' el formulario
	    if($this->Retirada->save($this->request->data)){
		$this->Session->setFlash('Retirada guardada');
		$this->redirect(array(
		    'action' => 'view',
		    'controller' => 'retiradas',
		    $id
		));
	    } else {
		$this->Session->setFlash('Retirada NO guardada');
	    }
	} else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
	    $this->request->data = $this->Retirada->read(null, $id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
	if ($this->Retirada->delete($id)){
	    $this->Session->setFlash('Retirada borrada');
	    $this->redirect(array(
		'controller' => 'retiradas',
		'action'=>'index',
	    ));
	}
    }

}
?>
