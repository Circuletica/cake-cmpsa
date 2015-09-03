<?php
class Operacion extends AppModel {
	public $recursive = 2;
	//public $actsAs = array('Containable');
	public $validate = array(
      'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );
	public $belongsTo = array(
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
		)
	);
	public $hasMany = array(
		'AsociadoOperacion' => array(
			'className' => 'AsociadoOperacion',
			'foreignKey' => 'operacion_id'),
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'operacion_id')
	);
}
