
<?php
class AsociadoOperacion extends AppModel {
	public $belongsTo = array(
		'Operacion',
		'Asociado' => array(
		    'className' => 'Empresa',
		    'foreignKey' => 'asociado_id'
		)
	);
	public $hasMany = array(
	    'Anticipo',
	    'Factura'
	);
}
?>
