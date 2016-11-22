<?php
class OperacionVenta extends AppModel {
	public $recursive = 2;
	public $action_view;
	public $displayField = 'referencia';
	public $validate = array(
		'referencia' => array(
			'rule' => 'notBlank',
			'message' => 'La referencia no puede estar vacía')
		);
	public $belongsTo = array(
		'OperacionCompra' => array(
			'className' => 'OperacionCompra',
			'foreignKey' => 'operacion_compra_id'
		),
		'Embalaje' => array(
			'className' => 'Embalaje',
			'foreignKey' => 'embalaje_id'
		)
	);
	public $hasOne = array(
//		'PrecioOperacionVenta' => array(
//			'className' => 'PrecioOperacionVenta',
//			'foreignKey' => 'id'
//		),
//		'PrecioTotalOperacionVenta' => array(
//			'className' => 'PrecioTotalOperacionVenta',
//			'foreignKey' => 'id'
//		),
		//PENDIENTE///////////////////////////////////////////////////////////////////////////
//		'PesoOperacionVenta' => array(
//			'className' => 'PesoOperacionVenta',
//			'foreignKey' => 'id'
//		)
	);
	public $hasMany = array(
		'Pedido',
		'Distribucion',
		'OperacionAsociadoCuenta',
		'OperacionVentaCuenta',
		'Retirada'
	);
	public function beforeDelete($cascade = true) {
		$count_retirada = $this->Retirada->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("operacion_venta_id" => $this->id)
			)
		);
		if ($count_retirada == 0) {
			return true;
		}
		return false;
	}
}
?>
