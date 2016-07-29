<?php
class OperacionRetirada extends AppModel{
	public $name = 'Retirada de operación';
	public $useTable = 'operacion_retiradas';
	public $recursive = 2;
	public $belongsTo = array(
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id'
		),
		'Retirada'
	);

}
