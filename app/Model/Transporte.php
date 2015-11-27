<?php
class Transporte extends AppModel {
	public $recursive = 3;
 	public $validate = array(
    	'nombre_vehiculo' => array(
      	'rule' => 'notEmpty',
     	'message' => 'El nombre del vehículo no puede estar vacío'
      ),
  	  'matricula' => array(
      'rule' => 'notEmpty',
      'message' => 'El BL/matrícula no puede estar vacío'
      ),
  	  'naviera_id'=> array(
      'rule' => 'notEmpty',
      'message' => 'La Naviera no puede estar vacía'
      )
    );

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
			'PuertoCarga' => array(
				'className' => 'Puerto',
				'foreignKey' => 'puerto_carga_id'),
			'PuertoDestino' => array(
				'className' => 'Puerto',
				'foreignKey' => 'puerto_destino_id'),
			'Agente' => array(
				'className' => 'Agente',
				'foreignKey' => 'agente_id')
	);

	public $hasMany = array(
		'AlmacenTransporte'=> array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'transporte_id')
	);


}

?>
