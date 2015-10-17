<?php
class Operacion extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'PuertoCarga' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_carga_id'
		),
		'PuertoDestino' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_destino_id'
		),
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
		),
		'Financiacion' => array(
			'className' => 'Financiacion',
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

