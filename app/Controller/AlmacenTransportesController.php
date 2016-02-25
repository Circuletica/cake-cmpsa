
<?php
class AlmacenTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
		$this->set('almacentransportes', $this->paginate());
	}

    public function add() {
    		//el id y la clase de la entidad de origen vienen en la URL
	if (!$this->params['named']['from_id']) {
	    $this->Session->setFlash('URL mal formado almacentransportes/add '.$this->params['named']['from_controller']);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => 'index')
	    );
	}
	$this->form();
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
	$this->set(compact('almacenes'));
	
	if($id != NULL){
	$cantidadcuenta = $this->AlmacenTransporte->find(
		'first',
		array(
			'conditions' =>array(
				'AlmacenTransporte.id' => $id	
				),
			'fields' => array(
				'cantidad_cuenta'
				)
		)
	);
	$cantidadcuenta = $cantidadcuenta['AlmacenTransporte']['cantidad_cuenta'];
	}else{
		$cantidadcuenta = $this->AlmacenTransporte->find(
		'first',
		array(
			'conditions' =>array(
				'AlmacenTransporte.transporte_id' => $this->params['named']['from_id']	
				),
			'fields' => array(
				'cantidad_cuenta',
				'transporte_id'
				)
		)
	);
	$cantidadcuenta = $cantidadcuenta['AlmacenTransporte']['cantidad_cuenta'];
	}
	$this->set('cantidadcuenta',$cantidadcuenta);
	//Calculamos la cantidad de sacos almacenados en la línea	
	$transporte = $this->AlmacenTransporte->Transporte->find(
			'first', array(
			'conditions' => array(
				'Transporte.id' => $this->params['named']['from_id']
				),
			'recursive' => 2,
			'fields' => array(
				'id',
				'matricula',
				'cantidad_embalaje'
				)
			)
	);
	$this->set('transporte',$transporte);
	

	if(!empty($this->params['named']['from_id'])){
	    $suma = 0;
	    $almacenado = 0;
	    foreach ($transporte['AlmacenTransporte'] as $suma){
	    	if ($transporte['Transporte']['id'] = $this->params['named']['from_id']){
	        	$almacenado = $almacenado + $suma['cantidad_cuenta'];
	       	}
	    }
	}
	$this->set('almacenado',$almacenado);
	
	//si es un edit, hay que rellenar el id, ya que si no se hace, al guardar el edit,
	// se va a crear un _nuevo_ registro, como si fuera un add
	if (!empty($id))$this->AlmacenTransporte->id = $id;
	if (!empty($this->request->data)) {//ES UN POST
			$this->request->data['AlmacenTransporte']['id'] = $id;
			$this->request->data['AlmacenTransporte']['transporte_id'] = $this->params['named']['from_id'];
			
			if($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado && $id == NULL){
					if($this->AlmacenTransporte->save($this->request->data)){
						$this->Session->setFlash('Cuenta almacén guardada');
						$this->redirect(array(
							'controller' => $this->params['named']['from_controller'],
							'action' => 'view',
							$this->params['named']['from_id']
						));
					}else{
						$this->Session->setFlash('Cuenta de almacén NO guardada');
					}
			}elseif (($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta) xor (
					 $this->request->data['AlmacenTransporte']['cantidad_cuenta'] > $cantidadcuenta && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] - $cantidadcuenta <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado)){
					if($this->AlmacenTransporte->save($this->request->data)){
							$this->Session->setFlash('Cuenta almacén modificada');
							$this->redirect(array(
								'controller' => 'transportes',
								'action' => 'view',
								$this->params['named']['from_id']	
								)
							);
					}				
			}else{
					$this->Session->setFlash('La cantidad de bultos debe ser inferior');
			}
	}else{ //es un GET
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
