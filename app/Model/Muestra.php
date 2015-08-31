<?php
class Muestra extends AppModel {
	public $recursive = 2;
//	public $belongTo = array('Empresa' => array(
	public $displayField = 'referencia';
	//no sabemos si este sirve de algo
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		//no estoy seguro de si hace falta incluir Calidad,
		//si ya tenemos el enlace con CalidadNombre
		'Calidad' => array(
			'className' => 'Calidad',
			'foreignKey' => 'calidad_id'),
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id'),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id'),
		'MarcaAlmacen' => array(
			'className' => 'MarcaAlmacen',
			'foreignKey' => 'marca_almacen_id'),
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'operacion_id')
	);
	public $hasMany = 'LineaMuestra';
}

