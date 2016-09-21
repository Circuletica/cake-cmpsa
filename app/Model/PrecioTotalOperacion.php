<?php
class PrecioTotalOperacion extends AppModel {
	public $belongsTo = array(
		'OperacionLogistica' => array(
			'className' => 'OperacionLogistica',
			'foreignKey' => 'id'
		)
	);
}
?>
