<?php
class PrecioTotalOperacion extends AppModel {
	public $belongsTo = array(
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id')
	);
}
