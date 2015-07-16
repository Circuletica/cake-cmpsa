<?php
class Operacion extends AppModel {
	public $recursive = 4;
	public $displayField = 'referencia';
	//public $validate = array(
	//);
	//public $hasAndBelongsToMany = array(
	//	'LineaContrato' => array(
	//		'className' => 'LineaContrato',
	//		'joinTable' => 'linea_contratos_operaciones',
	//		'foreignKey' => 'linea_contrato_id',
	//		'associationForeignKey' => 'operacion_id'
	//	)
	//);

	public $hasMany = array(
		'LineaContrato' => array(
		'className' => 'LineaContrato'),
		'Muestra' => array(
			'className' => 'Muestra'),
		'Transporte' => array(
			'className' => 'Transporte')
	);

//	public $belongsTo = array(
//		'Agente' => array(
//			'className' => 'Agente',
//			'foreignKey'=> 'agente_id'),
//		'Naviera' => array(
//			'className' => 'Naviera',
//			'foreignKey' => 'naviera_id'),
//		'Puerto' => array(
//			'className' => 'Puerto',
//			'foreignKey' => 'puerto_id'),
//	);
  	public $validate = array(
	    'referencia' => array(
		      'rule' => 'notEmpty',
		      'message' => 'La referencia no puede estar vacía'
		      )
	    );

}

?>
