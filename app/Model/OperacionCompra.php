<?php
class OperacionCompra extends AppModel {
	public $recursive = 2;

	public $action_view;

	public $displayField = 'referencia';

	public $validate = array(
		'referencia' => array(
			'rule' => 'notBlank',
			'message' => 'La referencia no puede estar vacía')
		);

	public $belongsTo = array(
		'PuertoCarga' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_carga_id'
		),
		'PuertoDestino' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_destino_id'
		),
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato_id'),
		'Embalaje' => array(
			'className' => 'Embalaje',
			'foreignKey' => 'embalaje_id')
		);
	public $hasOne = array(
//		'PrecioOperacionCompra' => array(
//			'className' => 'PrecioOperacionCompra',
//			'foreignKey' => 'id'
//		),
//		'PrecioTotalOperacionCompra' => array(
//			'className' => 'PrecioTotalOperacionCompra',
//			'foreignKey' => 'id'
//		),
		'PesoOperacionCompra' => array(
			'className' => 'PesoOperacionCompra',
			'foreignKey' => 'id'
		),
		'Financiacion' => array(
			'className' => 'Financiacion',
			'foreignKey' => 'id'
		),
		'Facturacion' => array(
			'className' => 'Facturacion',
			'foreignKey' => 'id'
		)
	);
	public $hasMany = array(
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'operacion_compra_id'
		),
		'OperacionVenta'=> array(
			'className' => 'OperacionVenta',
			'foreignkey' => 'operacion_venta_id	'
		),
		'LineaMuestra',
		'Retirada'
	);
	public function beforeDelete($cascade = true) {
		$count_retirada = $this->Retirada->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("operacion_compra_id" => $this->id)
			)
		);
		if ($count_retirada == 0) {
			return true;
		}
		return false;
	}
}
?>
