<?php
class CribaPonderada extends AppModel {
	//public $recursive = 2;
	//public $displayField = 'marca';
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'LineaMuestra' => array(
			'className' => 'LineaMuestra',
			'foreignKey' => 'id')
	);
	//var $name = 'BancoPrueba';
}

