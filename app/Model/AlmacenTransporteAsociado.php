<?php
class AlmacenTransporteAsociado extends AppModel {
    public $belongsTo = array(
	'AlmacenTransporte',
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