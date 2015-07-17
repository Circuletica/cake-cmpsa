<?php
class AsociadoLineaContrato extends AppModel {
	public $belongsTo = array(
		'LineaContrato',
		'Asociado'
	);
}
?>
