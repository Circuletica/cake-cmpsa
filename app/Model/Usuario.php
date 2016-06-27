<?php
class Usuario extends AppModel {
    public $belongsTo = array(
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
