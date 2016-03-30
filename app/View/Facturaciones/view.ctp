<?php
$this->extend('/Common/view');
$this->assign('object', 'Facturación operación '.$referencia);
$this->assign('line_object', 'Facturas');
$this->assign('id',$facturacion_id);
$this->assign('class','Facturacion');
$this->assign('line_controller','reparto_operacion_asociados');
$this->assign('line_add', '0'); // si se muestra el botón de añadir 'line'

$this->start('filter');
//echo $this->element('filtrofinanciacion');
$this->end();

$this->start('main');
echo "<dl>";
echo "  <dt>Operación</dt>\n";
echo "<dd>";
echo $this->html->link($referencia, array(
    'controller' => 'operaciones',
    'action' => 'view',
    $facturacion_id
)
	).'&nbsp;';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "  <dd>".$calidad.'&nbsp;'."</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->html->link($proveedor, array(
    'controller' => 'proveedores',
    'action' => 'view',
    $proveedor_id)
).'&nbsp;';
echo "</dd>";
echo "  <dt>Condición</dt>\n";
echo "  <dd>".$condicion.'&nbsp;'."</dd>";
echo "  <dt>Precio estimado</dt>\n";
echo "  <dd>".$precio_estimado.'€/kg&nbsp;'."</dd>";
echo "  <dt>Cambio teórico</dt>\n";
echo "  <dd>".$cambio_teorico.'$/€&nbsp;'."</dd>";
echo "  <dt>Precio café</dt>\n";
echo "  <dd>".$precio_cafe.'$/Tm&nbsp;'."</dd>";
echo "  <dt>Cambio real</dt>\n";
echo "  <dd>".$cambio_real.'$/€&nbsp;'."</dd>";
echo "  <dt>Total Café</dt>\n";
echo "  <dd><b>".$total_cafe.'€&nbsp;'."</b></dd>";
echo "  <dt>Gastos bancarios</dt>\n";
echo "  <dd>".$gastos_bancarios.'€&nbsp;'."</dd>";
echo "  <dt>Despacho</dt>\n";
echo "  <dd>".$despacho.'€&nbsp;'."</dd>";
echo "  <dt>Flete</dt>\n";
echo "  <dd>".$flete.'€&nbsp;'."</dd>";
echo "  <dt>Seguro</dt>\n";
echo "  <dd>".$seguro.'€&nbsp;'."</dd>";
echo "  <dt>Total Gastos</dt>\n";
echo "  <dd><b>".$total_gastos.'€&nbsp;'."</b></dd>";
echo "  <dt>Total Operación</dt>\n";
echo "  <dd><b>".($total_gastos+$total_cafe).'€&nbsp;'."</b></dd>";
echo "  <dt>Peso Facturación</dt>\n";
echo "  <dd><b>".$peso_facturacion.'kg&nbsp;'."</b></dd>";
echo "  <dt>Peso Medio saco</dt>\n";
echo "  <dd>".$peso_medio_saco.'kg&nbsp;'."</dd>";
echo "  <dt>Precio real</dt>\n";
echo "  <dd><b>".$precio_real.'€/kg&nbsp;'."</b></dd>";
echo "</dl>";
$this->end();

$this->start('lines');
?>
	<table>
<?php
setlocale(LC_ALL, "es_ES.UTF-8");
echo $this->html->tableheaders(array('Codigo','Asociado','Peso retirado (kg)','Sacos pendientes','Peso sacos pendientes (kg)','Peso total (kg)', 'Precio (€)'));
$totales['total_precio'] = 0;
foreach($peso_asociados as $linea):
    echo $this->Html->tableCells(array(
	$linea['Asociado']['codigo_contable'],
	$linea['Asociado']['nombre_corto'],
	array(
	    $this->Number->round($linea['PesoFacturacion']['total_peso_retirado']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['PesoFacturacion']['sacos_pendientes']),
	    array(
		'style' => 'text-align:right',
		'bgcolor' => ((float)$linea['PesoFacturacion']['sacos_pendientes'] == 0) ? '#FFFFFF':'#00FFFF'
	    )
	),
	array(
	    $this->Number->round($linea['PesoFacturacion']['peso_pendiente']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['PesoFacturacion']['peso_total']),
	    array(
		'style' => 'text-align:right;',
	    )
	),
	array(
	    $this->Number->round($linea['PesoFacturacion']['peso_total']*$precio_real),
	    array(
		'style' => 'text-align:right;',
		'bgcolor' => '#00FFFF'
	    )
	)
    ));
$totales['total_precio'] += ($linea['PesoFacturacion']['peso_total']*$precio_real);
endforeach;
echo $this->html->tablecells(array(
    'TOTALES',
    '',
    array(
	$this->Number->round($totales['total_peso_retirado']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_sacos_pendientes']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_peso_pendiente']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_peso_total']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_precio']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    )
));
echo"</table><br>\n";

$this->end();

$this->start('lines2');
echo "<table>\n";
echo $this->Html->tableHeaders(array(
    'Asociado','fecha','importe','Banco',''));
foreach ($anticipos as $anticipo):
    echo $this->Html->tableCells(array(
	$anticipo['AsociadoOperacion']['Asociado']['nombre'],
	$this->Date->format($anticipo['Anticipo']['fecha_conta']),
	$anticipo['Anticipo']['importe'],
	$anticipo['Banco']['nombre_corto'],
	$this->Button->editLine('anticipos',$anticipo['Anticipo']['id'],'financiaciones',$anticipo['AsociadoOperacion']['operacion_id'])
	.' '.$this->Button->deleteLine('anticipos',$anticipo['Anticipo']['id'],'financiaciones',$anticipo['AsociadoOperacion']['operacion_id'],'el anticipo de '.$anticipo['Anticipo']['importe'].'€')
    ));
endforeach;
echo"</table>\n";
$this->end();
?>
