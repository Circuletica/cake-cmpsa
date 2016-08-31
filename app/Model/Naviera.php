<?php
class Naviera extends AppModel{
	public $recursive = 3;
	public $displayField = 'nombre_corto';
	public $hasOne = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'id')
		);
/* public $validate = array(
	   'nombre' => array(
	   'rule' => 'notBlank',
	   'message' => 'El nombre no puede ser vacio'
		)
);*/
}
?>