<?php
class Factura extends AppModel {
    public $displayField = 'numero';
    public $belongsTo = array(
	'Empresa',
	'Facturacion'
    );
    public $hasMany = array(
	'FacturaLinea'
    );
}
