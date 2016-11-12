<?php
class OperacionAsociadoCuenta extends AppModel {
	public $belongsTo = array(
		'AlmacenTransporte',
		'Asociado',
		'OperacionVenta'
	);
	public $virtualFields = array(
		//'suma_reparto' => 'sum(sacos_asignados)'
	);

}
?>
