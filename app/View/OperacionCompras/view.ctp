<?php
$this->extend('/Common/view');
$this->assign('object', 'Operación compra) '.$referencia);
$this->assign('line_object', 'Reparto asociados solicitado');
$this->assign('id',$operacion['OperacionCompra']['id']);
$this->assign('class','Operacion');
$this->assign('controller','operacion_compras');
$this->assign('line_controller','pedidos');
$this->assign('line_add','0');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Operaciones (compra)'
    array(
	'controller' => 'operacion_compras',
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
	    'controller' => 'operacion_compras',
	    'action' => 'generarFinanciacion',
	    $operacion['OperacionCompra']['id']
	),
	array(
	    'escape' => false)
	);
} else {
    echo $this->Html->link('<i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>
    Ver financiación', array(
	'controller' => 'financiaciones',
	'action' => 'view',
	$operacion['OperacionCompra']['id']
    ),
    array('escape' => false)
    );
}
if (empty($existe_facturacion)) {
    echo $this->Html->link('<i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
	Generar facturación', array(
	    'controller' => 'operacion_compras',
	    'action' => 'generarFacturacion',
	    $operacion['OperacionCompra']['id']
	),
	array('escape' => false)
    );
} else {
    echo $this->Html->link('<i class="fa fa-list-ul fa-lg" aria-hidden="true"></i>
    Ver facturación', array(
	'controller' => 'facturaciones',
	'action' => 'view',
	$operacion['OperacionCompra']['id']
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
echo "  <dd>".$operacion['PesoOperacionCompra']['peso'].' kg&nbsp;'."</dd>";
echo "  <dt>Peso factura:</dt>\n";
echo "  <dd>".$operacion['PesoOperacionCompra']['peso_pagado'].' kg&nbsp;'."</dd>";
echo "  <dt>Embalaje:</dt>\n";
echo "  <dd>".
    $operacion['PesoOperacionCompra']['cantidad_embalaje'].' x '.
    $embalaje['Embalaje']['nombre'].
    ' ('.$operacion['PesoOperacionCompra']['peso'].'kg)&nbsp;'."</dd>";
echo "  <dt>Lotes:</dt>\n";
echo "  <dd>".$operacion['OperacionCompra']['lotes_operacion']."&nbsp;</dd>";
echo "  <dt>Puerto de Embarque:</dt>\n";
echo "  <dd>".$operacion['PuertoCarga']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Puerto de Destino:</dt>\n";
echo "  <dd>".$operacion['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
//mysql almacena la fecha en formato ymd
echo "  <dt>Fecha fijación:</dt>\n";
echo "  <dd>".$this->Date->format($fecha_fijacion).'&nbsp;'."</dd>";
echo "  <dt>Precio fijación:</dt>\n";
echo "  <dd>".$operacion['OperacionCompra']['precio_fijacion']
    .$divisa
    .'&nbsp;'."</dd>";
echo "  <dt>Diferencial:</dt>\n";
echo "  <dd>".$operacion['Contrato']['diferencial'].$divisa.'&nbsp;'."</dd>";
if ($operacion['OperacionCompra']['opciones'] != 0){
    echo "  <dt>Opciones:</dt>\n";
    echo "  <dd>".$operacion['OperacionCompra']['opciones'].$divisa.'&nbsp;'."</dd>";
}
echo "  <dt>Precio ".$operacion['PrecioTotalOperacionCompra']['divisa']."/Tm:</dt>\n";
echo "  <dd>".
    $operacion['PrecioTotalOperacionCompra']['precio_divisa_tonelada'].
    $operacion['PrecioTotalOperacionCompra']['divisa'].
    '/Tm&nbsp;'.
    "</dd>";
if ($operacion['Contrato']['Incoterm']['si_flete']) {
    echo "  <dt>Flete:</dt>\n";
    echo "  <dd>".
	$operacion['OperacionCompra']['flete'].
	'$/Tm&nbsp;'.
	"</dd>";
}
if (isset($operacion['OperacionCompra']['precio_directo_euro'])) {
    echo "  <dt>Precio €/kg directo:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacionCompra']['precio_directo_euro'].'€/kg&nbsp;'."</dd>";
}else{
    echo "  <dt>Cambio dolar/euro:</dt>\n";
    echo "  <dd>".$operacion['OperacionCompra']['cambio_dolar_euro'].'&nbsp;'."</dd>";
    echo "  <dt>Precio €/Tm:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacionCompra']['precio_euro_tonelada'].'€/Tm&nbsp;'."</dd>";
    if ($operacion['Contrato']['Incoterm']['si_seguro']) {
	echo "  <dt>Seguro:</dt>\n";
	echo "  <dd>".$operacion['OperacionCompra']['seguro'].'%'
	    .' ('.$operacion['PrecioTotalOperacionCompra']['seguro_euro_tonelada'].'€/Tm)'
	    .'&nbsp;'."</dd>";
    }
    echo "  <dt>Forfait:</dt>\n";
    echo "  <dd>".$operacion['OperacionCompra']['forfait'].'€/Tm&nbsp;'."</dd>";
    echo "  <dt>Precio €/kg estimado:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacionCompra']['precio_euro_kilo_total'].'€/kg&nbsp;'."</dd>";
}
echo "  <dt>Comentarios:</dt>\n";
echo "  <dd>".$operacion['OperacionCompra']['observaciones'].'&nbsp;'."</dd>";
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
