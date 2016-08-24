<?php
class Contacto extends AppModel {
	public $belongsTo = array(
		'Empresa',
		'Departamento'
	);
	public $displayField = 'nombre';
	public $validate = array(
		'nombre' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre no puede estar vacio'
		)
	);
}
