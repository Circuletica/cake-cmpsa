<?php
class Calidad extends AppModel {
	public $recursive = 2;
	public $displayField = 'nombre';
	public $belongsTo = array('Pais');
	public $actsAs = array('Containable');
	public $virtualFields = array(
		//'nombre' => 'CONCAT(Calidad.descafeinado, "-", Pais.nombre, "-", Calidad.descripcion)'
		//'nombre' => 'select CONCAT(calidades.descafeinado,"-",paises.nombre,"-",calidades.descripcion) as nombre_calidad from calidades,paises where calidades.pais_id=paises.id'
		'nombre' => 'CONCAT(Calidad.descafeinado, "-", Calidad.pais_id, "-", Calidad.descripcion)'
	);
   	//Un café 'Blend' se guarda como pais_id==null en la BD
	public $validate = array(
		'pais_id' => array(
			'rule' => 'alphaNumeric',
			'allowEmpty' => true,
			'empty' => 'Blend')
		);
}

