<?php
class Financiacion extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'Banco' => array(
			'className' => 'Banco',
			'foreignKey' => 'banco_id'),
		'TipoIva' => array(
			'className' => 'TipoIva',
			'foreignKey' => 'tipo_iva_id'),
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id')
	);
	public $hasOne = array(
	    'ValorIvaFinanciacion'
	);
	public $hasMany = array(
		'RepartoOperacionAsociado' => array(
			'className' => 'RepartoOperacionAsociado',
			'foreignKey' => 'id'
		)
	);
}
