<?php
class Operacion extends AppModel {
	public $displayField = 'referencia';
  //public $hasMany = 'Contrato';
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía'
      )
    );

}

