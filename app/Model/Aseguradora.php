<?php
class Aseguradora extends AppModel{
  public $displayField = 'nombre_corto';
  public $recursive = 2;
  public $hasOne = array(
  'Empresa' => array(
  	'className' => 'Empresa',
  	'foreignKey' => 'id')
  );

}
?>