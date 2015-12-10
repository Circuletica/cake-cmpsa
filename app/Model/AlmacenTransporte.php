<?php
class AlmacenTransporte extends AppModel {
	public $validate = array(
    	'almacen_id' => array(
      	'rule' => 'notEmpty',
     	'message' => 'El nombre del almacén no puede estar vacío'
      )
    );
	public $belongsTo = array(
			'Almacen',
			'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'transporte_id')
		);
}
?>