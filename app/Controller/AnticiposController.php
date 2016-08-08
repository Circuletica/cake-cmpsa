<?php
class AnticiposController extends AppController {

	public function index() {
		$this->paginate['order'] = array(
			'Anticipo.fecha_conta' => 'asc'
		);
		$this->paginate['contain'] = array(
			'Banco',
			'AsociadoOperacion',
			'Asociado',
			'Operacion'
		);
		$this->loadModel('Banco');
		$bancos = $this->Banco->find(
			'list',
			array(
				'fields' => array('Banco.id','Empresa.nombre_corto'),
				'order' => array('Empresa.nombre_corto' => 'asc'),
				'recursive' => 1,
			)
		);
		$this->set(compact('bancos'));

		//necesitamos la lista de proveedor_id/nombre para rellenar el select
		//del formulario de busqueda
		$this->loadModel('Asociado');
		$asociados = $this->Asociado->find(
			'list',
			array(
				'fields' => array('Asociado.id','Empresa.nombre_corto'),
				'order' => array('Empresa.nombre_corto' => 'asc'),
				'recursive' => 1
			)
		);
		$this->set(compact('asociados'));

		$this->paginate['conditions'] = array();
		$titulo = $this->filtroPaginador(
			array(
				'Anticipo' => array(
					'Banco' => array(
						'columna' => 'banco_id',
						'exacto' => true,
						'lista' => $bancos
					)
				),
				'Operacion' => array(
					'Operación' => array(
						'columna' => 'referencia',
						'exacto' => false,
						'lista' => '',
					),
				),
				'AsociadoOperacion' => array(
					'Asociado' => array(
						'columna' => 'asociado_id',
						'exacto' => true,
						'lista' => $asociados
					)
				)
			)
		);
		//filtramos por fecha
		if(isset($this->passedArgs['Search.desde']) && $this->passedArgs['Search.hasta'] != '--') {
			$criterio = strtr($this->passedArgs['Search.desde'],'_','/');
			$this->paginate['conditions'] += array(
				'Anticipo.fecha_conta >= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['desde'] = $criterio;
			//completamos el titulo
			$titulo .= '| Inicio: '.$criterio;
		}
		if(isset($this->passedArgs['Search.hasta']) and $this->passedArgs['Search.hasta'] != '--') {
			$criterio = strtr($this->passedArgs['Search.hasta'],'_','/');
			$this->paginate['conditions'] += array(
				'Anticipo.fecha_conta <= ' => $criterio
			);
			//guardamos el criterio para el formulario de vuelta
			$this->request->data['Search']['hasta'] = $criterio;
			//completamos el titulo
			$titulo .= '| Fin: '.$criterio;
		}
		//		if(isset($this->passedArgs['Search.fecha'])) {
		//			$criterio = $this->passedArgs['Search.fecha'];
		//			//Si solo se ha introducido un año (aaaa)
		//			if (preg_match('/^\d{4}$/',$criterio)) { $anyo = $criterio; }
		//			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
		//			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$criterio)) {
		//				list($mes,$anyo) = explode('-',$criterio);
		//			} else {
		//				$this->Flash->set('Error de fecha');
		//				$this->redirect(array('action' => 'index'));
		//			}
		//			//si se ha introducido un año, filtramos por el año
		//			if($anyo) { $this->paginate['conditions']['YEAR(Anticipo.fecha_conta) ='] = $anyo;};
		//			//si se ha introducido un mes, filtramos por el mes
		//			if(isset($mes)) { $this->paginate['conditions']['MONTH(Anticipo.fecha_conta) ='] = $mes;};
		//			$this->request->data['Search']['fecha'] = $criterio;
		//			//completamos el titulo
		//			$titulo[] = 'Fecha: '.$criterio;
		//		}

		$this->Anticipo->bindModel(
			array(
				'belongsTo' => array(
					'Asociado' => array(
						'className' => 'Empresa',
						'foreignKey' => false,
						'conditions' => array(
							'AsociadoOperacion.asociado_id = Asociado.id'
						)
					),
					'Operacion' => array(
						'foreignKey' => false,
						'conditions' => array(
							'AsociadoOperacion.operacion_id = Operacion.id'
						)
					)
				)
			)
		);
		$this->set(compact('titulo'));
		$this->set('anticipos', $this->paginate());
	}

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		$this->checkId($id);
		if (!$id && empty($this->request->data)) {
			throw new NotFoundException(__('URL mal formado Anticipos/edit'));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form ($id = null) { //esta accion vale tanto para edit como add
		$this->set('action', $this->action);

		$this->loadModel('Banco');
		$bancos = $this->Banco->find(
			'list',
			array(
				'fields' => array(
					'Banco.id',
					'Empresa.nombre_corto'
				),
				'order' => array('Empresa.nombre_corto' => 'asc'),
				'recursive' => 1
			)
		);
		$this->set(compact('bancos'));
		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) {
			$anticipo = $this->Anticipo->findById($id);
			$si_contablilizado = $anticipo['Anticipo']['si_contabilizado'];
			//pero si el anticipo ya ha sido contabilizado,
			//se tiene que generar uno nuevo, sin borrar el antiguo
			//			if ($anticipo['Anticipo']['si_contabilizado'] != true) {
			//				$this->Anticipo->id = $id;
			//			}
			$operacion_id = $anticipo['AsociadoOperacion']['operacion_id'];
			//$this->request->data['Anticipo']['operacion_id'] = $operacion_id;
		} else {
			$operacion_id = isset($this->params['named']['from_id'])?
				$this->params['named']['from_id']:null;
		}

		$this->Anticipo->AsociadoOperacion->unbindModel(array(
			'belongsTo' => array('Asociado')
		));
		$this->Anticipo->AsociadoOperacion->bindModel(array(
			'belongsTo' => array(
				'Empresa' => array(
					'foreignKey' => false,
					'conditions' => array('Empresa.id = AsociadoOperacion.asociado_id')
				)
			)
		));
		$asociados = $this->Anticipo->AsociadoOperacion->find(
			'list',
			array(
				'contain' => array(
					'Empresa',
				),
				'fields' => array(
					'Empresa.id',
					'Empresa.nombre_corto',
				),
				'conditions' => array(
					'AsociadoOperacion.operacion_id' => $operacion_id
				),
				'recursive' => 2,
				'order' => array('Empresa.codigo_contable' => 'ASC')
			)
		);
		$this->set(compact('asociados'));

		$operaciones = $this->Anticipo->AsociadoOperacion->Operacion->find(
			'list',
			array(
				'order' => array('Operacion.referencia' => 'ASC'),
				'joins' => array( // solo las operaciones que tienen financiacion
					array(
						'table' => 'financiaciones',
						'alias' => 'Financiacion',
						'type' => 'RIGHT',
						'conditions' => array(
							'Operacion.id = Financiacion.id'
						)
					)
				)
			)
		);
		$this->set(compact('operaciones'));

		$lista_operaciones = $this->Anticipo->AsociadoOperacion->Operacion->find(
			'all',
			array(
				'contain' => array(
					'AsociadoOperacion' => array(
						'Asociado'
					)
				)
			)
		);
		$lista_operaciones = Hash::combine($lista_operaciones, '{n}.Operacion.id','{n}');
		foreach ($lista_operaciones as &$operacion) {
			unset($operacion['Operacion']);
			foreach ($operacion['AsociadoOperacion'] as $asociado) {
				$operacion['Asociado'][] = array(
					'id' => $asociado['asociado_id'],
					'nombre_corto' => $asociado['Asociado']['nombre_corto']
				);
			}
			unset($operacion['AsociadoOperacion']);
		}
		$this->set(compact('lista_operaciones'));

		if ($this->request->is(array('post', 'put'))){
			$asociado_operacion = $this->Anticipo->AsociadoOperacion->find(
				'first',
				array(
					'conditions' => array(
						'AsociadoOperacion.asociado_id' => $this->request->data['AsociadoOperacion']['asociado_id'],
						'AsociadoOperacion.operacion_id' => $this->request->data['AsociadoOperacion']['operacion_id'],
					)
				)
			);
			$asociado_operacion_id = $asociado_operacion['AsociadoOperacion']['id'];
			$this->request->data['Anticipo']['asociado_operacion_id'] = $asociado_operacion_id;

			//Si estamos editando un anticipo ya exportado, en lugar
			//de hacer un UPDATE de Mysql, hacemos un INSERT de DOS
			//registros, primero un asiento inverso restando el importe
			//equivocado, luego otro asiento con el importe correcto.
			if ($this->request->data['Anticipo']['si_contabilizado'] == true) {
				$anticipo_inverso = $this->Anticipo->findById($id); // el asiento inverso
				$anticipo_inverso['Anticipo']['importe'] = -$anticipo_inverso['Anticipo']['importe'];
				unset($anticipo_inverso['Anticipo']['id']); // va a tener nuevo id
				$anticipo_inverso['Anticipo']['anticipo_padre_id'] = $id;
				$anticipo_inverso['Anticipo']['si_contabilizado'] = false;
				$this->Anticipo->create(); //el asiento de importe correcto
				$this->request->data['Anticipo']['anticipo_padre_id'] = $id;
				$this->request->data['Anticipo']['si_contabilizado'] = false;
			}
			$data = array();
			if (isset($anticipo_inverso)) {
				array_push($data,$anticipo_inverso);
			}
			array_push($data,$this->request->data);
			//saveMany es atómico, se guardan los dos o ninguno.
			if ($this->Anticipo->saveMany($data)) {
				$this->Flash->success('Anticipo(s) guardado(s)');
				return $this->History->Back(-1);
			}
			$this->Flash->error('Anticipo(s) NO guardado(s)');
		} else { //es un GET
			$this->request->data = $this->Anticipo->read(null, $id);
			$this->request->data['AsociadoOperacion']['operacion_id'] = $operacion_id;
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');
		$this->Anticipo->id = $id;
		if (!$this->Anticipo->exists()) {
			throw new NotFoundException('Anticipo inválido');
		}
		if ($this->Anticipo->delete()){
			$this->Flash->success('Anticipo borrado');
			return $this->History->Back(0);
		}
		$this->Flash->error('Anticipo NO borrado');
		return $this->History->Back(0);
	}

	public function exportar() {
		if ($this->request->is(array('post','put'))) {
			debug($this->request->data);
			throw new notFoundException;
			//	return $this->request->data;
		} else {
			$this->paginate['order'] = array(
				'Anticipo.fecha_conta' => 'asc'
			);
			$this->paginate['contain'] = array(
				'Banco',
				'AsociadoOperacion',
				'Asociado',
				'Operacion'
			);
			$this->paginate['conditions'] = array(
				"COALESCE(si_contabilizado, 'false') <>" => true
			);
			$this->Anticipo->bindModel(
				array(
					'belongsTo' => array(
						'Asociado' => array(
							'className' => 'Empresa',
							'foreignKey' => false,
							'conditions' => array(
								'AsociadoOperacion.asociado_id = Asociado.id'
							)
						),
						'Operacion' => array(
							'foreignKey' => false,
							'conditions' => array(
								'AsociadoOperacion.operacion_id = Operacion.id'
							)
						)
					)
				)
			);
			$this->set('anticipos', $this->paginate());
		}
	}

	public function csv() {
		$lista_ids = $this->request->data['Anticipo'];
		$this->Anticipo->bindModel(
			array(
				'belongsTo' => array(
					'Asociado' => array(
						'className' => 'Empresa',
						'foreignKey' => false,
						'conditions' => array(
							'AsociadoOperacion.asociado_id = Asociado.id'
						)
					),
					'Operacion' => array(
						'foreignKey' => false,
						'conditions' => array(
							'AsociadoOperacion.operacion_id = Operacion.id'
						)
					)
				)
			)
		);
		$anticipos = $this->Anticipo->find(
			'all',
			array(
				'recursive' => 1,
				'fields' => array(
					'id',
					'importe',
					'fecha_conta'
				),
				'contain' => array(
					'Banco' => array(
						'codigo_contable'
					),
					'AsociadoOperacion',
					'Asociado' => array(
						'codigo_contable'
					),
					'Operacion' => array(
						'referencia'
					),
				),
				'conditions' => array(
					'Anticipo.id' => $lista_ids
				)
			)
		);
		$this->set(compact('anticipos'));

		$this->layout = null;
		$this->autoLayout = false;
		Configure::write('debug', '0');
		$this->response->download("anticipos_".date('Ymd').".csv");

		$this->Anticipo->updateAll(
			array(
				'si_contabilizado' => true
			),
			array(
				'Anticipo.id' => $lista_ids
			)
		);
	}
}
?>
