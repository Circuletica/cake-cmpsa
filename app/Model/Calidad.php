<?php
class Calidad extends AppModel {
	public $recursive = 2;
	public $displayField = 'nombre';
	public $hasMany = 'Contrato';
	public $belongsTo = array(
		'Pais',
//		'CalidadNombre' =>array(
//			'class' => 'CalidadNombre',
//			'foreignKey' => 'id'
//		)
	);
	public $actsAs = array('Containable');
	public $virtualFields = array(
	    //(case when isnull(`c`.`pais_id`) then concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),'Blend','-',`c`.`descripcion`) else concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),`p`.`nombre`,'-',`c`.`descripcion`) end)
	    'nombre' => 'CONCAT(
		REPLACE(REPLACE(Calidad.descafeinado,0,""),1,"Descafeinado "),
		    CASE WHEN ISNULL(Calidad.pais_id) THEN "Blend"
			ELSE
			    (SELECT nombre from paises where paises.id = Calidad.pais_id)
		    END,
		"-",
		Calidad.descripcion
		)',
	);
   	//Un café 'Blend' se guarda como pais_id=null en la BD
	public $validate = array(
		'pais_id' => array(
			'rule' => 'alphaNumeric',
			'allowEmpty' => true,
			'empty' => 'Blend')
		);
}
