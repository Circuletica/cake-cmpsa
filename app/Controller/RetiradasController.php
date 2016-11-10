<?php
class RetiradasController extends AppController {

	public function index() {
		$this->set('action', $this->action);	//Se usa para tener la misma vista

		$this->paginate['order'] = array('Retirada.fecha_retirada' => 'desc');
		$this->paginate['contain'] = array(
			'Asociado',
			'AlmacenTransporte',
			'Almacen' => array (
				'fields' => array(
					'id',
					'nombre_corto'
				)
			),
			'OperacionCompra' => array (
				'fields' => array(
					'id',
					'referencia'
				)
			)
		);

		$titulo = $this->filtroPaginador(
			array(
				'OperacionCompra' =>array(
					'Referencia' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => ''
					)
				)
			)
		);

		if(isset($this->passedArgs['Search.desde'])) {
			$criterio = strtr($this->passedArgs['Search.desde'],'_','/');
			$this->paginate['conditions'] = array(
				'Retirada.fecha_retirada >= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['desde'] = $criterio;
			//completamos el titulo
			$title[] = 'Retirada: '.$criterio;
		}
		if(isset($this->passedArgs['Search.hasta']) and $this->passedArgs['Search.hasta'] != '--') {
			$criterio = strtr($this->passedArgs['Search.hasta'],'_','/');
			$this->paginate['conditions'] += array(
				'Retirada.fecha_retirada <= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['hasta'] = $criterio;
			//completamos el titulo
			$title[] = 'Retirada: '.$criterio;
		}

		$this->Retirada->bindModel(
			array(
				'belongsTo' => array(
					'OperacionCompra' => array(
						'foreignKey' => false,
						'conditions' => array('Retirada.operacion_compra_id = OperacionCompra.id')
					),
					'Almacen' => array(
						'className' => 'Empresa',
						'foreignKey' => false,
						'conditions' => array('Almacen.id = AlmacenTransporte.almacen_id')
					)
				)
			)
		);
		$retiradas = $this->paginate();
		//pasamos los datos a la vista
		$this->set(compact('retiradas','title'));

	}

	public function index_conta(){
		$this->index();
		$this->set('action', $this->action);
		$this->render('index');
	}

	public function view_asociado($id = null) {
		//$this->checkId($id); NO PUEDE ESTAR ACTIVADO PORQUE GENERA ERRORES EN ESTA VISTA
		//el id y la clase de la entidad de origen vienen en la URL

		$operacion_id = $this->params['named']['from_id'];
		$this->set(compact('operacion_compra_id'));

		$operacion = $this->Retirada->OperacionCompra->find(
			'first',
			array(
				'conditions' => array(
					'OperacionCompra.id'=>$operacion_id
				),
				'recursive'=>-1,
				'fields' => array(
					'id',
					'referencia',
					'contrato_id',
					'embalaje_id'
				),
				'contain' => array(
					'Embalaje' => array(
						'fields' => array(
							'nombre'
						)
					)
				)
			)
		);
		$this->set('operacion',$operacion);
		//Sacamos info embalaje y cantidad operacion
		$this->loadModel('ContratoEmbalaje');
		$solicitado = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['OperacionCompra']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['OperacionCompra']['embalaje_id']
				),
				'fields' => array(
					//'Embalaje.nombre',
					'ContratoEmbalaje.peso_embalaje_real'
				)
			)
		);

		$this->set(compact('solicitado'));

		$retiradas = $this->Retirada->find(
			'all',
			array(
				'conditions' =>array(
					'Retirada.asociado_id' => $this->params['named']['asociado_id'],
					'Retirada.operacion_compra_id'=> $operacion_id
				),
				'recursive' => 3,
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
					'OperacionCompra' => array(
						'fields' => array(
							'id',
							'referencia',
							'embalaje_id'
						),
						'Embalaje' => array(
							'nombre')
						)
					)//Cierre CONTAIN
				)
			);

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
				)
			);

		$this->set(compact('asociado_nombre'));

		$asociado_op = $this->Retirada->OperacionCompra->Distribucion->find(
			'first',
			array(
				'conditions' => array(
					'Distribucion.operacion_compra_id' => $operacion_id,
					'Distribucion.asociado_id' => $this->params['named']['asociado_id']
				),
				'recursive'=>-1,
				'fields' => array(
					'id',
					'cantidad_embalaje_asociado',
					'asociado_id'
				)
			)
		);

		$this->set(compact('asociado_op'));
		$this->set(compact('retiradas'));

		$total_sacos_retirados = 0;
		$total_peso_retirado = 0;
		//Calculamos la cantidad de retiradas se han hecho por asociado
		if(!empty($this->params['named']['asociado_id'])){
			$retirado=0;
			foreach ($retiradas as $retirada) {
				if ($this->params['named']['asociado_id'] == $retirada['Retirada']['asociado_id']) {
					$retirado = $retirado + $retirada['Retirada']['embalaje_retirado'];
				}
			}
		}
		$restan = $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'] - $retirado;
		$this->set(compact('restan'));
		$this->set('retirado',$retirado);

		//Saco el tipo de embalaje que tiene la operacíón
		$embalaje = $operacion['Embalaje'];
		$this->set(compact('embalaje'));

		$this->set(compact('retirado'));
		$this->set(compact('restan'));

		$peso = $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'] * $solicitado['ContratoEmbalaje']['peso_embalaje_real'];
		$this->set(compact('peso'));

		// Necesario para evitar agregar retirada si no hay en el almacen nada.
		//Controlo la posibilidad de agregar retiradas unicamente si hay cuentas de almacen.
		$this->loadModel('OperacionCompra');
		$cuenta_almacen = $this->OperacionCompra->Transporte->AlmacenTransporte->find(
			'first',
			array(
				'conditions' => array(
					'Transporte.operacion_compra_id' => $operacion_id
				),
				'recursive' => 2,
				'fields' => array(
					'cuenta_almacen'
				)
			)
		);
		if(empty($cuenta_almacen['AlmacenTransporte'])){
			$cuenta_almacen = NULL;
		}else{
			$cuenta_almacen = $cuenta_almacen['AlmacenTransporte'];
		}
		$this->set(compact('cuenta_almacen'));

		//Para exportar en PDF nececisto declarar la id
		$this->set(compact('id'));

	}

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Flash->error('error en URL');
			$this->redirect(array(
				'action' => 'index',
				'controller' => 'retiradas'
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) { //esta acción vale tanto para edit como add
		$this->set('action', $this->action);
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
				'fields' => array(
					'AlmacenTransporte.id',
					'AlmacenTransporte.cuenta_almacen'),
				'order' => array('AlmacenTransporte.cuenta_almacen' => 'asc')
			)
		);

		$this->set(compact('almacenTransportes'));

		if(empty($this->params['named']['from_id'])){
			$operacion_id = NULL;
		}else{
			$operacion_id = $this->passedArgs['from_id'];
		}
		$this->set(compact('operacion_compra_id'));

		if(empty($this->passedArgs['almacen_transporte_id'])){
			$almacen_transporte_id = NULL;
		}else{
			$this->set('almacen_transporte_id', $this->passedArgs['almacen_transporte_id']);
		}

		$operaciones_asociados = $this->Retirada->OperacionCompra->find(
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
		$operaciones_asociados = Hash::combine($operaciones_asociados, '{n}.OperacionCompra.id','{n}');
		$this->set(compact('operaciones_asociados'));


		$operaciones_almacen = $this->Retirada->AlmacenTransporte->Transporte->OperacionCompra->find(
			'all',
			array(
				'contain' => array(
					'Transporte' =>array(
						'AlmacenTransporte'
					)
				)
			)
		);

		foreach($operaciones_almacen as $clave => $operacion){
			$operaciones_almacen[$clave]['AlmacenTransporte'] = array();
			foreach($operacion['Transporte'] as $transporte){

				if(!empty($transporte['AlmacenTransporte'])){
					foreach($transporte['AlmacenTransporte'] as $cuenta){
						$operaciones_almacen[$clave]['AlmacenTransporte'][] = $cuenta;
					}
				}
			}
			unset($operaciones_almacen[$clave]['Transporte']);
			//quitamos operaciones sin cuenta de almacén
			if (empty($operaciones_almacen[$clave]['AlmacenTransporte'])) {
				unset($operaciones_almacen[$clave]);
			}
		}

		$operaciones_almacen = Hash::combine($operaciones_almacen, '{n}.OperacionCompra.id','{n}');
		$this->set(compact('operaciones_almacen'));

		$id_edit = $id;
		//construimos la lista de operaciones para el desplegable,
		//pero solo las que tengan cuentas de almacén.
		foreach ($operaciones_almacen as $id => $operacion) {
			$operaciones[$id] = $operacion['OperacionCompra']['referencia'];
		}
		$this->set(compact('operaciones'));
		//Solucionamos el problema de asignar add o edit que se pierde en el anterior foreach
		$id = $id_edit;
		$operacion = $this->Retirada->OperacionCompra->find(
			'first',
			array(
				'conditions' => array(
					'OperacionCompra.id'=>$operacion_id
				),
				'recursive'=>-1,
				'fields' => array(
					'referencia',
					'embalaje_id'
				),
				'contain' => array(
					'Embalaje' => array(
						'fields' => array(
							'nombre'
						)
					),
					'AsociadoOperacion' => array(
						'fields' => array(
							'asociado_id'
						),
						'Asociado' =>array(
							'fields' => array(
								'nombre_corto'
							)
						)
					)
				)
			)
		);

		$this->set('operacion',$operacion);

		//Se declara para asignar el valor del array del asociado
		//$asociado_valor = NULL;
		$a=0;
		if(!empty($this->params['named']['asociado_id'])){
			foreach ($operacion['AsociadoOperacion'] as $valor){
				if($valor['asociado_id'] == $this->params['named']['asociado_id']){
					$asoc=$a; //Guardo valor array
					$asociado_nombre = $valor['Asociado']['nombre_corto'];
					$asociado_id = $this->params['named']['asociado_id'];
				}
				$a++; //Contador recorrido array
			}
		}
		$this->set(compact('asociado_id'));
		$this->set(compact('asociado_nombre'));
		// Saco la referencia de la operación para usar en el form excepto en un add() desde index
		$operacion_ref = NULL;
		if(!empty($this->params['named']['from_id'])){
			$operacion_ref = $operacion['OperacionCompra']['referencia'];
		}
		$this->set(compact('operacion_ref'));


		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add

		if (!empty($id)) $this->Retirada->id = $id;

		if(!empty($this->request->data)) { //ES UN POST
			$this->request->data['Retirada']['id'] = $id;

			if($id == NULL && empty($this->params['named']['asociado_id']) && !empty($this->params['named']['from_controller'])) {
				if ($this->Retirada->save($this->request->data)){
					//Accedemos al form desde el index
					$this->Flash->success('Retirada guardada');
					$this->History->back(-1);
				/*$this->redirect(array(
					'action'=>'view_trafico',
				'controller' => 'operaciones',
				$this->params['named']['from_id']
				)
				);*/
				}
			}elseif(($id == NULL) && !empty($this->params['named']['asociado_id'])){
				if($this->Retirada->save($this->request->data)) {
					//Accedemos al form desde view_asociados
					$this->Flash->success('Retirada guardada');
					$this->redirect(array(
						'action'=>'view_asociado',
						'controller' => 'retiradas',
						'asociado_id'=> $this->params['named']['asociado_id'],
						'from_controller'=> $this->params['named']['from_controller'],
						'from_id'=>$this->params['named']['from_id']
					)
				);
				}
			}elseif($id != NULL && !empty($this->params['named']['from_id'])){
				if($this->Retirada->save($this->request->data)) {
					$this->Flash->success('Retirada modificada');
					$this->redirect(array(
						'action'=>'view_asociado',
						'controller' => 'retiradas',
						'asociado_id'=> $this->params['named']['asociado_id'],
						'from_controller'=> $this->params['named']['from_controller'],
						'from_id'=>$this->params['named']['from_id']
					)
				);
				}
			}elseif($id == NULL && empty($this->params['named']['asociado_id']) && empty($this->params['named']['from_controller'])){
				if($this->Retirada->save($this->request->data)){
					//Accedemos al form desde el index
					$this->Flash->success('Retirada guardada');
					$this->redirect(array(
						'action'=>'index',
						'controller' => 'retiradas',
						//	'asociado_id'=> $this->params['named']['asociado_id'],
						//	'from_controller'=> $this->params['named']['from_controller'],
						//	 'from_id'=>$this->params['named']['from_id']
					)
				);
				}
			}else{
				$this->Flash->error('Retirada NO guardada');
			}
		}else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
			$this->request->data = $this->Retirada->read(null, $id);
		}
	}

	//	public function delete($id = null) {
	//		if (!$id or $this->request->is('get')){
	//			throw new MethodNotAllowedException();
	//		}
	//		if ($this->Retirada->delete($id)){
	//			$this->Flash->set('Retirada borrada correctamente');
	//			$this->History->Back(0);
	//		}
	//	}
}
?>
