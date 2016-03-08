<?php
class Operacion extends AppModel {
	public $recursive = 2;

	public $displayField = 'referencia';

	public $validate = array(
      'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

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
			'foreignKey' => 'contrato_id'),
		'Embalaje' => array(
			'className' => 'Embalaje',
			'foreignKey' => 'embalaje_id')
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
		),
		'Facturacion' => array(
			'className' => 'Facturacion',
			'foreignKey' => 'id'
		)
	);
	public $hasMany = array(
		'AsociadoOperacion' => array(
			'className' => 'AsociadoOperacion',
			'foreignKey' => 'operacion_id'),
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'operacion_id'),
		'LineaMuestra',
		'Retirada'
	);
}
