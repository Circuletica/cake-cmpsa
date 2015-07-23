<?php
class Operacion extends AppModel {
	public $recursive = 3;
	public $displayField = 'referencia';
  	public $validate = array(
	    'referencia' => array(
		      'rule' => 'notEmpty',
		      'message' => 'La referencia no puede estar vacía'
		      )
	    );
	public $hasMany = array(
		'Muestra' => array(
			'className' => 'Muestra'),
		'Transporte' => array(
			'className' => 'Transporte'),
		'Asociado' => array(
			'clasName' => 'Asociado')
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
		'PesoOperacion' => array(
			'className' => 'PesoOperacion',
			'foreignKey' => 'id'
		)
	);

}

?>
