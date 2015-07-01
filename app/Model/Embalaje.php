<?php
class Embalaje extends AppModel{
	public $hasMany = array(
		'EmbalajesTransporte' => array(
			'className' => 'EmbalajesTransporte',
			'foreignKey' => 'embalaje_id')
	);
	
  public $displayField = 'nombre';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );
}
