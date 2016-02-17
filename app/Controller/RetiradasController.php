<?php
class RetiradasController extends AppController {
	public $scaffold = 'admin';

	public function index() {
	$this->paginate['order'] = array('Retirada.fecha_retirada' => 'asc');
	$this->paginate['contain'] = array(
			'Asociado',
			'AlmacenTransporte' => array (
				'Almacen' => array (
					'fields' => array(
						'nombre_corto'
						)
					)
				),
			'Operacion' => array (
					'fields' => array(
						'id',
						'referencia'
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
		
	$retiradas = $this->Retirada->find(
		'first',
		array(
	   		'conditions' => array(
	   			'Retirada.id' => $id
	   			),
	   		'recursive' => 4,			
			'contain' => array(
				'AlmacenTransporte' => array(
					'fields' => array(
						'almacen_id',
						'cantidad_cuenta',
						'cuenta_almacen',
						'marca_almacen'
						),
					'Almacen' => array(
						'fields' => array(
							'nombre_corto'
						)
					)
				),
				'Asociado' => array(
					'fields' => array(
						'id',
						'nombre_corto'
						)
					),				
				'Operacion' => array(
					'fields' => array(
						'id',
						'referencia'
					),
					'AsociadoOperacion'=>array(
						'fields'=>array(
							'cantidad_embalaje_asociado',
							'asociado_id'
							)
						)
				)
			)//Cierre CONTAIN
		)
	);
	$this->set(compact('retiradas'));

	$total_sacos_retirados = 0;
	$total_peso_retirado = 0;

}

	public function view_asociado($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
/*		if (!$id) {
			$this->Session->setFlash('URL mal formado Retirada/view');
			$this->redirect(array('action'=>'index'));
		}*/
	$operacion_id = $this->params['named']['from_id'];
	$this->set(compact('operacion_id'));
		
	$retiradas = $this->Retirada->find(
		'all',
		array(
			'conditions' =>array(
				'Retirada.asociado_id' => $this->params['named']['asociado_id'],
				'Retirada.operacion_id'=> $operacion_id
	   			),
	   		'recursive' => 2,			
			'contain' => array(
				'AlmacenTransporte' => array(
					'fields' => array(
						'almacen_id',
						'cantidad_cuenta',
						'cuenta_almacen',
						'marca_almacen'
						),
					'Almacen' => array(
						'fields' => array(
							'nombre_corto'
						)
					)
				),
				'Asociado' => array(
					'fields' => array(
						'id',
						'nombre_corto'
						)
					),				
				'Operacion' => array(
					'fields' => array(
						'id',
						'referencia'
					)
				)
			)//Cierre CONTAIN
		)
	);

	$operacion = $this->Retirada->Operacion->find(
		'first',
		array(
			'conditions' => array(
				'Operacion.id'=>$operacion_id
				),
			'recursive'=>-1,
			'fields' => array(
				'id',
				'referencia')
			));
	$this->set('operacion',$operacion);

	$asociado_nombre = $this->Retirada->Asociado->find(
		'first',
		array(
			'conditions' => array(
				'Asociado.id'=>$this->params['named']['asociado_id']
				),
			'recursive'=>-1,
			'fields' => array(
				'id',
				'nombre_corto')
			));
	$this->set(compact('asociado_nombre'));	

	$this->set(compact('retiradas'));

	$total_sacos_retirados = 0;
	$total_peso_retirado = 0;

}
   public function add() {

   	if(empty($this->params['named']['from_id'])){
   		$this->form();
   	}else{
 		$this->form($this->params['named']['from_id']); 
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

     public function form($id = null) { //esta acción vale tanto para edit como add

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
	//Sacamos id de operaciones para listarla
	$operaciones = $this->Retirada->Operacion->find(
				'list'
		    	);
	if(empty($this->params['named']['from_id'])){
		$this->set('operacion_id',$operacion_id = NULL);
	}else{
		$this->set('operacion_id',$this->passedArgs['from_id']);
	}
	$this->set(compact('operaciones'));

	$operaciones_asociados = $this->Retirada->Operacion->find(
				'all',
				array(
					'contain' => array(
						'AsociadoOperacion' => array(
						'Asociado' => array(
							'fields' => array(
								'id',
								'nombre_corto'
							)
						)
						)
					)
				)
	);

foreach($operaciones_asociados as $clave => $operacion){
	
	foreach($operacion['AsociadoOperacion'] as $asociado_operacion){
		$operacion['Asociado'][] = $asociado_operacion['Asociado'];
	}
	$operaciones_asociados[$clave] = $operacion;
	unset($operaciones_asociados[$clave]['AsociadoOperacion']);
}
	$operaciones_asociados = Hash::combine($operaciones_asociados, '{n}.Operacion.id','{n}');
	$this->set(compact('operaciones_asociados'));



	$operaciones_almacen = $this->Retirada->AlmacenTransporte->Transporte->Operacion->find(
		'all',
		array(

			'contain' => array(		
					'Transporte' => array(
						'fields'=> array(
							'operacion_id'
							),
						'AlmacenTransporte' => array(
							'fields'=> array(
								'id',
								'cuenta_almacen'
								)
							)
						)
					)
			)
		);
	foreach($operaciones_almacen as $clave => $cuenta){
	
	foreach($cuenta['Transporte'] as $transporte){
		$cuenta['AlmacenTransporte'][] = $transporte['AlmacenTransporte'];
	}
	$operaciones_almacen[$clave] = $cuenta;
	unset($operaciones_almacen[$clave]['AlmacenTransporte']);
}
	$operaciones_almacen = Hash::combine($operaciones_almacen, '{n}.Operacion.id','{n}');
	$this->set(compact('operaciones_almacen'));

	//Listamos las cuentas corrientes de los almacenes
	//$this->loadModel('AlmacenTransporte');
	$almacenTransportes = $this->Retirada->AlmacenTransporte->find(
		'list',
		array(
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

	    if($id != NULL && $this->Retirada->save($this->request->data)){
		$this->Session->setFlash('Retirada guardada');
		$this->redirect(array(
		    'action' => 'view_trafico',
		    'controller' => 'operaciones',
		    $id
		));
	    }elseif($id == NULL && $this->Retirada->save($this->request->data)) {
	    $this->Session->setFlash('Retirada guardada');
		$this->redirect(array(
		    'action' => 'index',
		    'controller' => 'retiradas'
		));
	    }else{
		$this->Session->setFlash('Retirada NO guardada');
	    }
	} else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
	    $this->request->data = $this->Retirada->read(null, $id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')){
	    throw new MethodNotAllowedException();
	}
	if ($this->Retirada->delete($id)){
	    $this->Session->setFlash('Retirada borrada');
		$this->redirect(array('action'=>'index'));
    }

}
}