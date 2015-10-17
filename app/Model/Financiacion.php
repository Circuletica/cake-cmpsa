<?php
class Financiacion extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'Banco' => array(
			'className' => 'Banco',
			'foreignKey' => 'banco_id'),
		'Iva' => array(
			'className' => 'Iva',
			'foreignKey' => 'iva_id'),
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id')
	);
	public $hasMany = array(
		'RepartoOperacionAsociado' => array(
			'className' => 'RepartoOperacionAsociado',
			'foreignKey' => 'id'
		)
	);
}
