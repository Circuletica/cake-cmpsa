<?php
class AlmacenTransporte extends AppModel {
	public $name = 'Cuenta de almacén';
	public $useTable = 'almacen_transportes';
	public $displayField = 'cuenta_almacen';
	public $belongsTo = array(
		'Almacen' => array(
			'className' => 'Empresa',
			'foreignKey' => 'almacen_id'
		),
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'transporte_id'
		)
	);
	public $hasMany = array(
		'Retirada',
		'AlmacenTransporteAsociado',
		'AlmacenReparto' => array(
			'className' => 'AlmacenReparto',
			'foreignKey' => 'id'
		)
	);
	public $virtualFields = array(
		'cuenta_marca' => 'CONCAT(AlmacenTransporte.cuenta_almacen," (",COALESCE(AlmacenTransporte.marca_almacen,""),")")'
	);
	public $validate = array(
		'almacen_id' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre del almacén no puede estar vacío'
		),
		'cuenta_almacen' => array(
			'rule' => 'notBlank',
			'message' => 'La referencia no puede estar vacía'
		)
	);
	public function beforeDelete($cascade = true) {
		$count = $this->Retirada->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("almacen_transporte_id" => $this->id)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>
