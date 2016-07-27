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
			$this->Session->setFlash('error en URL Anticipos::edit()');
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
		$bancos = $this->Anticipo->Banco->find('list', array(
			'fields' => array(
				'Banco.id',
				'Empresa.nombre_corto'
			),
			'order' => array('Empresa.nombre_corto' => 'asc'),
			'recursive' => 1
		));
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
					'AsociadoOperacion.operacion_id' => $this->params['named']['from_id']
				),
				'recursive' => 2,
				'order' => array('Empresa.codigo_contable' => 'ASC')
			)
		);
		$this->set(compact('asociados'));

		$this->set('financiacion_id', $this->params['named']['from_id']);

		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) {
			$this->Anticipo->id = $id;
		} 

		if (!empty($this->request->data)){  //es un POST
			$asociado_operacion = $this->Anticipo->AsociadoOperacion->find(
				'first',
				array(
					'conditions' => array(
						'AsociadoOperacion.asociado_id' => $this->request->data['Anticipo']['asociado_id'],
						'AsociadoOperacion.operacion_id' => $this->params['named']['from_id']
					)
				)
			);
			$asociado_operacion_id = $asociado_operacion['AsociadoOperacion']['id'];
			$this->request->data['Anticipo']['asociado_operacion_id'] = $asociado_operacion_id;
			if ($this->Anticipo->save($this->request->data)) {
				$this->Session->setFlash('Anticipo guardado');
				$this->redirect(array(
					'action' => 'view',
					'controller' => $this->params['named']['from_controller'],
					$this->params['named']['from_id']
				));
			} else {
				$this->Session->setFlash('Anticipo NO guardado');
			}
		} else { //es un GET
			$this->request->data = $this->Anticipo->read(null, $id);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->Anticipo->id = $id;
		if (!$this->Anticipo->exists()){
			throw new NotFoundException(__('Anticipo inválido'));
		}
		if($this->Anticipo->delete()) {
			$this->Flash->success('Anticipo borrado');
			return $this->History->Back(0);
		}
		$this->Flash->error('Anticipo NO borrado');
		return $this->History->Back(0);
	}
}
?>
