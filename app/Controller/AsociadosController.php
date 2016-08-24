<?php
class AsociadosController extends AppController {

	public function view($id = null) {
		$this->checkId($id);
		$this->Asociado->recursive = 3;
		$empresa = $this->Asociado->findById($id);
		$this->set('empresa',$empresa);
		$this->set('referencia', $empresa['Empresa']['nombre_corto']);
		$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
		//el método iban() definido en AppController necesita
		//como parametro un 'string'
		settype($cuenta_bancaria,"string");
		$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
		$this->set('iban_bancaria',$iban_bancaria);

		$this->set('comisiones', $empresa['AsociadoComision']);
		$asociado_comision = $this->Asociado->AsociadoComision->find(
			'first',
			array(
				'conditions' => array(
					'AND' => array(
						array(
							"AsociadoComision.fecha_inicio <=" => date('Y-m-d')
						),
						'OR' => array(
							"AsociadoComision.fecha_fin >" => date('Y-m-d'),
							"AsociadoComision.fecha_fin " => NULL,
						),
						array('Asociado.id' => $id)
					)
				)
			)
		);
		//si no hay comisión válida a día de hoy, avisar.
		if (!empty($asociado_comision)) {
			$this->set('comision', $asociado_comision['Comision']['valor']);
		} else {
			$this->set('comision', 'comisión no definida');
		}
		$this->set(compact('id'));
	}

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>