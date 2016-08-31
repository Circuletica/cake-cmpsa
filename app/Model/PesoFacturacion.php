<?php
class PesoFacturacion extends AppModel {
	public $belongsTo = array(
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'
		)
	);
}
?>