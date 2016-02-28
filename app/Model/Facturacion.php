<?php
class Facturacion extends AppModel {
	public $displayField = 'referencia';
	public $belongsTo = array(
	    'CuentaVenta' => array(
		'className' => 'CuentaContable',
		'foreignKey' => 'cuenta_venta_id'
	    ),
	    'CuentaIva' => array(
		'className' => 'CuentaContable',
		'foreignKey' => 'cuenta_iva_id'
	    ),
	    'Operacion' => array(
		'foreignKey' => 'id'
	    )
	);
}
