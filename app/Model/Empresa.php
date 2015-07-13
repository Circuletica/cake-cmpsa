<?php
class Empresa extends AppModel {
	public $hasOne = array(
		'BancoPrueba' => array(
			'className' => 'BancoPrueba',
			'foreignKey' => 'id'),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'id')
	);
        public $hasMany = 'Contacto';
        public $belongsTo = array(
                'Pais' => array(
                        'className' => 'Pais',
                        'foreignKey' => 'pais_id'
	                )
        );
	public $validate = array(
		'nombre' => array(
			'rule' => 'notEmpty',
			'message' => 'El nombre no puede estar vacio'
		),
		//a la hora de crear una nueva empresa, como se guarda
		//a la vez que la entidad heredada, si falla la siguiente
		//regla, salta un error de SQL, sin que la validación aparezca
		//en el formulario
		'cuenta_bancaria' => array(
//			'empty' => array(
//				'rule' =>  '#.*#i',  // validate everything
//				'allowEmpty' => true,
//				'last' => false
//			),
			//un numero de cuenta son 20 digitos
			'longitud' => array(
				'allowEmpty' => true,
				'rule' => '/^[0-9]{20}$/',
				'message' => 'la cuenta debe tener 20 dígitos'
				//'required' => 'false',
			),
			//los digitos de control se validan en una funcion externa
			'digitos_control' => array(
				//el método esta en AppModel
				'rule' => array('validate_ccc'),
				'message' => 'dígitos de control erroneos'
			)
		)
	);
 	var $name = 'Empresa';
	public $displayField = 'nombre';
}
?>
