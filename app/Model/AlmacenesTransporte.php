<?php
class AlmacenesTransporte extends AppModel {
	public $belongsTo = array('Almacen',
			'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'transporte_id')
		);
}
?>