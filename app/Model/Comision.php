<?php
class Comision extends AppModel {
	public $hasMany = array(
		'AsociadoComision' => array(
			'className' => 'AsociadoComision',
			'foreignKey' => 'comision_id')
	);
	var $displayField = 'valor';
}
