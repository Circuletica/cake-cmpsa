<?php
class Naviera extends AppModel{
    public $displayField = 'nombre_corto';
    public $recursive = 2;
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
