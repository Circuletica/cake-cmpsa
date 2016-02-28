<?php
class CuentaContable extends AppModel {
	public $displayField = 'numero';
	public $hasMany = array(
		'Facturacion'
	);
}
