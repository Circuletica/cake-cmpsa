<?php
class Contrato extends AppModel {
	public $recursive = 3;
	public $displayField = 'referencia';
	//public $validate = array(
	//);
	public $hasMany = array(
		'LineaContrato' => array(
			'className' => 'LineaContrato',
			'foreignKey' => 'contrato_id'
		)
	);
	public $belongsTo = array(
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id'),
		'Incoterm' => array(
			'className' => 'Incoterm',
			'foreignKey' => 'incoterm_id'),
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id')
	);
}

