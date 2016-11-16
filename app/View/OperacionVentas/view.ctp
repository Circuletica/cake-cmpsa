<?php
$this->extend('/Common/view');
$this->assign('object', 'Operación (venta) '.$referencia);
$this->assign('line_object', 'Reparto asociados');
$this->assign('id',$operacion['OperacionVenta']['id']);
$this->assign('class','OperacionVenta');
$this->assign('controller','operacion_ventas');
$this->assign('line_controller','distribuciones');
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
	    $operacion['OperacionVenta']['id']
	),
	array(
	    'escape' => false)
	);
} else {
    echo $this->Html->link('<i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>
    Ver financiación', array(
	'controller' => 'financiaciones',
	'action' => 'view',
	$operacion['OperacionVenta']['id']
    ),
    array('escape' => false)
    );
}
if (empty($existe_facturacion)) {
    echo $this->Html->link('<i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
	Generar facturación', array(
	    'controller' => 'operaciones',
	    'action' => 'generarFacturacion',
	    $operacion['OperacionVenta']['id']
	),
	array('escape' => false)
    );
} else {
    echo $this->Html->link('<i class="fa fa-list-ul fa-lg" aria-hidden="true"></i>
    Ver facturación', array(
	'controller' => 'facturaciones',
	'action' => 'view',
	$operacion['OperacionVenta']['id']
    ),
    array('escape' => false)
    );
}
$this->end();

$this->start('main');
echo "<dl>";
echo "  <dt>Referencias de Contrato:</dt>\n";
echo "<dd>";
echo $this->html->link($operacion['OperacionCompra']['Contrato']['referencia'], array(
    'controller' => 'contratos',
    'action' => 'view',
    $operacion['OperacionCompra']['Contrato']['id'])
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
echo "  <dd>".$operacion['OperacionVenta']['lotes_operacion']."&nbsp;</dd>";
echo "  <dt>Puerto de Destino:</dt>\n";
echo "  <dd>".$operacion['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
//mysql almacena la fecha en formato ymd
echo "  <dt>Fecha fijación:</dt>\n";
echo "  <dd>".$this->Date->format($fecha_fijacion).'&nbsp;'."</dd>";
echo "  <dt>Precio fijación:</dt>\n";
echo "  <dd>".$operacion['OperacionVenta']['precio_fijacion']
    .$divisa
    .'&nbsp;'."</dd>";
echo "  <dt>Diferencial:</dt>\n";
echo "  <dd>".$operacion['Contrato']['diferencial'].$divisa.'&nbsp;'."</dd>";
if ($operacion['OperacionVenta']['opciones'] != 0){
    echo "  <dt>Opciones:</dt>\n";
    echo "  <dd>".$operacion['OperacionVenta']['opciones'].$divisa.'&nbsp;'."</dd>";
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
	$operacion['OperacionVenta']['flete'].
	'$/Tm&nbsp;'.
	"</dd>";
}
if (isset($operacion['OperacionVenta']['precio_directo_euro'])) {
    echo "  <dt>Precio €/kg directo:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_directo_euro'].'€/kg&nbsp;'."</dd>";
}else{
    echo "  <dt>Cambio dolar/euro:</dt>\n";
    echo "  <dd>".$operacion['OperacionVenta']['cambio_dolar_euro'].'&nbsp;'."</dd>";
    echo "  <dt>Precio €/Tm:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_tonelada'].'€/Tm&nbsp;'."</dd>";
    if ($operacion['Contrato']['Incoterm']['si_seguro']) {
	echo "  <dt>Seguro:</dt>\n";
	echo "  <dd>".$operacion['OperacionVenta']['seguro'].'%'
	    .' ('.$operacion['PrecioTotalOperacion']['seguro_euro_tonelada'].'€/Tm)'
	    .'&nbsp;'."</dd>";
    }
    echo "  <dt>Forfait:</dt>\n";
    echo "  <dd>".$operacion['OperacionVenta']['forfait'].'€/Tm&nbsp;'."</dd>";
    echo "  <dt>Precio €/kg estimado:</dt>\n";
    echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_kilo_total'].'€/kg&nbsp;'."</dd>";
}
echo "  <dt>Comentarios:</dt>\n";
echo "  <dd>".$operacion['OperacionVenta']['observaciones'].'&nbsp;'."</dd>";
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
