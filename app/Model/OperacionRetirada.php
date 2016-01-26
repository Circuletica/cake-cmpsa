<?php
class OperacionRetirada extends AppModel{
  public $recursive = 2;
  public $belongsTo = array(
      'Retirada' => array(
      	'foreignKey'=> 'retirada_id'
      	)
  );

 /* public $hasMany =array(
  	'Operacion'=> array(
		'className' => 'Operacion',
		'foreignKey' => 'id');*/
}
