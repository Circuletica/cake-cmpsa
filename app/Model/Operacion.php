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
			'Puerto' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_id'),
	//		'Proveedor' => array(
	//		'className' => 'Proveedor',
	//		'foreignKey' => 'proveedor_id'),
	//		'Incoterm' => array(
	//		'className' => 'Incoterm',
	//		'foreignKey' => 'incoterm_id'),
	//		'CalidadNombre' => array(
	//		'className' => 'CalidadNombre',
	//		'foreignKey' => 'calidad_id')
	);
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

}

?>