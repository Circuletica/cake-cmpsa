<?php
class TipoIvasController extends AppController {

	public function index() {
		$this->paginate['contain'] = array(
			'ValorTipoIva'
		);

		//Por defecto, sacamos los valores de IVA a día de hoy.
		//Si queremos el historial, habra que ir a la view()
		$this->TipoIva->unbindModel(array(
			'hasMany' => array(
				'ValorTipoIva'
			)
		));
		$this->TipoIva->bindModel(array(
			'belongsTo' => array(
				'ValorTipoIva' => array(
					'foreignKey' => false,
					//sólo los registros cuyo intervalo de validez
					//incluya la fecha de hoy, o no tenga fecha de caducidad.
					'conditions' => array(
						'AND' => array(
							array("ValorTipoIva.fecha_inicio <=" => date('Y-m-d')),
							'OR' => array(
								"ValorTipoIva.fecha_fin >" => date('Y-m-d'),
								"ValorTipoIva.fecha_fin" => NULL
							),
							array('ValorTipoIva.tipo_iva_id = TipoIva.id')
						)
					)
				)
			)
		));

		$this->set('tipo_ivas', $this->paginate());
	}

	public function add() {
		if($this->request->is('post')) {
			if($this->TipoIva->save($this->request->data) ) {
				$this->Flash->success('Tipo de IVA guardado');
				$this->redirect(array(
					'controller' => 'tipo_ivas',
					'action' => 'index'
				));
			}
		}
	}

	public function view($id = null) {
		$this->checkId($id);
		//el id y la clase del tipo de iva vienen en la URL
		$tipo_iva = $this->TipoIva->find('first',
			array(
				'conditions' => array(
					'TipoIva.id' => $id
				),
				'contain' => array(
					'ValorTipoIva' => array(
						'order' => array(
							'ValorTipoIva.fecha_inicio' => 'asc'
						)
					)
				)
			)
		);
		$this->set(compact('id'));
		$this->set(compact('tipo_iva'));
	}

	public function edit($id = null) {
		$this->TipoIva->id = $id;
		if($this->request->is('get')) {
			$iva = $this->TipoIva->findById($id);
			$this->set('referencia', 'IVA '.$iva['TipoIva']['nombre']);
			$this->request->data = $this->TipoIva->read();
		} else {
			if($this->TipoIva->save($this->request->data)) {
				$this->Flash->success(' Tipo de IVA '.$this->request->data['Iva']['nombre'].' guardado');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error('Tipo de IVA no guardado');
			}
		}
	}

	//	public function delete($id) {
	//		if($this->request->is('get')):
	//			throw new MethodNotAllowedException();
	//		else:
	//			if($this->TipoIva->delete($id)):
	//				$this->Flash->success('Tipo de IVA borrado');
	//		$this->redirect(array('action' => 'index'));
	//endif;
	//endif;
	//	}
}
