<?php
class Transporte extends AppModel {
	public $recursive = 3;
	public $belongsTo = array(
			'Aseguradora' => array(
			'className' => 'Aseguradora',
			'foreignKey' => 'aseguradora_id'),
			'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'operacion_id'),
			'Naviera' => array(
			'className' => 'Naviera',
			'foreignKey' => 'naviera_id'),
			'Puerto' => array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_id'),
			'Agente' => array(
			'className' => 'Agente',
			'foreignKey' => 'agente_id')
	);

	public $hasMany = array(
		'AlmacenesTransporte'=> array(
			'className' => 'AlmacenesTransporte',
			'foreignKey' => 'transporte_id'),
		'EmbalajeTransporte' => array(
			'className' => 'EmbalajeTransporte',
			'foreignKey' => 'transporte_id')
	);
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

}

?>