<?php
class Usuario extends AppModel {
    public $belongsTo = array(
	'Empresa',
	'Departamento'
    );
    public $displayField = 'nombre';
    public $validate = array(
	'nombre' => array(
	    'rule' => 'notEmpty',
	    'message' => 'El nombre no puede estar vacio'
	)
    );
}
