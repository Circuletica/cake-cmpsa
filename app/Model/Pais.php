<?php
class Pais extends AppModel{
  //public $hasMany= 'Empresa';
//	public $hasMany= array('Proveedor',
//		'Banco',
//		'Naviera',
//		'Cliente',
//		'Agente');
  public $displayField = 'nombre';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );

   public $hasMany = array(
   		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'id'),
   		'Pais'=> array(
			'className'=>'Pais')
   		);    
}
