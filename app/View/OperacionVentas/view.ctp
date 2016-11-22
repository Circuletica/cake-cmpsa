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
    'Operacion (venta)',
    array(
	'controller' => 'operacion_ventas',
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
	    'controller' => 'operacion_ventas',
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
    	    'controller' => 'operacion_ventas',
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
echo "  <dt>Precio €/kg directo:</dt>\n";
echo "  <dd>".$operacion['OperacionVenta']['precio_directo_euro'].'€/kg&nbsp;'."</dd>";

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
