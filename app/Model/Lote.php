<?php
class Lote extends AppModel {
	//public $recursive = 3;
	//public $displayField = 'referencia';
	//public $validate = array(
	//);
	//public $hasMany = 'Lote';
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato_id')
	);
}

