<?php
class Retirada extends AppModel {
	public $validate = array(
		'asociado_id' => array(
			'rule' => 'notBlank',
			'message' => 'Debe seleccionar un asociado'
		),
		'operacion_id' => array(
			'rule' => 'notBlank',
			'message' => 'Debe seleccionar una ref. operación'
		),
		'almacen_transporte_id' => array(
			'rule' => 'notBlank',
			'message' => 'Debe seleccionar una ref. almacén'
		)
	);
	public $recursive = 3;
	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'),
		'AlmacenTransporte' => array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'almacen_transporte_id'),
		'Operacion'
	);
}
?>