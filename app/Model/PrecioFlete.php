<?php
class PrecioFlete extends AppModel {
	public $recursive = 2;
	//public $hasMany = array(
	//	'PrecioFlete',
	//	'PrecioFleteTonelada' => array(
	//		'foreignKey' => 'id'
	//	)
	//);
	public $belongsTo = array(
		//'Flete',
	);
}
