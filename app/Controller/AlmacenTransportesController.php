<?php
class AlmacenTransportesController extends AppController {

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
			throw new NotFoundException(__('URL mal formada: falta id'));
		}

		$this->AlmacenTransporte->AlmacenTransporteAsociado->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';

		$almacentransportes = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
				),
				'contain' => array(
					'AlmacenTransporteAsociado' =>array(
						'Asociado'=> array(
							'fields'=> array(
								'id',
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
					'Retirada',
					'Transporte'=> array(
						'fields'=> array(
							'id',
							'linea',
							'matricula',
							'nombre_vehiculo',
							'operacion_id'
						),
						'Operacion' => array(
							'fields'=> array(
								'referencia'
							)
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
		if (!$almacentransportes) {
			throw new NotFoundException(__('No existe esa cuenta'));
		}
		$this->set(compact('almacentransportes'));

		//Necesario para controlar si hay alguna muestra hecha en la cuenta de almacén
		$this->loadModel('LineaMuestra');
		$lineamuestra = $this->LineaMuestra->find('first', array(
			'fields' => array(
				'LineaMuestra.id',
				'LineaMuestra.almacen_transporte_id'
			),
			'recursive'=>-1,
			'conditions' => array(
				'LineaMuestra.almacen_transporte_id'=> $id
			)
		));
		$this->set(compact('lineamuestra'));

		//Necesario para exportar en PDf
		$this->set(compact('id'));
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Flash->set('URL mal formado almacentransportes/add '.$this->params['named']['from_controller']);
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
			throw new NotFoundException(__('URL mal formado AlmacenTransporte/edit'));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form ($id = null) { //esta accion vale tanto para edit como add
		$this->set('action', $this->action);
		$this->loadModel('Almacen');
		$almacenes = $this->Almacen->find(
			'list',
			array(
				'fields' => array(
					'Almacen.id',
					'Empresa.nombre_corto'
				),
				'order' => array('Empresa.nombre_corto' => 'asc'),
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
			'first',
			array(
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
		$this->set(compact('cantidadcuenta')); //Para borrar después!!
		$this->set(compact('id'));
		//si es un edit, hay que rellenar el id, ya que si no se hace, al guardar el edit,
		// se va a crear un _nuevo_ registro, como si fuera un add
		if (!empty($id))$this->AlmacenTransporte->id = $id;
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['AlmacenTransporte']['id'] = $id;
			$this->request->data['AlmacenTransporte']['transporte_id'] = $transporte_id;
			if($id == NULL && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado) {
				if($this->AlmacenTransporte->save($this->request->data)){
					$nuevoId = $this->AlmacenTransporte->id;
					$this->Flash->set('Cuenta almacén guardada');
					$this->redirect(array(
						'controller' => 'almacen_transportes',
						'action' => 'distribucion',
						$nuevoId
					));
				}else{
					$this->Flash->set('Cuenta de almacén NO guardada');
				}
			}elseif ($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado){
				if($this->AlmacenTransporte->save($this->request->data)){
					$nuevoId = $this->AlmacenTransporte->id;
					$this->Flash->set('Cuenta almacén guardada');
					$this->redirect(array(
						'controller' => 'almacen_transportes',
						'action' => 'distribucion',
						$nuevoId
					));
				}
			}elseif ($this->request->data['AlmacenTransporte']['id']!=NULL){
				if($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta xor ($this->request->data['AlmacenTransporte']['cantidad_cuenta'] > $cantidadcuenta &&
					$this->request->data['AlmacenTransporte']['cantidad_cuenta'] - $cantidadcuenta <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado) xor($transporte['Transporte']['cantidad_embalaje'] == NULL)){
					if($this->AlmacenTransporte->save($this->request->data)){
						$this->Flash->set('Cuenta almacén modificada');
						$this->redirect(array(
							'controller' => 'almacen_transportes',
							'action' => 'view',
							$id
						));
					}
				}else{
					$this->Flash->set('La cantidad de bultos debe ser inferior');
				}
			}else{
				$this->Flash->set('La cantidad de bultos debe ser inferior');
			}
		}else{ //es un GET
			$this->request->data = $this->AlmacenTransporte->read(null, $id);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');
		$this->AlmacenTransporte->id = $id;
		if (!$this->AlmacenTransporte->exists()) {
			throw new NotFoundException('Cuenta corriente inválida');
		}
		if ($this->AlmacenTransporte->delete()){
			$this->Flash->success('Cuenta corriente almacén borrada');
			return $this->History->Back(-1);
		}
		$this->Flash->error('Cuenta corriente almacén NO borrada. Hay retiradas');
		$this->History->Back(0);
	}

	public function distribucion($id){
		$this->AlmacenTransporte->AlmacenTransporteAsociado->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';

		$almacentransportes = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
				),
				'contain' => array(
					'AlmacenTransporteAsociado' =>array(
						'Asociado'=> array(
							'fields'=> array(
								'id',
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
		if (empty($almacentransportes)) {
			$this->Flash->set('No existe cuenta con id: '.$id);
			$this->History->Back(0);
		}
		$this->set(compact('almacentransportes'));

		//Necesario para exportar en Pdf
		$this->set(compact('id'));
		$asociados_distribucion = Hash::combine($almacentransportes['AlmacenTransporteAsociado'], '{n}.asociado_id', '{n}');


		//GUARDAR LA DISTRIBUCIÓN DE LOS ASOCIADOS
		if($this->request->is('get')){ //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->AlmacenTransporte->read();
			foreach ($asociados_distribucion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['sacos_asignados'];
			}
		}else{
			$this->AlmacenTransporte->AlmacenTransporteAsociado->deleteAll(
				array(
					'AlmacenTransporteAsociado.almacen_transporte_id' => $id
				)
			);
			foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
				if ($cantidad != NULL) {
					$this->request->data['AlmacenTransporteAsociado']['almacen_transporte_id'] = $id;
					$this->request->data['AlmacenTransporteAsociado']['asociado_id'] = $asociado_id;
					$this->request->data['AlmacenTransporteAsociado']['sacos_asignados'] = $cantidad;
					$this->AlmacenTransporte->AlmacenTransporteAsociado->saveAll($this->request->data['AlmacenTransporteAsociado']);
				}
			}
			$this->Flash->set('Distribución asociados guardada');
			$this->redirect(
				array(
					'controller' => 'almacen_transportes',
					'action' => 'view',
					$id
				)
			);
		}
	}
}
