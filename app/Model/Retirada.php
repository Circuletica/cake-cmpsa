<?php
class Retirada extends AppModel {
	public $recursive = 3;
	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'),
		'AlmacenTransporte' => array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'almacen_transporte_id'),
		'OperacionRetirada' => array(
			'className' => 'OperacionRetirada',
			'foreignKey' => 'id'),
	);
}
