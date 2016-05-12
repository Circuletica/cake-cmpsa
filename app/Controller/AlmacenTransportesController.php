
<?php
class AlmacenTransportesController extends AppController {
		public $paginate = array(
		'order' => array('cuenta_almacen' => 'asc')
	);

	public function index() {
	
		$this->paginate['order'] = array('AlmacenTransporte.cuenta_almacen' => 'asc');
		//$this->paginate['recursive'] = 3;
		$this->paginate['contain'] = array(
			'Almacen'=>array(
			    'id',
			    'nombre_corto'
			)
		);

		$this->set('almacentransportes', $this->paginate());
	}

public function view($id = null) {

	if (!$id) {
	    $this->Session->setFlash('URL mal formada AlmacenTransporte/view ');
	    $this->redirect(array('action'=>'index'));
	}

	$this->AlmacenTransporte->AlmacenTransporteAsociado->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';
										
	$almacentransportes = $this->AlmacenTransporte->find(
		'first',
		array(
			'conditions' => array(
				'AlmacenTransporte.id' => $id
				),
			//'recursive' => 2,
			'contain' => array(
				'AlmacenTransporteAsociado' =>array(
					'Asociado'=> array(
								'fields'=> array(
									'id',
									//'nombre_corto'
									),
								'Retirada'=>array(
									'conditions' => array(
										'Retirada.almacen_transporte_id' => $id
										)
									),
								'Empresa',
								'AlmacenReparto'=> array(
									'conditions'=> array(
										'AlmacenReparto.id' => $id
										)
									)
								)	
				),
				
				'Transporte'=> array(
					'fields'=> array(
						'linea',
						'matricula',
						'nombre_vehiculo',
						'operacion_id'
						)
					),
					'Almacen' => array(
						'fields' => (
							'nombre_corto'
							)
						)
					)
			)
		);
	$this->set(compact('almacentransportes'));

	
	//Necesario para exportar en PDf
	$this->set(compact('id'));
	
/*	
	$n1 = 255;
	$n2 = 133;
	$n3 = 87; 
	$total = $n1+$n2+$n3;
	$resultado = $this->porcentaje($total, $n1, 0);
	$this->set(compact('resultado'));
*/
	
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

	if($this->action == 'edit'){
		$transporte_id = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
					),
				'fields'=> array(
					'id',
					'transporte_id'
					)
				)
			);
		$transporte_id = $transporte_id['AlmacenTransporte']['transporte_id'];
	}else{
		$transporte_id=$this->params['named']['from_id'];
	}
	$this->set(compact('transporte_id'));
	//$this->set('cantidadcuenta',$cantidadcuenta);
	//Calculamos la cantidad de sacos almacenados en la línea	
	$transporte = $this->AlmacenTransporte->Transporte->find(
			'first', array(
			'conditions' => array(
				'Transporte.id' => $transporte_id
				),
			'recursive' => 3,
			'fields' => array(
				'id',
				'matricula',
				'cantidad_embalaje'
				),
			'contain'=> array(
				'AlmacenTransporte',
				'Operacion' => array(
					'fields'=>array(
						'embalaje_id'
						),
					'Embalaje' => array(
						'fields' => array(
							'nombre'
							)
						)
					)
			)
		)
	);
	$this->set('transporte',$transporte);
	

	//if(!empty($transporte_id)){
	    $suma = 0;
	    $almacenado = 0;
	    foreach ($transporte['AlmacenTransporte'] as $suma){
	    	if ($transporte['Transporte']['id'] = $transporte_id){
	        	$almacenado = $almacenado + $suma['cantidad_cuenta'];
	       	}
	    }
	//}
	$this->set('almacenado',$almacenado);

	//Control de cantidad en la cuenta para edit y add
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

	}elseif( $id == NULL && $almacenado != 0){
		$cantidadcuenta = $this->AlmacenTransporte->find(
		'first',
		array(
			'conditions' =>array(
				'AlmacenTransporte.transporte_id' => $this->params['named']['from_id']	
				),
			'fields' => array(
				'AlmacenTransporte.cantidad_cuenta',
				'AlmacenTransporte.transporte_id'
				)
		)
		);
		$cantidadcuenta = $cantidadcuenta['AlmacenTransporte']['cantidad_cuenta'];
	}else{
		//En caso que se agregue al principio sin sacos guardados
		$cantidadcuenta = 0;
	}

	//si es un edit, hay que rellenar el id, ya que si no se hace, al guardar el edit,
	// se va a crear un _nuevo_ registro, como si fuera un add
	if (!empty($id))$this->AlmacenTransporte->id = $id;

	if (!empty($this->request->data)) {//ES UN POST
			$this->request->data['AlmacenTransporte']['id'] = $id;
			$this->request->data['AlmacenTransporte']['transporte_id'] = $transporte_id;
			if($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado && $id == NULL) {
					if($this->AlmacenTransporte->save($this->request->data)){
						$this->Session->setFlash('Cuenta almacén guardada');
						$this->redirect(array(
							'controller' => $this->params['named']['from_controller'],
							'action' => 'view',
							$transporte_id
						));
					}else{
						$this->Session->setFlash('Cuenta de almacén NO guardada');
					}
			}elseif ($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado){
					if($this->AlmacenTransporte->save($this->request->data)){
							$this->Session->setFlash('Cuenta almacén fuardada Sup');
							$this->redirect(array(
								'controller' => 'transportes',
								'action' => 'view',
								$transporte_id	
								)
							);
					}	
			}elseif ($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta xor (
					 $this->request->data['AlmacenTransporte']['cantidad_cuenta'] > $cantidadcuenta && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] - $cantidadcuenta <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado) xor
					($transporte['Transporte']['cantidad_embalaje'] == NULL)){
					if($this->AlmacenTransporte->save($this->request->data)){
							$this->Session->setFlash('Cuenta almacén modificada');
							$this->redirect(array(
								'controller' => 'transportes',
								'action' => 'view',
								$transporte_id	
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
	public function distribucion($id){
	$this->AlmacenTransporte->AlmacenTransporteAsociado->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';
										
	$almacentransportes = $this->AlmacenTransporte->find(
		'first',
		array(
			'conditions' => array(
				'AlmacenTransporte.id' => $id
				),
			//'recursive' => 2,
			'contain' => array(
				'AlmacenTransporteAsociado' =>array(
					'Asociado'=> array(
								'fields'=> array(
									'id',
									//'nombre_corto'
									),
								'Retirada'=>array(
									'conditions' => array(
										'Retirada.almacen_transporte_id' => $id
										)
									),
								'Empresa',
								'AlmacenReparto'=> array(
									'conditions'=> array(
										'AlmacenReparto.id' => $id
										)
									)
								)	
				),
				
				'Transporte'=> array(
					'fields'=> array(
						'linea',
						'matricula',
						'nombre_vehiculo',
						'operacion_id'
						)
					),
					'Almacen' => array(
						'fields' => (
							'nombre_corto'
							)
						)
					)
			)
		);
	$this->set(compact('almacentransportes'));
	//Necesario para exportar en Pdf
	$this->set(compact('id'));
	$asociados_distribucion = Hash::combine($almacentransportes['AlmacenTransporteAsociado'], '{n}.asociado_id', '{n}');


	if($this->request->is('get')){ //al abrir el edit, meter los datos de la bdd
	    $this->request->data = $this->AlmacenTransporte->AlmacenTransporteAsociado->read();
	    foreach ($asociados_distribucion as $clave => $asociado) {
		$this->request->data['CantidadAsociado'][$clave] = $asociado['sacos_asignados'];
	    }
	} 
	
	
	}




}
