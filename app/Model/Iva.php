<?php
class Iva extends AppModel {
	//public $recursive = 2;
	public $hasMany = array(
		'Financiacion' => array(
			'className' => 'Financiacion',
			'foreignKey' => 'id')
	);
	//var $name = 'I.V.A.';
	var $displayField = 'valor';
}
