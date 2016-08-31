<?php
class Puerto extends AppModel{
	public $displayField = 'nombre';
	public $belongsTo = array(
		'Pais' => array(
			'className' => 'Pais',
			'foreignKey' => 'pais_id')
		);
	public $validate = array(
		'nombre' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre no puede estar vacío'
		)
	);
}
?>