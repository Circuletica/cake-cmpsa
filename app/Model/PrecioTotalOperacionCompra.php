<?php
class PrecioTotalOperacionCompra extends AppModel {
	public $belongsTo = array(
		'OperacionCompra' => array(
			'className' => 'OperacionCompra',
			'foreignKey' => 'id'
		)
	);
}
?>
