
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
	$this->set('action', $this->action);
 	
 	//si es un edit(), hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add

 		$this->loadModel('Almacen');		
		$almacenes = $this->Almacen->find('list', array(
			'fields' => array(
				'Almacen.id',
				'Empresa.nombre_corto'
				),
			'order' => array(
				'Empresa.nombre_corto' => 'asc'
				),
			'recursive' => 1
			)
		);	
	if (!empty($id)) {
	    $this->AlmacenTransporte->id = $id;
	    //sacamos los datos de la muestra a la que pertenece la linea
	    //nos sirven en la vista para detallar campos
	    $almacen_transporte = $this->AlmacenTransporte->findById($id);
	    $transporte_id=$almacen_transporte['Transporte']['id'];
	} else { //un add()
	    $transporte_id = $this->params['named']['from_id'];
	}


		$this->set(compact('almacenes'));

		$transporte = $this->AlmacenTransporte->Transporte->find(
			'first',
			array(
			'conditions' => array(
				'Transporte.id' => $transporte_id
				),
			'recursive' => 1,
			'fields' => array(
				'id',
				'cantidad_embalaje'
				)
			)
			);
	//	$transporte += $transporte['Transporte'];
	//	unset($transporte['Transporte']);
	//llegado a este punto, vengamos de add o edit
	//$transporte tiene el mismo valor
	$this->set(compact('transporte'));

	//Calculamos la cantidad de sacos almacenados en la línea
	if(!empty($transporte['Transporte']['id'])){
	    $suma = 0;
	    $almacenado=0;
	    foreach ($transporte['AlmacenTransporte'] as $suma):
	        if ($almacenTransporte['transporte_id'] = $transporte['Transporte']['id']):
	            $almacenado = $almacenado + $suma['cantidad_cuenta'];
	            endif;
	    endforeach;
	}
	$almacenado = $transporte['Transporte']['cantidad_embalaje'] - $almacenado;  
	$this->set('almacenado',$almacenado);

	$this->AlmacenTransporte->id = $id;
	$this->set('action', $this->action);

	if($this->request->is('post')){
		$this->request->data['AlmacenTransporte']['transporte_id'] = $id;
		if($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= ($transporte['Transporte']['cantidad_embalaje'] - $almacenado)){
			if($this->AlmacenTransporte->save($this->request->data) ){
				$this->Session->setFlash('Cuenta corriente almacén guardada');
				$this->redirect(array(
					'controller' => 'transportes',
					'action' => 'view',
					$id
				));
			}else{
				$this->Session->setFlash('Cuenta de almacén NO guardada');
			}
		}else{
				$this->Session->setFlash('La cantidad de bultos debe ser inferior');
		}
	}

/*EDIT EDIT EDIT EDIT EDIT EDIT EDIT*/
	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	/*if (!empty($id)) $this->AlmacenTransporte->id = $id){
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
	}*/

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
