<?php
class FacturaLinea extends AppModel {
	public $name = 'Línea de factura';
	public $useTable = 'factura_lineas';
	public $displayField = 'concepto';
	public $belongsTo = array(
		'TipoIva'
	)
}
?>