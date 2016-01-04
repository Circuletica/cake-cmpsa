<?php
class Naviera extends AppModel{
    public $displayfield = 'nombre_corto';
    public $recursive = 3;
    public $displayField = 'id';
    public $hasOne = array('Empresa' => array(
	'className' => 'Empresa',
	'foreignKey' => 'id')
    );
/* public $validate = array(
       'nombre' => array(
       'rule' => 'notEmpty',
       'message' => 'El nombre no puede ser vacio'
        )
    );*/
}
