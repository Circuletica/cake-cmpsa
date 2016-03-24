<?php
class Facturacion extends AppModel {
    public $displayField = 'referencia';
    public $hasMany = array(
	'Factura'
    );
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
    public $virtualFields = array(
	'total_gastos' =>
	'Facturacion.flete_pagado
	+ Facturacion.gastos_bancarios_pagados
	+ Facturacion.despacho_pagado
	+ Facturacion.seguro_pagado'
    );
}
