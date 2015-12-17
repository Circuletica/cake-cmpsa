<?php
class Muestra extends AppModel {
	public $recursive = 2;
	public $displayField = 'registro';
	public $belongsTo = array(
		'CalidadNombre' => array(
			'className' => 'CalidadNombre',
			'foreignKey' => 'calidad_id'),
		'Proveedor' => array(
			'className' => 'Empresa',
			'foreignKey' => 'proveedor_id'),
		//Quitamos esta hasta que se solucione
		//en la BDD
		//'MarcaAlmacen' => array(
		//	'className' => 'MarcaAlmacen',
		//	'foreignKey' => 'marca_almacen_id'),
		//'Operacion' => array(
		//	'className' => 'Operacion',
		//	'foreignKey' => 'operacion_id')
		'Contrato',
		//las muestras de entrega 'pertenecen' a muestras
		//de embarque
		'MuestraEmbarque' => array(
		    'className' => 'Muestra',
		    'foreignKey' => 'muestra_embarque_id'
		)
	);
	public $hasMany = 'LineaMuestra';
}
