<?php
class Operacion extends AppModel {
	public $recursive = 3;
	public $displayField = 'referencia';
	//public $validate = array(
	//);
	public $belongsTo = array(
			'Agente' => array(
			'className' => 'Agente',
			'foreignKey'=> 'agente_id'),
			'Naviera' => array(
			'className' => 'Naviera',
			'foreignKey' => 'naviera_id'),
			'Almacen' => array(
			'className' => 'Almacen',
			'foreignKey' => 'almacen_id'),
			'Puerto' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_id'),
			'Lote' => array(
			'className' => 'Lote',
			'foreignKey' => 'lote_id')
	);
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

}

