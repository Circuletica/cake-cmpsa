<?php
class Puerto extends AppModel{
  public $displayField = 'nombre';
  public $hasMany = 'Transporte';
  public $belongsTo = array(
  	'Pais' => array(
	  'className' => 'Pais',
	  'foreignKey' => 'pais_id')
    );
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede estar vacío'
      )
    );
}
