<?php
class Embalaje extends AppModel{
  public $displayField = 'nombre';
  public $hasMany = array(
    'ContratoEmbalaje' => array(
      'className' => 'ContratoEmbalaje',
      'foreignKey' => 'contrato_id'
    )    
  );
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede estar vacio'
      )
    );
}
