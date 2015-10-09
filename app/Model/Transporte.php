<?php
class Transporte extends AppModel {
	public $recursive = 3;
	public $displayField = 'referencia';
	//public $validate = array(
	//);
	public $belongsTo = array(
			'Seguro' => array(
			'className' => 'Seguro',
			'foreignKey' => 'seguro_id')
	);
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

}

?>