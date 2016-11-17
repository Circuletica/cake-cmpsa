<?php
class Anticipo extends AppModel {
	public $belongsTo = array(
		'Pedido',
		'Banco' => array(
			'className' => 'Empresa'
		)
	);
}
?>
