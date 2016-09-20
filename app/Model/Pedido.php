<?php
class Pedido extends AppModel {
	public $recursive = 2;

	public $action_view;

	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'
		)
	);
	public $hasMany = array(
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'pedido_id'),
		'Anticipos' => array(
			'className' => 'Anticipos',
			'foreignKey' => 'pedido_id'),
	);
/*	public function beforeDelete($cascade = true) {
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
	}*/
}
?>
