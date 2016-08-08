<?php
class Incoterm extends AppModel{
	public $displayField = 'nombre';
	//public $hasMany = 'Contrato';
	public $validate = array(
		'nombre' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre no puede ser vacio'
		)
	);
}
