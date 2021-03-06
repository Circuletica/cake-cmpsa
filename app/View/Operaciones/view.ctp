<?php
$this->extend('/Common/view');
$this->assign('object', 'Operación '.$referencia);
$this->assign('line_object', 'Reparto asociados');
$this->assign('id',$operacion['Operacion']['id']);
$this->assign('class','Operacion');
$this->assign('controller','operaciones');
$this->assign('line_controller','asociado_operaciones');
$this->assign('line_add','0');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Operaciones',
    array(
	'controller' => 'operaciones',
	'action' => 'index'
    )
);
$this->end();

$this->start('filter');
echo  $this->Html->link(
    '<i class="fa fa-envelope fa-lg aria-hidden="true"></i> Envío distribución',
    array(
    'action' =>'envio_asociados',
    $id
    ),
    array(
    'escape'=>false,
    'title'=>'Envío distribución asociados',
    )
);
echo "<br><hr>";
//solo se puede generar una financiacion si aun no existe
if (empty($existe_financiacion)) {
    echo $this->Html->link('<i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i>
	Generar financiación', array(
	    'controller' => 'operaciones',
	    'action' => 'generarFinanciacion',
	    $operacion['Operacion']['id']
	),
	array(
	    'escape' => false)
	);
} else {
    echo $this->Html->link('<i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>
    Ver financiación', array(
	'controller' => 'financiaciones',
	'action' => 'view',
	$operacion['Operacion']['id']
    ),
    array('escape' => false)
    );
}
if (empty($existe_facturacion)) {
    echo $this->Html->link('<i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
	Generar facturación', array(
	    'controller' => 'operaciones',
	    'action' => 'generarFacturacion',
	    $operacion['Operacion']['id']
	),
	array('escape' => false)
    );
} else {
    echo $this->Html->link('<i class="fa fa-list-ul fa-lg" aria-hidden="true"></i>
    Ver facturación', array(
	'controller' => 'facturaciones',
	'action' => 'view',
	$operacion['Operacion']['id']
    ),
    array('escape' => false)
    );
}
$this->end();

$this->start('main');
echo "<dl>";
echo "  <dt>Referencia Contrato:</dt>\n";
echo "<dd>";
echo $this->html->link($operacion['Contrato']['referencia'], array(
    'controller' => 'contratos',
    'action' => 'view',
    $operacion['Contrato']['id'])
);
echo "  </dd>";
echo "  <dt>Proveedor:</dt>\n";
echo "<dd>";
echo $this->html->link($operacion['Contrato']['Proveedor']['nombre_corto'], array(
    'controller' => 'proveedores',
    'action' => 'view',
    $operacion['Contrato']['Proveedor']['id'])
);
echo "  </dd>";
echo "  <dt>Transporte:</dt>\n";
echo "  <dd>".$operacion['Contrato']['transporte']."&nbsp;</dd>";
echo "  <dt>Peso:</dt>\n";
echo "  <dd>".$operacion['PesoOperacion']['peso'].' kg&nbsp;'."</dd>";
echo "  <dt>Peso factura:</dt>\n";
echo "  <dd>".$operacion['PesoOperacion']['peso_pagado'].' kg&nbsp;'."</dd>";
echo "  <dt>Embalaje:</dt>\n";
echo "  <dd>".
    $operacion['PesoOperacion']['cantidad_embalaje'].' x '.
    $embalaje['Embalaje']['nombre'].
    ' ('.$operacion['PesoOperacion']['peso'].'kg)&nbsp;'."</dd>";
echo "  <dt>Lotes:</dt>\n";
echo "  <dd>".$operacion['Operacion']['lotes_operacion']."&nbsp;</dd>";
echo "  <dt>Puerto de Embarque:</dt>\n";
echo "  <dd>".$operacion['PuertoCarga']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Puerto de Destino:</dt>\n";
echo "  <dd>".$operacion['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
//mysql almacena la fecha en formato ymd
echo "  <dt>Fecha fijación:</dt>\n";
echo "  <dd>".$this->Date->format($fecha_fijacion).'&nbsp;'."</dd>";
echo "  <dt>Precio fijación:</dt>\n";
echo "  <dd>".$operacion['Operacion']['precio_fijacion']
    .$divisa
    .'&nbsp;'."</dd>";
echo "  <dt>Diferencial:</dt>\n";
echo "  <dd>".$operacion['Contrato']['diferencial'].$divisa.'&nbsp;'."</dd>";
if ($operacion['Operacion']['opciones'] != 0){
    echo "  <dt>Opciones:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['opciones'].$divisa.'&nbsp;'."</dd>";
}
echo "  <dt>Precio ".$operacion['PrecioTotalOperacion']['divisa']."/Tm:</dt>\n";
echo "  <dd>".
    $operacion['PrecioTotalOperacion']['precio_divisa_tonelada'].
    $operacion['PrecioTotalOperacion']['divisa'].
    '/Tm&nbsp;'.
    "</dd>";
if ($operacion['Contrato']['Incoterm']['si_flete']) {
    echo "  <dt>Flete:</dt>\n";
    echo "  <dd>".
	$operacion['Operacion']['flete'].
	'$/Tm&nbsp;'.
	"</dd>";
}
if (isset($operacion['Operacion']['precio_directo_euro'])) {
    echo "  <dt>Precio €/kg directo:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_directo_euro'].'€/kg&nbsp;'."</dd>";
}else{
    echo "  <dt>Cambio dolar/euro:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['cambio_dolar_euro'].'&nbsp;'."</dd>";
    echo "  <dt>Precio €/Tm:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_tonelada'].'€/Tm&nbsp;'."</dd>";
    if ($operacion['Contrato']['Incoterm']['si_seguro']) {
	echo "  <dt>Seguro:</dt>\n";
	echo "  <dd>".$operacion['Operacion']['seguro'].'%'
	    .' ('.$operacion['PrecioTotalOperacion']['seguro_euro_tonelada'].'€/Tm)'
	    .'&nbsp;'."</dd>";
    }
    echo "  <dt>Forfait:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['forfait'].'€/Tm&nbsp;'."</dd>";
    echo "  <dt>Precio €/kg estimado:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_kilo_total'].'€/kg&nbsp;'."</dd>";
}
echo "  <dt>Comentarios:</dt>\n";
echo "  <dd>".$operacion['Operacion']['observaciones'].'&nbsp;'."</dd>";
echo "</dl>";
$this->end();
$this->start('lines');
//la tabla con el reparto de sacos para los asociados
echo "<table>\n";
if (isset($columnas_reparto)) echo $this->Html->tableHeaders($columnas_reparto);
if (isset($lineas_reparto)) {
    foreach ($lineas_reparto as $codigo => $linea_reparto) {
	echo $this->Html->tableCells(array(
	    $codigo,
	    $linea_reparto['Nombre'],
	    $linea_reparto['Cantidad'],
	    $linea_reparto['Peso'],
	));
    }
}
echo "</table>\n";
$this->end();
?>
    </div>
</div>
