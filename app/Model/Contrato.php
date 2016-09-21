<?php
class Contrato extends AppModel {
	public $recursive = 4;
	public $displayField = 'referencia';
	public $virtualFields = array(
		'condicion' => 'CONCAT(
			CASE Contrato.si_entrega WHEN 0 THEN "embarque" WHEN 1 THEN "entrega" END,
			" ",
			SUBSTR(Contrato.fecha_transporte,6,2),
	"/",
	SUBSTR(Contrato.fecha_transporte,1,4),
	"(",
	(SELECT nombre FROM incoterms WHERE id = Contrato.incoterm_id),
	")"
)',
'transporte' => 'CONCAT(
	CASE Contrato.si_entrega WHEN 0 THEN "embarque" WHEN 1 THEN "entrega" END,
	" ",
	SUBSTR(Contrato.fecha_transporte,6,2),
	"/",
	SUBSTR(Contrato.fecha_transporte,1,4)
)',
//existe una muestra de embarque aprobada para ese contrato?
'si_muestra_emb_aprob' => 'CASE(SELECT
COUNT(*)
FROM muestras
WHERE muestras.contrato_id=Contrato.id
AND muestras.tipo_id = 2
AND muestras.aprobado = 1
		) WHEN 0 THEN 0 ELSE 1 END
',
//existe una muestra de embarque aprobada para ese contrato?
'si_muestra_entr_aprob' => 'CASE(SELECT
COUNT(*)
FROM muestras
WHERE muestras.contrato_id=Contrato.id
AND muestras.tipo_id = 3
AND muestras.aprobado = 1
		) WHEN 0 THEN 0 ELSE 1 END
		'
	);
	public $validate = array(
	'incoterm_id' => array('rule' => 'notBlank'),
	'proveedor_id' => array('rule' => 'notBlank'),
	'calidad_id' => array('rule' => 'notBlank'),
	'referencia' => array('rule' => 'notBlank')
	);
	public $hasOne = array(
	'RestoContrato' => array(
		'className' => 'RestoContrato',
		'foreignKey' => 'id'
	),
	'RestoLotesContrato' => array(
		'className' => 'RestoLotesContrato',
		'foreignKey' => 'id'
	),
	);
	public $hasMany = array(
	'OperacionLogistica' => array(
		'className' => 'OperacionLogistica',
		'foreignKey' => 'contrato_id'
	),
	'ContratoEmbalaje' => array(
		'className' => 'ContratoEmbalaje',
		'foreignKey' => 'contrato_id'
	),
	'FleteContrato',
	'PrecioFleteContrato',
	'Muestra'
	);
	public $belongsTo = array(
	'PuertoCarga' => array(
		'className' => 'Puerto',
		'foreignKey' => 'puerto_carga_id'
	),
	'PuertoDestino' => array(
		'className' => 'Puerto',
		'foreignKey' => 'puerto_destino_id'
	),
	'CanalCompra' => array(
		'className' => 'CanalCompra',
		'foreignKey' => 'canal_compra_id'),
	'Proveedor' => array(
		'className' => 'Empresa',
		'foreignKey' => 'proveedor_id'),
	'Incoterm' => array(
		'className' => 'Incoterm',
		'foreignKey' => 'incoterm_id'),
	'Calidad' => array(
		'className' => 'Calidad',
		'foreignKey' => 'calidad_id')
	);
	public function beforeDelete($cascade = true) {
		$count = $this->OperacionLogistica->find(
			"count",
			array(
				"recursive" => -1,
				"conditions" => array("contrato_id" => $this->id)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>
