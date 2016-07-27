<?php
class AsociadosController extends AppController {

	public $class = 'Asociado';

	public function index() {
		$this->bindCompany($this->class);
		$this->set('empresas', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Flash->error('URL mal formado Asociado/view ');
			$this->redirect(array('action'=>'index'));
		}
		$this->viewCompany($this->class,$id);
		$empresa = $this->{$this->class}->findById($id);
		$this->set('comisiones', $empresa['AsociadoComision']);
		$asociado_comision = $this->Asociado->AsociadoComision->find('first', array(
			'conditions' => array(
				'AND' => array(
					array("AsociadoComision.fecha_inicio <=" => date('Y-m-d')),
					'OR' => array(
						"AsociadoComision.fecha_fin >" => date('Y-m-d'),
						"AsociadoComision.fecha_fin " => NULL,
					),
					array('Asociado.id' => $id)
				))
			)
		);
		//si no hay comisión válida a día de hoy, avisar.
		if (!empty($asociado_comision)) {
			$this->set('comision', $asociado_comision['Comision']['valor']);
		} else
		{
			$this->set('comision', 'comisión no definida');
		}
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
				'controller' => Inflector::tableize($this->class)
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id = null) {
		$this->formCompany($this->class, $id);
	}

	public function delete( $id = null) {
		$this->deleteCompany('Asociado', $id);
	}

}
?>
