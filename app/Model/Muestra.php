<?php
class Muestra extends AppModel {
	public $recursive = 2;
	public $displayField = 'referencia';
	public $belongsTo = array(
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id'),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id'),
		//Quitamos esta hasta que se solucione
		//en la BDD
		//'MarcaAlmacen' => array(
		//	'className' => 'MarcaAlmacen',
		//	'foreignKey' => 'marca_almacen_id'),
		//'Operacion' => array(
		//	'className' => 'Operacion',
		//	'foreignKey' => 'operacion_id')
		'Contrato'
	);
	public $hasMany = 'LineaMuestra';
}
