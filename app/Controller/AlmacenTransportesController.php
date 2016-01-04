
<?php
class AlmacenTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
		$this->set('almacentransportes', $this->paginate());
	}

    public function add() {
	$this->form($this->params['named']['from_id']);
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'view',
		'controller' => $this->params['named']['from_controller'],
		$this->params['from_id']
	    ));
	}

	$this->form($id);
	$this->render('form');
    }

 public function form ($id = null) { //esta accion vale tanto para edit como add
 		$this->loadModel('Almacen');		
		$almacenes = $this->Almacen->find('list', array(
		'fields' => array('Almacen.id','Empresa.nombre_corto'),
	    'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1)
		);	
		$this->set(compact('almacenes'));



		$transporte = $this->AlmacenTransporte->Transporte->find('first', array(
			'conditions' => array('Transporte.id' => $id),
			'recursive' => 3,
			'fields' => array(
				'Transporte.id',
				'Transporte.cantidad_embalaje')
		));
		$this->set('transporte',$transporte);

	//sacamos los datos de la operacion  al que pertenece la linea
		//nos sirven en la vista para detallar campos
	/*$transporte = $this->AlmacenTransporte->Transporte->find('all');
	
*/
		$this->AlmacenTransporte->id = $id;
	/*	$embalaje = $this->AlmacenTransporte->Transporte->Operacion->Contrato->ContratoEmbalaje->find(
			'first',
			array(
				'recursive' => 4,
				'fields' => array('Embalaje.nombre')
			)
		);	*/
		//$this->set('embalaje',$embalaje); //Tipo de bulto para la cantidad en el titulo.
			//sacamos los datos de transportes  al que pertenece el almacen transporte


		//opcion 1 = 2 queries
	//	$transportes = $this->Transporte->find('all');
	//	$contrato_embalajes = $this->Transporte->Operacion->Contrato->ContratoEmbalaje->find('all');

		//opcion 2 = 1 query
	//	$transportes = $this->Transporte->find('all');
	//	$contrato_embalajes = $transportes['Operacion']['Contrato']['ContratoEmbalaje'];

		$this->set('action', $this->action);



	if($this->request->is('post')):
		$this->request->data['AlmacenTransporte']['transporte_id'] = $id;
		if($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje']):
			if($this->AlmacenTransporte->save($this->request->data) ):
				$this->Session->setFlash('Cuenta corriente almacén guardada');
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$id
				));
			else:
				$this->Session->setFlash('Cuenta de almacén NO guardada');
			endif;
			else:
				$this->Session->setFlash('La cantidad de bultos debe ser inferior');
			endif;
		endif;

/*EDIT EDIT EDIT EDIT EDIT EDIT EDIT*/
	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) $this->AlmacenTransporte->id = $id;
	if (!empty($this->request->data)){  //es un POST
	    if ($this->AlmacenTransporte->save($this->request->data)) {
		$this->Session->setFlash('Cuenta de almacén guardada');
		$this->redirect(array(
		    'action' => 'view',
		    'controller' => $this->params['named']['from_controller'],
		    $this->params['named']['from_id']
		));
	    } else {
		$this->Session->setFlash('Cuenta de almacén NO guardada');
	    }
	} else { //es un GET
	    $this->request->data = $this->AlmacenTransporte->read(null, $id);
	}

 }
 	public function delete($id = null) {
			if (!$id or $this->request->is('get')) :
			    throw new MethodNotAllowedException();
		endif;
		if ($this->AlmacenTransporte->delete($id)):
		    $this->Session->setFlash('Cuenta corriente almacén borrada');
		$this->redirect(array(
		    'controller' => $this->params['named']['from_controller'],
		    'action'=>'view',
		    $this->params['named']['from_id']
		));
		endif;
		    }
}

/*


	public function add() {

	if($this->request->is('post')):
		$this->request->data['AlmacenTransporte']['transporte_id'] = $this->params['named']['from_id'];
			if($this->AlmacenTransporte->save($this->request->data) ):
				$this->Session->setFlash('Cuenta corriente almacén guardada guardada');
				$this->redirect(array(
					'controller' => 'transportes',
					'action' => 'view',
					$this->params['named']['from_id']));
	endif;
		endif;

	$this->set('almacenes', $this->AlmacenTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	}

	public function edit($id = null) {
		echo $id;	
		if (!$id) {
			//throw new MethodNotAllowedException();
			$this->Session->setFlash('URL mal formado controller/edit '.$this->params['named']['from_controller'].' '.$this->params['named']['from_id']);
			$this->redirect(array(
				'controller' => $this->params['named']['from_controller'],
				'action'=>'transportes'));
		}
		$this->AlmacenTransporte->id = $id;
		if($this->request->is('get')):
			$this->request->data = $this->AlmacenTransporte->read();
		else:
			if($this->AlmacenTransporte->save($this->request->data)):
				$this->Session->setFlash('Cuenta corriente '.$this->request->data['AlmacenTransporte']['cuenta_almacen'].' modificada con éxito');
				$this->redirect(array(
	//			'controller' => 'transportes',
					'action' => 'view',
					'controller' => 'transportes',
							    $this->params['named']['from_id']
					));




			else:
				$this->Session->setFlash('¡No se ha podido guardar!');
			endif;
		endif;

	$this->set('almacenes', $this->AlmacenTransporte->Almacen->find('list', array(
	'fields' => array('Almacen.id','Empresa.nombre_corto'),
	'recursive' => 1))
	);	

	}
*/
