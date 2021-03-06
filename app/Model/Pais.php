<?php
class Pais extends AppModel{
	public $displayField = 'nombre';
	public $validate = array(
		'nombre' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre no puede estar vacio'
		)
	);

	public $hasMany = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'id')
		);
}
?>