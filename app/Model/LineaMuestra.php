<?php
class LineaMuestra extends AppModel {
	public $name = 'Línea de muestra';
	public $useTable = 'linea_muestras';
	public $recursive = 2;
	//public $displayField = 'cuenta_almacen';
	public $displayField = 'referencia_proveedor';
	public $belongsTo = array(
		'Muestra' => array(
			'className' => 'Muestra',
			'foreignKey' => 'muestra_id'
		),
		'CribaPonderada' => array(
			'className' => 'CribaPonderada',
			'foreignKey' => 'id'
		),
		'AlmacenTransporte',
		//'Operacion'
		'OperacionLogistica'
	);
	public $virtualFields = array(
		'total_criba' => 'LineaMuestra.criba20 + LineaMuestra.criba19 + LineaMuestra.criba13p + LineaMuestra.criba18 + LineaMuestra.criba12p + LineaMuestra.criba17 + LineaMuestra.criba11p + LineaMuestra.criba16 + LineaMuestra.criba10p + LineaMuestra.criba15 + LineaMuestra.criba9p + LineaMuestra.criba14 + LineaMuestra.criba8p + LineaMuestra.criba13 + LineaMuestra.criba12'
	);
}
?>
