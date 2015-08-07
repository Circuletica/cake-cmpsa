<?php
class Operacion extends AppModel {
	public $recursive = 2;
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato_id')
	);
	public $hasOne = array(
		'PrecioOperacion' => array(
			'className' => 'PrecioOperacion',
			'foreignKey' => 'id'
		),
		'PrecioTotalOperacion' => array(
			'className' => 'PrecioTotalOperacion',
			'foreignKey' => 'id'
		),
		'PesoOperacion' => array(
			'className' => 'PesoOperacion',
			'foreignKey' => 'id'
		)
	);
	public $hasMany = array(
		'AsociadoOperacion' => array(
			'className' => 'AsociadoOperacion',
			'foreignKey' => 'operacion_id'
		)
	);
}

