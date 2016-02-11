<?php
class Agente extends AppModel{
  public $displayfield = 'nombre_corto';
  public $recursive = 2;
  public $hasOne = array('Empresa' => array(
	'className' => 'Empresa',
	'foreignKey' => 'id')
  );
  //public $belongsTo = 'Pais';
  //public $validate = array(
  //  'nombre' => array(
  //    'rule' => 'notEmpty',
  //    'message' => 'El nombre no puede estar vacio'
  //    )
  //);
}
