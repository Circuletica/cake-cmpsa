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
		'CuentaComision' => array(
			'className' => 'CuentaContable',
			'foreignKey' => 'cuenta_comision_id'
		),
		'CuentaIvaVenta' => array(
			'className' => 'CuentaContable',
			'foreignKey' => 'cuenta_iva_venta_id'
		),
		'CuentaIvaComision' => array(
			'className' => 'CuentaContable',
			'foreignKey' => 'cuenta_iva_comision_id'
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
		+ Facturacion.seguro_pagado',
'total_cafe' =>
'(Facturacion.peso_facturacion/1000)
* Facturacion.precio_dolar_tm
/ Facturacion.cambio_dolar_euro'
	);
}
