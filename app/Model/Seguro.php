<?php
class Seguro extends AppModel {
	public $recursive = 2;
	public $displayField = 'referencia';
	//public $validate = array(
	//);
	public $belongsTo = array(
		'Aseguradora' => array(
			'className' => 'Empresa',
			'foreignKey' => 'aseguradora_id')
		);
	public $validate = array(
		'referencia' => array(
			'rule' => 'notBlank',
			'message' => 'La referencia no puede estar vacía')
		);

}

?>