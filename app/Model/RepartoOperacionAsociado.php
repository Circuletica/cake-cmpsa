<?php
class RepartoOperacionAsociado extends AppModel {
	public $recursive = 1;
	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Asociado',
			'foreignKey' => 'asociado_id')
	);
//	public $belongsTo = array(
//		'Financiacion' => array(
//			'className' => 'Financiacion',
//			'foreignKey' => 'id')
//	);
}
?>