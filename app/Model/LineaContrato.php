<?php
class LineaContrato extends AppModel {
	public $recursive = 2;
	//public $displayField = 'marca';
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato'),
	);
}

