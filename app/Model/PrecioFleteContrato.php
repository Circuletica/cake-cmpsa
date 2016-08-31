<?php
class PrecioFleteContrato extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'Flete',
	);
}
?>