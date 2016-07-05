<?php
class AlmacenReparto extends AppModel {
	public $belongsTo = array(
		'AlmacenTransporte' => array(
			'className' => 'AlmacenTransporte',
			'foreignKey' => 'id'
		),
		'Asociado' => array(
			'className' => 'Empresa',
			'foreignKey' => 'asociado_id'
		)
	);
	public $virtualFields = array(
		//'suma_reparto' => 'sum(sacos_asignados)'
	);
}
?>
