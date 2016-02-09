<?php
class AlmacenTransporte extends AppModel {
    public $validate = array(
	'almacen_id' => array(
	    'rule' => 'notEmpty',
	    'message' => 'El nombre del almacén no puede estar vacío'
	)
    );
    public $belongsTo = array(
	'Almacen' => array(
	    'className' => 'Empresa',
	    'foreignKey' => 'almacen_id'),
	'Transporte' => array(
	    'className' => 'Transporte',
	    'foreignKey' => 'transporte_id')
	);
    public $virtualFields = array(
	'cuenta_marca' => 'CONCAT(cuenta_almacen," (",COALESCE(marca_almacen,""),")")'
    );
}
?>
