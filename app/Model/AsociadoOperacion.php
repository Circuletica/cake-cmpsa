
<?php
class AsociadoOperacion extends AppModel {
	public $belongsTo = array(
		'Operacion',
		'Asociado'
	);
	public $hasMany = array(
	    'Anticipo',
	    'Factura'
	);
}
?>
