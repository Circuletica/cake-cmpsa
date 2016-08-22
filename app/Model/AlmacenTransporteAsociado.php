<?php
class AlmacenTransporteAsociado extends AppModel {
	public $belongsTo = array(
		'AlmacenTransporte',
		'Asociado',
	);
	public $virtualFields = array(
		//'suma_reparto' => 'sum(sacos_asignados)'
	);

}
?>