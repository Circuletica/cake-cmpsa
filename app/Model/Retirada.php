<?php
class Retirada extends AppModel {
	public $recursive = 2;

	public $validate = array(
      'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

	public $belongsTo = array(
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'transporte_id'
		),
		'Asociado' => array(
			'className' => 'Asociado',
			'foreignKey' => 'asociado_id'),
		'AlmacenTransporte' => array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'almacen_transporte_id')
	);
/*	public $hasOne = array(
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
			'foreignKey' => 'operacion_id')
	);*/
}
