<?php
class Banco extends AppModel {
	public $displayField = 'nombre_corto';
	public $recursive = 2;
	public $validate = array(
		'cuenta_cliente_1' => array(
			//un numero de cuenta son 20 digitos
			'longitud' => array(
				'allowEmpty' => true,
				'rule' => '/^[0-9]{20}$/',
				'message' => 'la cuenta debe tener 20 dígitos'
			),
			//los digitos de control se validan en una funcion externa
			'digitos_control' => array(
				//el método esta en AppModel
				'rule' => array('validate_ccc'),
				'message' => 'dígitos de control erroneos'
			)
		)
	);
	public $hasOne = array('Empresa' => array(
		'className' => 'Empresa',
		'foreignKey' => 'id')
	);
}
?>