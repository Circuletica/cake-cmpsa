<?php
class Aseguradora extends AppModel{
  //public $belongsTo = 'Empresa';
  public $recursive = 2;
  public $hasOne = array(
  'Empresa' => array(
  	'className' => 'Empresa',
  	'foreignKey' => 'id')
  );

  public $hasMany = array(
//    'Seguro' => array(
//      'className' => 'Seguro',
//      'foreignKey' => 'aseguradora_id'
//    )
  );
}
?>
