<?php
class LineaContrato extends AppModel {
	public $recursive = 2;
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato_id')
	);
	public $hasOne = array(
		'PesoLineaContrato' => array(
			'className' => 'PesoLineaContrato',
			'foreignKey' => 'id'
		)
	);
	public $hasMany = array(
		'AsociadoLineaContrato' => array(
			'className' => 'AsociadoLineaContrato',
			'foreignKey' => 'linea_contrato_id'
		)
	);
//	public $hasAndBelongsToMany = array(
//		'Operacion' => array(
//			'className' => 'Operacion',
//			'joinTable' => 'linea_contratos_operaciones',
//			'foreignKey' => 'operacion_id',
//			'associationForeignKey' => 'linea_contrato_id'
//		)
//	);
}

