<?php
class LineaContrato extends AppModel {

	public $recursive = 3;

	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'contrato_id'),
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'operacion_id')		
	);

//	public $hasMany = array(
//		'LineaContratosOperacion' => array(
//			'className' => 'LineaContratosOperacion',
//			'foreignKey' => 'linea_contrato_id'
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

//	public $hasAndBelongsToMany = array(
//        'Asociado' =>
//            array(
//                'className' => 'Asociado',
//                'joinTable' => 'asociados_linea_contratos',
//                'foreignKey' => 'linea_contrato_id',
 //               'associationForeignKey' => 'asociado_id'
 //       )
 //   );
}

