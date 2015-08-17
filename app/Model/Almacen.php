<?php
class Almacen extends AppModel {
	public $recursive = 2;
	//public $belongTo = 'Empresa';
//	public $belongTo = array('Empresa' => array(
//	public $validate = array(
//		'cuenta_cliente_1' => array(
//			//un numero de cuenta son 20 digitos
//			'longitud' => array(
//				'allowEmpty' => true,
//				'rule' => '/^[0-9]{20}$/',
//				'message' => 'la cuenta debe tener 20 dígitos'
//			),
//			//los digitos de control se validan en una funcion externa
//			'digitos_control' => array(
//				//el método esta en AppModel
//				'rule' => array('validate_ccc'),
//				'message' => 'dígitos de control erroneos'
//			)
//			//'cuenta_cliente_1' => array(
//			//'rule' => '/^[0-9]{4}-[0-9]{4}-[0-9]{2}-[0-9]{10}$/',
//			//'message' => 'número de cuenta erroneo',
//			//'allowEmpty' => 'true'
//		),
//		//'cuenta_cliente_2' => array(
//		//	'rule' => '/^[0-9]{4}-[0-9]{4}-[0-9]{2}-[0-9]{10}$/',
//		//	'message' => 'número de cuenta erroneo'
//		//)
//	);
	public $hasOne = array('Empresa' => array(
		'className' => 'Empresa',
		'foreignKey' => 'id')
	);
}
