<?php
class AsociadoComision extends AppModel {
	public $belongsTo = array(
		'Comision',
		'Asociado'
	);
}
?>
