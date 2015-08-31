<?php
class RestoContrato extends AppModel {
	public $belongsTo = array(
		'Contrato' => array(
			'className' => 'Contrato',
			'foreignKey' => 'id')
	);
}
