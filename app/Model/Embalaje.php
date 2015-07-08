<?php
class Embalaje extends AppModel{
  //public $hasMany= 'Empresa';
//  public $hasMany= array('Proveedor',
//    'Banco',
//    'Naviera',
//    'Cliente',
//    'Agente');
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
      'message' => 'El nombre no puede ser vacio'
      )
    );
}