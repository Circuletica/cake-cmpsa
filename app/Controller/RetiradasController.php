<?php
class RetiradasController extends AppController {
	public $scaffold = 'admin';

	public function index() {
	$this->paginate['order'] = array('Retirada.fecha_retirada' => 'asc');
	$this->paginate['contain'] = array(
			'Asociado',
			'AlmacenTransporte' => array (
				'Almacen' => array (
					'fields' => ('nombre_corto')
					)
				)
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
	    'recursive' => 2));
	$this->set('retirada',$retirada);
	}

    public function add() {
    echo $this->form($this->params['named']['from_id']); 

	if($this->form($this->params['named']['from_id']) != NULL){
		echo "SI FROM_ID ES NULL SE VE EL DESPLEGABLE DE OPERACIONES.
		SI FROM_ID TIENE UN VALOR SE OCULTA POR TENER YA ASIGNADA LA OPERACION";
	}
	
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

     public function form($id) { //esta acción vale tanto para edit como add

	//Listamos el nombre de asociados
	$this->loadModel('Asociado');	
	$asociados = $this->Asociado->find('list',
		array(
		'fields' => array(
			'Asociado.id',
			'Empresa.nombre_corto'),
		'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1)
	);
	$this->set(compact('asociados'));

	//Saco datos de la operación al que pertenece la linea
	//nos sirven  en la vista para detallar campos
	$operacionesRetirada = $this->Retirada->OperacionRetirada->find(
				'all',
				array(
		    		'conditions' => array(
		    			'OperacionRetirada.id' => $id
		    		),
		    		'contain' => array(
		    			'Retirada'),
		    		'fields' => array(
		    				'OperacionRetirada.id',
		    		)
		    	)
			);	
	$operacionesRetirada = Hash::combine($operacionesRetirada, '{n}.OperacionRetirada.id','{n}');
	$this->set(compact('operacionesRetirada'));

	//Listamos cuenta de los almacenes
    $almacen_transportes = array();
   // foreach ($operacion as $operaciones) {
		$transportes = $operaciones['Transporte'];
			foreach ($transportes as $transporte) {
			    $almacen_transportes = array_merge($almacen_transportes, $transporte['AlmacenTransporte']);
			}
	//  }
	$this->set('almacentransportes', $almacen_transportes);
	$this->set(compact('operaciones'));


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
