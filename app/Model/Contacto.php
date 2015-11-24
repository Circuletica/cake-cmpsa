<?php
class Contacto extends AppModel {
    public $belongsTo = 'Empresa';
    public $displayField = 'nombre';
    public $validate = array(
	'nombre' => array(
	    'rule' => 'notEmpty',
	    'message' => 'El nombre no puede estar vacio'
	)
    );
}
