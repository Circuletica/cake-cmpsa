<?php
class Calidad extends AppModel {
	public $recursive = 2;
	public $displayField = 'nombre';
	public $hasMany = 'Contrato';
	public $belongsTo = array(
		'Pais',
	);
	public $actsAs = array('Containable');
	public $virtualFields = array(
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
	public function beforeDelete($cascade = true) {
		$count = $this->Contrato->find(
            "count",
            array(
                "recursive" => -1,
                "conditions" => array("calidad_id" => $this->id)
            )
        );
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
