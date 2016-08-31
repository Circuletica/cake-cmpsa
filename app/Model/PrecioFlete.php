<?php
class PrecioFlete extends AppModel {
	public $name = 'Precio de flete';
	public $useTable = 'precio_fletes';
	public $recursive = 2;
	//public $hasMany = array(
	//	'PrecioFlete',
	//	'PrecioFleteTonelada' => array(
	//		'foreignKey' => 'id'
	//	)
	//);
	public $belongsTo = array(
		'Flete',
	);
}
?>