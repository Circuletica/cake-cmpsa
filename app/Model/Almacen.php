<?php
class Almacen extends AppModel {
	public $recursive = 2;
	public $hasMany = array(
		'AlmacenTransporte'=> array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'almacen_id')
	);
	public $hasOne = array('Empresa' => array(
		'className' => 'Empresa',
		'foreignKey' => 'id')
	);
}
