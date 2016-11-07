<?php
class Transporte extends AppModel {
	public $name = 'Línea de transporte';
	public $useTable = 'transportes';
	public $recursive = 3;
	public $validate = array(
		'nombre_vehiculo' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre del vehículo no puede estar vacío'
		),
		'cantidad_embalaje' => array(
			'rule' => 'notBlank',
			'message' => 'La cantidad de bultos no puede estar vacía'
		),
		'linea' => array(
			'rule' => 'notBlank',
			'message' => 'La linea de transporte no puede estar vacía'
		)
	);

	public $belongsTo = array(
		'Aseguradora' => array(
			'className' => 'Empresa',
			'foreignKey' => 'aseguradora_id'),
		'OperacionCompra' => array(
			'className' => 'OperacionCompra',
			'foreignKey' => 'operacion_compra_id'),
		'Naviera' => array(
			'className' => 'Empresa',
			'foreignKey' => 'naviera_id'),
		'PuertoCarga' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_carga_id'),
		'PuertoDestino' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_destino_id'),
		'Agente' => array(
			'className' => 'Empresa',
			'foreignKey' => 'agente_id')
		);

	public $hasMany = array(
		'AlmacenTransporte'=> array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'transporte_id')
		);
	public function beforeDelete($cascade = true) {
		global $count;
		$count = $this->AlmacenTransporte->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("transporte_id" => $this->id)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>
