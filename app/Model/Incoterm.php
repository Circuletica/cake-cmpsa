<?php
class Incoterm extends AppModel{
  public $displayField = 'nombre';
  //public $hasMany = 'Contrato';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );
}
