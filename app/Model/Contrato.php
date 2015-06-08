<?php
class Contrato extends AppModel {
	//public $recursive = 2;
	//public $validate = array(
	//);
	//public $hasOne = array(
	public $belongsTo = array(
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'id'),
		'Incoterm' => array(
			'className' => 'Incoterm',
			'foreignKey' => 'id'),
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'id')
	);
	//var $name = 'BancoPrueba';
}

