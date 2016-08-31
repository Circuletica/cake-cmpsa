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

		$titulo = $this->filtroPaginador(
			array(
				'Anticipo' => array(
					'Banco' => array(
						'columna' => 'banco_id',
						'exacto' => true,
						'lista' => $bancos
					)
				),
				//				'Operacion' => array(
				//					'Operación' => array(
				//						'columna' => 'referencia',
				//						'exacto' => false,
				//						'lista' => '',
				//					),
				//				),
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
		if(isset($this->passedArgs['Search.fecha'])) {
			$criterio = $this->passedArgs['Search.fecha'];
			//Si solo se ha introducido un año (aaaa)
			if (preg_match('/^\d{4}$/',$criterio)) { $anyo = $criterio; }
			//la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
			elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$criterio)) {
				list($mes,$anyo) = explode('-',$criterio);
			} else {
				$this->Flash->error('Error de fecha');
				$this->redirect(array('action' => 'index'));
			}
			//si se ha introducido un año, filtramos por el año
			if($anyo) { $this->paginate['conditions']['YEAR(Anticipo.fecha_conta) ='] = $anyo;};
			//si se ha introducido un mes, filtramos por el mes
			if(isset($mes)) { $this->paginate['conditions']['MONTH(Anticipo.fecha_conta) ='] = $mes;};
			$this->request->data['Search']['fecha'] = $criterio;
			//completamos el titulo
			$titulo[] = 'Fecha: '.$criterio;
		}

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

	public function add() {
		$this->form();
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			throw new NotFoundException(__('URL mal formado Anticipos/edit'));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form ($id = null) { //esta accion vale tanto para edit como add
		$operacion_id = isset($this->params['named']['from_id'])?
			$this->params['named']['from_id']:null;
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

		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) {
			$this->Anticipo->id = $id;
			//$this->request->data['Anticipo']['operacion_id'] = $operacion_id;
		}

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
			if ($this->Anticipo->save($this->request->data)) {
				$this->Flash->success('Anticipo guardado');
				$this->History->Back(-1);
			} else {
				$this->Flash->error('Anticipo NO guardado');
			}
		} else { //es un GET
			$this->request->data = $this->Anticipo->read(null, $id);
			$this->request->data['AsociadoOperacion']['operacion_id'] = $operacion_id;
		}
	}

	public function delete($id = $null) {
		$this->request->allowMethod('post');
		$this->Anticipo->id = $id;
		if (!$this->Anticipo->exists()) {
			throw new NotFoundException('Anticipo inválido');
		}
		if ($this->Anticipo->delete()){
			$this->Flash->success('Anticipo borrado');
			return $this->History->Back(-1);
		}
		$this->Flash->error('Anticipo NO borrado');
		return $this->History->Back(0);
	}
}
?>