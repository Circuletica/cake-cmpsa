<?php
class RepartoOperacionAsociado extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'Financiacion' => array(
			'className' => 'Financiacion',
			'foreignKey' => 'id')
	);
}

