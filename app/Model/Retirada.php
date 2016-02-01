<?php
class Retirada extends AppModel {
	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'),
		'AlmacenTransporte' => array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'almacen_transporte_id'),	
	);
	public $hasOne = array(
		'OperacionRetirada' => array(
			'className' => 'OperacionRetirada',
			'foreignKey' => 'retirada_id')
	);
}
