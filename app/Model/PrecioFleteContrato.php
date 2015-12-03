<?php
class PrecioFleteContrato extends AppModel {
	public $recursive = 2;
	//public $hasMany = array(
	//	'PrecioFlete',
	//	'PrecioFleteTonelada' => array(
	//		'foreignKey' => 'id'
	//	)
	//);
	public $belongsTo = array(
	    'Flete',
	    //'Embalaje'
	);
}
