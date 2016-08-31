<?php
class Factura extends AppModel {
	public $displayField = 'numero';
	public $belongsTo = array(
		'Empresa',
		'Facturacion'
	);
	public $hasMany = array(
		'FacturaLinea'
	);
	public function beforeDelete($cascade = true) {
		$count = $this->FacturaLinea->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("factura_id" => $this->id)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>