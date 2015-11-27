<?php
class Aseguradora extends AppModel{
  public $recursive = 2;
  public $hasOne = array(
  'Empresa' => array(
  	'className' => 'Empresa',
  	'foreignKey' => 'id')
  );

}
?>
