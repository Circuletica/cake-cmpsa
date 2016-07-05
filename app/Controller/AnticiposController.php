<?php
class AnticiposController extends AppController {
	public $paginate = array(
		'order' => array('Anticipo.fecha_conta' => 'asc')
	);

	public function index() {
		$this->paginate['contain'] = array(
			'Asociado',
			'Financiacion'
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
		$operacion_id = $this->params['named']['from_id'];
		$this->set('action', $this->action);
		$bancos = $this->Anticipo->Banco->find(
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

		$this->set('financiacion_id', $operacion_id);

		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) {
			$this->Anticipo->id = $id;
		} 

		if ($this->request->is(array('post', 'put'))){
			$asociado_operacion = $this->Anticipo->AsociadoOperacion->find(
				'first',
				array(
					'conditions' => array(
						'AsociadoOperacion.asociado_id' => $this->request->data['Anticipo']['asociado_id'],
						'AsociadoOperacion.operacion_id' => $operacion_id
					)
				)
			);
			$asociado_operacion_id = $asociado_operacion['AsociadoOperacion']['id'];
			$this->request->data['Anticipo']['asociado_operacion_id'] = $asociado_operacion_id;
			if ($this->Anticipo->save($this->request->data)) {
				$this->Flash->set('Anticipo guardado');
				$this->History->Back(-1);
			} else {
				$this->Flash->set('Anticipo NO guardado');
			}
		} else { //es un GET
			$this->request->data = $this->Anticipo->read(null, $id);
		}
	}

	public function delete($id) {
		if (!$id or $this->request->is('get')){
			throw new MethodNotAllowedException('URL mal formada o incompleta');
		}
		if($this->Anticipo->delete($id)) {
			$this->Flash->set('Anticipo borrado');
			$this->History->Back(0);
		} else {
			$this->Flash->set('Anticipo NO borrado');
			$this->History->Back(0);
		}
	}
}
?>
