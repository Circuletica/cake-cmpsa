<?php
class Operacion extends AppModel {
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
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id'
		),
		'Distribucion' => array(
			'className' => 'Distribucion',
			'foreignKey' => 'distribucion_id'
		),
		'OperacionLogistica' => array(
			'className' => 'OperacionLogistica',
			'foreignKey' => 'operacion_logistica_id'
		),
		'Embalaje' => array(
			'className' => 'Embalaje',
			'foreignKey' => 'embalaje_id')
		);
	/*public $hasOne = array(
		'PrecioOperacion' => array(
			'className' => 'PrecioOperacion',
			'foreignKey' => 'id'
		),
		'PrecioTotalOperacion' => array(
			'className' => 'PrecioTotalOperacion',
			'foreignKey' => 'id'
		),
		'PesoOperacion' => array(
			'className' => 'PesoOperacion',
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
	);*/
	public $hasMany = array(
//		'AsociadoOperacion' => array(
//			'className' => 'AsociadoOperacion',
//			'foreignKey' => 'operacion_id'),
		'OperacionCuenta' => array(
			'className' => 'OperacionCuenta',
			'foreignKey' => 'operacion_id'),
		'LineaMuestra',
		'Retirada'
	);
	public function beforeDelete($cascade = true) {
		$count_retirada = $this->Retirada->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("operacion_id" => $this->id)
			)
		);
		if ($count_retirada == 0) {
			return true;
		}
		return false;
	}
}
?>
