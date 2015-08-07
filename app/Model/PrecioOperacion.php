<?php
class PrecioOperacion extends AppModel {
	public $belongsTo = array(
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id')
	);
}
