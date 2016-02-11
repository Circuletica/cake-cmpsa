<?php
class Contrato extends AppModel {
    public $recursive = 4;
    public $displayField = 'referencia';
    public $virtualFields = array(
	'transporte' => 'CONCAT(
	    CASE Contrato.si_entrega WHEN 0 THEN "embarque" WHEN 1 THEN "entrega" END,
	    " ",
	    SUBSTR(Contrato.fecha_transporte,6,2),
	    "/",
	    SUBSTR(Contrato.fecha_transporte,1,4)
	)'
    );
    public $validate = array(
	'incoterm_id' => array('rule' => 'notEmpty'),
	'proveedor_id' => array('rule' => 'notEmpty'),
	'calidad_id' => array('rule' => 'notEmpty'),
	'referencia' => array('rule' => 'notEmpty')
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
	'Operacion' => array(
	    'className' => 'Operacion',
	    'foreignKey' => 'contrato_id'
	),
	'ContratoEmbalaje' => array(
	    'className' => 'ContratoEmbalaje',
	    'foreignKey' => 'contrato_id'
	),
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
	'CalidadNombre' => array(
	    'className' => 'CalidadNombre',
	    'foreignKey' => 'calidad_id')
	);
}
