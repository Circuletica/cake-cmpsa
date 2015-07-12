<?php
class Contrato extends AppModel {
	public $recursive = 4;
	public $displayField = 'referencia';
	public $validate = array(
		'incoterm_id' => array('required' => true),
		'proveedor_id' => array('required' => true),
		'calidad_id' => array('required' => true),
		'referencia' => array('required' => true)
		);
	public $hasMany = array(
		'LineaContrato' => array(
			'className' => 'LineaContrato',
			'foreignKey' => 'contrato_id'
		),
		'ContratoEmbalaje' => array(
			'className' => 'ContratoEmbalaje',
			'foreignKey' => 'contrato_id'
		)
	);
	public $belongsTo = array(
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
