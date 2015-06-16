<?php
class Calidad extends AppModel {
	public $recursive = 2;
	//public $displayField = 'nombre'; //bug No existe
	public $hasMany = 'Contrato';
	public $belongsTo = array(
		'Pais',
		'CalidadNombre' =>array(
			'class' => 'CalidadNombre',
			'foreignKey' => 'id'
		)
	);
	public $actsAs = array('Containable');
	public $virtualFields = array(
		//'nombre' => 'CONCAT(Calidad.descafeinado, "-", Pais.nombre, "-", Calidad.descripcion)'
		//'nombre' => 'select CONCAT(calidades.descafeinado,"-",paises.nombre,"-",calidades.descripcion) as nombre_calidad from calidades,paises where calidades.pais_id=paises.id'
		//Quitamos este de momento, porque no parece tener ningun papel
		//Ya que el nombre de calidad esta en una vista de MySQL
		//'nombre' => 'CONCAT(Calidad.descafeinado, "-", Calidad.pais_id, "-", Calidad.descripcion)'
	);
   	//Un café 'Blend' se guarda como pais_id==null en la BD
	public $validate = array(
		'pais_id' => array(
			'rule' => 'alphaNumeric',
			'allowEmpty' => true,
			'empty' => 'Blend')
		);
}
