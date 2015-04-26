<?php
class CalidadNombre extends AppModel {
	//public $recursive = 2;
	public $displayField = 'nombre';
	//public $belongsTo = array('Pais');
	//public $actsAs = array('Containable');
	public $belongsTo = array('Calidad' => array(
		'className' => 'Calidad',
		'foreignKey' => 'id')
	);
	//var $name = 'BancoPrueba';
}

