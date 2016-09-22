<?php
class AlmacenTransportesController extends AppController {

	public function index() {

		$this->set('action', $this->action);	//Se usa para tener la misma vista

		$this->paginate['order'] = array('AlmacenTransporte.cuenta_almacen' => 'asc');
		//$this->paginate['recursive'] = 3;

		$this->paginate['contain'] = array(
			'Almacen'=>array(
				'fields'=>array(
					'nombre_corto'
				)
			),
			'OperacionLogistica' => array(
				'fields' => array(
					'referencia',
					'contrato_id'
				)
			),
			'Contrato'=> array(
				'fields' => array(
					'calidad_id'
				)
			),
			'Calidad'=> array(
				'fields'=> array(
					'nombre'
				)
			),
			'Transporte'=>array(
				'fields'=> array(
					'linea',
					'operacion_logistica_id'
				)
			),
			'AsociadoCuenta'
		);
		if(isset($this->passedArgs['Search.desde'])) {
			$criterio = strtr($this->passedArgs['Search.desde'],'_','/');
			$this->paginate['conditions'] = array(
				'AlmacenTransporte.fecha_despacho_op >= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['desde'] = $criterio;
			//completamos el titulo
			$title[] = 'Transporte: '.$criterio;
		}
		if(isset($this->passedArgs['Search.hasta']) and $this->passedArgs['Search.hasta'] != '--') {
			$criterio = strtr($this->passedArgs['Search.hasta'],'_','/');
			$this->paginate['conditions'] += array(
				'AlmacenTransporte.fecha_despacho_op <= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['hasta'] = $criterio;
			//completamos el titulo
			$title[] = 'Transporte: '.$criterio;
		}


		$this->AlmacenTransporte->bindModel(
			array(
				'belongsTo' => array(
					'OperacionLogistica' => array(
						'foreignKey' => false,
						'conditions' => array('Transporte.operacion_logistica_id = OperacionLogistica.id')
					),
					'Contrato' => array(
						'foreignKey' => false,
						'conditions' => array('OperacionLogistica.contrato_id = Contrato.id')
					),
					'Calidad' => array(
						'foreignKey' => false,
						'conditions' => array('Contrato.calidad_id = Calidad.id')
					)
				)
			)
		);

		$this->set('almacentransportes', $this->paginate());
		$almacentransporteasociados = $this->AlmacenTransporte->AsociadoCuenta->find(
			'all',
			array(
				'contain' => array(
					'AlmacenTransporte'=>array(
						'fields' => array(
							'cantidad_cuenta'
						)
					)
				)
			)
		);
		$total_sacos_asignados=0;
		//$almacentransporteasociados = Hash::combine($almacentransporteasociados, '{n}.AsociadoCuenta.almacen_transporte_id','{n}');
		foreach ($almacentransporteasociados as $clave=>$AsociadoCuenta){
			if($clave==0){
				$almacentransporte_id = $AsociadoCuenta['AsociadoCuenta']['almacen_transporte_id'];
			}elseif($almacentransporte_id == $AsociadoCuenta['AsociadoCuenta']['almacen_transporte_id']){
				$total_sacos_asignados +=$AsociadoCuenta['AsociadoCuenta']['sacos_asignados'];
			}else{
				$almacentransporte_id = $AsociadoCuenta['AsociadoCuenta']['almacen_transporte_id'];
			}
			unset($almacentransporteasociados[$clave]['Asociado']);

		}
		$this->set(compact('almacentransporteasociados'));
		$this->set(compact('total_sacos_asignados'));


	}

	public function pendiente() { //Informes de sacos pendientes por adjudicar
		$this->index();
		$this->set('action', $this->action);
		$this->render('index');
	}

	public function view($id = null) {
		$this->checkId($id);

		$this->AlmacenTransporte->AsociadoCuenta->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';

		$almacentransportes = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
				),
				'contain' => array(
					'AsociadoCuenta' =>array(
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
						'PuertoDestino'=>array(
							'fields'=>array(
								'nombre'
							)
						),
						'Agente' => array(
							'fields'=> array(
								'nombre'
							)
						),
						'OperacionLogistica' => array(
							'fields'=> array(
								'referencia'
							),
							'Contrato'=>array(
								'fields'=> array(
									'transporte'
								),
								'Calidad'=>array(
									'nombre'
								)
							),
							'Embalaje' =>array(
								'fields' =>array(
									'nombre'
								)
							)
						)
					),
					'Almacen' => array(
						'fields' => array(
							'nombre_corto',
							'nombre'
						)
					)
				)
			)
		);
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
			$this->Flash->error(
				'URL mal formado almacentransportes/add '
				.$this->params['named']['from_controller']
			);
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
					'OperacionLogistica' => array(
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
					$this->Flash->success('Cuenta almacén guardada');
					$this->redirect(array(
						'controller' => 'almacen_transportes',
						'action' => 'distribucion',
						$nuevoId
					));
				}else{
					$this->Flash->error('Cuenta de almacén NO guardada');
				}
			}elseif ($this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $cantidadcuenta && $this->request->data['AlmacenTransporte']['cantidad_cuenta'] <= $transporte['Transporte']['cantidad_embalaje'] - $almacenado){
				if($this->AlmacenTransporte->save($this->request->data)){
					$nuevoId = $this->AlmacenTransporte->id;
					$this->Flash->success('Cuenta almacén guardada');
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
						$this->Flash->success('Cuenta almacén modificada');
						$this->redirect(array(
							'controller' => 'almacen_transportes',
							'action' => 'view',
							$id
						));
					}
				}else{
					$this->Flash->error('La cantidad de bultos debe ser inferior');
				}
			}else{
				$this->Flash->error('La cantidad de bultos debe ser inferior');
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
		return $this->History->Back(0);
	}

	public function distribucion($id){
		$this->AlmacenTransporte->AsociadoCuenta->Asociado->Retirada->virtualFields['total_retirada_asociado'] = 'COALESCE(sum(embalaje_retirado),0)';

		$almacentransportes = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
				),
				'contain' => array(
					'AsociadoCuenta' =>array(
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
							'operacion_logistica_id'
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
			$this->Flash->error('No existe cuenta con id: '.$id);
			$this->History->Back(0);
		}
		$this->set(compact('almacentransportes'));

		//Necesario para exportar en Pdf
		$this->set(compact('id'));
		$asociados_distribucion = Hash::combine($almacentransportes['AsociadoCuenta'], '{n}.asociado_id', '{n}');


		//GUARDAR LA DISTRIBUCIÓN DE LOS ASOCIADOS
		if($this->request->is('get')){ //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->AlmacenTransporte->read();
			foreach ($asociados_distribucion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['sacos_asignados'];
			}
		}else{
			$this->AlmacenTransporte->AsociadoCuenta->deleteAll(
				array(
					'AsociadoCuenta.almacen_transporte_id' => $id
				)
			);
			foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
				if ($cantidad != NULL) {
					$this->request->data['AsociadoCuenta']['almacen_transporte_id'] = $id;
					$this->request->data['AsociadoCuenta']['asociado_id'] = $asociado_id;
					$this->request->data['AsociadoCuenta']['sacos_asignados'] = $cantidad;
					$this->AlmacenTransporte->AsociadoCuenta->saveAll($this->request->data['AsociadoCuenta']);
				}
			}
			$this->Flash->success('Distribución asociados guardada');
			$this->redirect(
				array(
					'controller' => 'almacen_transportes',
					'action' => 'view',
					$id
				)
			);
		}
	}
	public function envio_disposicion ($id) {
		$almacentransportes = $this->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'AlmacenTransporte.id' => $id
				),
				'recursive'=>2,
				'contain' => array(
					'AsociadoCuenta' =>array(
						'Asociado'=> array(
							'fields'=> array(
								'id'
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
							'operacion_logistica_id'
						),
						'PuertoDestino'=>array(
							'fields'=>array(
								'nombre'
							)
						),
						'Agente' => array(
							'fields'=> array(
								'nombre'
							)
						),
						'OperacionLogistica' => array(
							'fields'=> array(
								'referencia'
							),
							'Contrato'=>array(
								'fields'=> array(
									'transporte',
									'fecha_transporte',
									'si_entrega'
								),
								'Calidad'=>array(
									'nombre'
								)
							),
							'Embalaje' =>array(
								'fields' =>array(
									'nombre'
								)
							)
						)
					),
					'Almacen' => array(
						'fields' => array(
							'nombre_corto',
							'nombre'
						)
					)
				)
			)
		);
		$this->set(compact('almacentransportes'));


		//Necesario para volcar los datos en el PDF
		//Contactos de los asociados
		$this->loadModel('Contacto');
		$contactos = $this->Contacto->find(
			'all',
			array(
				'conditions' =>array(
					'departamento_id' => array(4),
				),
				'order' => array('Empresa.nombre_corto' => 'asc'),
				'fields'=> array(
					'Contacto.departamento_id',
					'Contacto.empresa_id',
					'Contacto.nombre',
					'Contacto.email'
				)
			)
		);
		$this->set('contactos',$contactos);

		//Usuarios de la CMPSA
		$this->loadModel('Usuario');
		$usuarios = $this->Usuario->find(
			'all',
			array(
				'conditions' =>array(
					'departamento_id' => array(4,3) //Aquí indicamos el departamento de usuarios
				),
				'contain'=>array(
					'Departamento'=>array(
						'fields'=>array(
							'nombre'
						)
					)
				)
			)
		);
		$this->set('usuarios',$usuarios);

		if (!empty($id)) $this->AlmacenTransporte->id = $id;
		if($this->request->is('get')){//Comprobamos si hay datos previos en esa línea de muestras
			$this->request->data = $this->AlmacenTransporte->read();//Cargo los datos
		}else{//es un POST
			if (!empty($this->request->data['guardar'])) {	//Pulsamos previsualizar
				$this->AlmacenTransporte->save($this->request->data['AlmacenTransporte']); //Guardamos los datos actuales en los campos de Linea Muestra
				$this->Flash->set('Los datos del informe han sido guardados.');
			}elseif(empty($this->request->data['email'])){
				$this->Flash->set('Los datos del NO fueron enviados. Faltan destinatarios');
			}else{
				$this->AlmacenTransporte->save($this->request->data['AlmacenTransporte']); //Guardamos los datos actuales en los campos
				foreach ($this->data['email'] as $email){
					$lista_email[]= $email;
				}
				if(!empty($this->data['trafico'])){
					foreach ($this->data['trafico'] as $email){
						$lista_bcc[]= $email;
					}
				}

				$tipo_fecha_transporte = $almacentransportes['Transporte']['OperacionLogistica']['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				debug($tipo_fecha_transporte);
				//GENERAMOS EL PDF
				App::uses('CakePdf', 'CakePdf.Pdf');
				require_once(APP."Plugin/CakePdf/Pdf/CakePdf.php");
				$CakePdf = new CakePdf();
				$CakePdf->template('disposicion_asociados');
				$CakePdf->viewVars(array(
					'almacentransportes'=>$almacentransportes
				));
				// Get the PDF string returned
				//$pdf = $CakePdf->output();
				// Or write it to file directly
				$pdf = $CakePdf->write(APP. 'webroot'. DS. 'files'. DS .'disposicion' . DS .'disposicion_'.strtr($almacentransportes['AlmacenTransporte']['cuenta_almacen'],'/','_').'_'.date('Ymd').'.pdf');
				//ENVIAMOS EL CORREO CON EL INFORME
				$Email = new CakeEmail(); //Llamamos la instancia de email
				$Email->config('trafico'); //Plantilla de email.php
				$Email->from(array('trafico@cmpsa.com' => 'Tráfico CMPSA'));
				$Email->bcc($lista_email);
				//$Email->readReceipt($lista_bcc); //Acuse de recibo
				if(!empty($lista_bcc)){
					$Email->bcc($lista_bcc);
				}
				$Email->subject($almacentransportes['Transporte']['OperacionLogistica']['referencia'].' - '.$almacentransportes['Transporte']['OperacionLogistica']['Contrato']['Calidad']['nombre'].' - '. $tipo_fecha_transporte.' en ');//.strftime('%B',$almacentransportes['Transporte']['Contrato']['fecha_transporte']));
				$Email->attachments(APP. 'webroot'. DS. 'files'. DS .'disposicion' . DS . 'disposicion_'.strtr($almacentransportes['AlmacenTransporte']['cuenta_almacen'],'/','_').'_'.date('Ymd').'.pdf');
				$Email->send('Tienen disponible el café para la ficha de referencia '.$almacentransportes['Transporte']['OperacionLogistica']['referencia']. '. Adjuntamos la disposición de éstos.');
				$this->Flash->set('Disposición de almacén enviada con éxito.');
				$this->redirect(array(
					'controller' => 'almacen_transportes',
					'action'  => 'view',
					$id
				)
			);
			}
		}
	}

	public function view_disposicion ($id) {
		$this->view($id);
		$this->render(view);
	}
}
?>
