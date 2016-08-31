<?php
class Asociado extends AppModel {
	public $recursive = 3;
	public $hasOne = array('Empresa' => array(
		'className' => 'Empresa',
		'foreignKey' => 'id')
	);
	public $hasMany = array(
		'AsociadoComision' => array(
			'className' => 'AsociadoComision',
			'foreignKey' => 'asociado_id'
		),
		'AsociadoOperacion' => array(
			'className' => 'AsociadoOperacion',
			'foreignKey' => 'asociado_id'
		),
		'Retirada' => array(
			'className' => 'Retirada',
			'foreignKey' => 'asociado_id'
		),
		'AlmacenReparto'
	);
	public function beforeDelete($cascade = true) {
		$count = $this->AsociadoOperacion->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("asociado_id" => $this->id)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>