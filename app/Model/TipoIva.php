<?php
class TipoIva extends AppModel {
	public $displayField = 'nombre';
	public $hasMany = array(
		'ValorTipoIva' => array(
			'className' => 'ValorTipoIva',
			'foreignKey' => 'tipo_iva_id'
		    ),
//		'Financiacion' => array(
//			'className' => 'Financiacion',
//			'foreignKey' => 'tipo_iva_id'
//		    ),
//		'Comision' => array(
//			'className' => 'Comision',
//			'foreignKey' => 'tipo_iva_id'
//		    )
	);
}
