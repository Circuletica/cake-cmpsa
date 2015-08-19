<?php
class Flete extends AppModel {
	public $recursive = 2;
	//public $displayField = 'nombre'; //bug No existe
	public $hasMany = 'PrecioFlete';
	public $belongsTo = array(
		'Naviera',
		'Embalaje',
		'PuertoCarga' =>array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_carga_id'
		),
		'PuertoDestino' =>array(
			'className' => 'Puerto',
			'foreignKey' => 'puerto_destino_id'
		)
	);
	//public $actsAs = array('Containable');
}
