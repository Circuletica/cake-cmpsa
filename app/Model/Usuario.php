<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Usuario extends AppModel {
	public $belongsTo = array(
		'Departamento'
	);
	public $displayField = 'username';
	public $validate = array(
		'nombre' => array(
			'rule' => 'notBlank',
			'message' => 'El nombre no puede estar vacio'
		),
		'username' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'El nombre de usuario es obligatorio'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'La contraseña es obligatoria'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array(
					'inList',
					array(
						'admin',
						'contabilidad'
					)
				),
				'message' => 'Por favor, elija un rol válido',
				'allowEmpty' => false
			)
		)
	);
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}
