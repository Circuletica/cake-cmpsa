<?php
class Transporte extends AppModel {
	public $recursive = 3;
	//public $displayField = 'referencia';
	//public $validate = array(
	//);
	public $belongsTo = array(
			'Seguro' => array(
			'className' => 'Seguro',
			'foreignKey' => 'seguro_id'),
			'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'operacion_id')
	);

	public $hasMany = array(
		'AlmacenesTransporte'=> array(
			'className' => 'AlmacenesTransporte',
			'foreignKey' => 'transporte_id'),
		'Seguro' => array(
			'className'=>'Seguro')
	);
    public $hasOne = array(
    	'EmbalajesLineaContrato' => array(
			'className' => 'EmbalajesLineaContrato',
			'foreignKey' => 'embalajes_linea_contrato_id')
    );
  	public $validate = array(
    'referencia' => array(
      'rule' => 'notEmpty',
      'message' => 'La referencia no puede estar vacía')
    );

}

?>