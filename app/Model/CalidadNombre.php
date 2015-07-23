<?php
class CalidadNombre extends AppModel {
	//public $recursive = 2;
	public $displayField = 'nombre';
	//public $hasMany = array('Contrato');
	//public $actsAs = array('Containable');
	public $belongsTo = array('Calidad' => array(
		'className' => 'Calidad',
		'foreignKey' => 'id')
	);
}

