<?php
class Puerto extends AppModel{
  public $displayField = 'nombre';
  public $hasMany = 'Operacion';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );
}
