<?php
class Muestra extends AppModel {
	public $recursive = 3;
//	public $belongTo = array('Empresa' => array(
	public $displayField = 'referencia';
	//no sabemos si este sirve de algo
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Calidad' => array(
			'className' => 'Calidad',
			'foreignKey' => 'calidad_id'),
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id'),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id'),
		'Almacen' => array(
			'className' => 'Almacen',
			'foreignKey' => 'almacen_id'),
	);
	public $hasMany = 'LineaMuestra';
//	);
	//var $name = 'BancoPrueba';
}

