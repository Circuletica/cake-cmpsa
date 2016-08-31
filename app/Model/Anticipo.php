<?php
class Anticipo extends AppModel {
	public $belongsTo = array(
		'AsociadoOperacion',
		'Banco' => array(
			'className' => 'Empresa'
		)
	);
}
?>