<?php
class LineaMuestra extends AppModel {
	public $recursive = 2;
	public $displayField = 'marca';
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Muestra' => array(
			'className' => 'Muestra',
			'foreignKey' => 'muestra_id')
	);
	//var $name = 'BancoPrueba';
}

