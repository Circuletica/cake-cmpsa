<?php
class Contrato extends AppModel {
	public $recursive = 4;
	public $displayField = 'referencia';
	public $validate = array(
		'incoterm_id' => array('rule' => 'notEmpty'),
		'proveedor_id' => array('rule' => 'notEmpty'),
		'calidad_id' => array('rule' => 'notEmpty'),
		'referencia' => array('rule' => 'notEmpty')
		);
	public $hasOne = array(
		'RestoContrato' => array(
			'className' => 'RestoContrato',
			'foreignKey' => 'id'
		),
		'RestoLotesContrato' => array(
			'className' => 'RestoLotesContrato',
			'foreignKey' => 'id'
		),
	);
	public $hasMany = array(
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'contrato_id'
		),
		'ContratoEmbalaje' => array(
			'className' => 'ContratoEmbalaje',
			'foreignKey' => 'contrato_id'
		)
	);
	public $belongsTo = array(
		'Puerto',
		'CanalCompra' => array(
			'className' => 'CanalCompra',
			'foreignKey' => 'canal_compra_id'),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id'),
		'Incoterm' => array(
			'className' => 'Incoterm',
			'foreignKey' => 'incoterm_id'),
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id')
	);
}