<?php
class Muestra extends AppModel {
	public $recursive = 2;
	//Como esta tabla tiene aliases no funciona
	//lo siguiente
	//    public $virtualFields = array(
	//	'tipo_registro' => 'CONCAT(
	//	    CASE Muestra.tipo
	//	    WHEN 1 THEN "OF-"
	//	    WHEN 2 THEN "EB-"
	//	    WHEN 3 THEN "EN-"
	//	    END,
	//	    "-", Muestra.registro)'
	//	);
	//Hay que pasar por el constructor
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['tipo_registro'] = sprintf(
			'CONCAT(
				CASE %s.tipo_id
				WHEN 1 THEN "OF"
				WHEN 2 THEN "EB"
				WHEN 3 THEN "EN"
				END,
				"-", %s.registro
			)',
	$this->alias, $this->alias
	);
	$this->virtualFields['tipo_nombre'] = sprintf(
		'CASE %s.tipo_id
		WHEN 1 THEN "oferta"
		WHEN 2 THEN "embarque"
		WHEN 3 THEN "entrega"
		END
',
	$this->alias, $this->alias
	);
	}
	public $displayField = 'tipo_registro';
	public $belongsTo = array(
		'Calidad' => array(
			'className' => 'Calidad',
			'foreignKey' => 'calidad_id'),
		'Proveedor' => array(
			'className' => 'Empresa',
			'foreignKey' => 'proveedor_id'),
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
