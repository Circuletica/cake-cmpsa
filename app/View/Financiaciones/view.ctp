<?php
$this->extend('/Common/view');
$this->assign('object', 'Financiación operación '.$referencia);
$this->assign('line_object', 'Distribución');
$this->assign('id',$financiacion['Financiacion']['id']);
$this->assign('class','Financiacion');
$this->assign('controller','financiaciones');
$this->assign('line_controller','reparto_operacion_asociados');
$this->assign('line2_object', 'anticipo');
$this->assign('line2_controller','anticipos');
$this->assign('line_add', '0'); // si se muestra el botón de añadir 'line'
$this->assign('line2_add', '1'); //si se muestra el botón de añadir 'line2'

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
    $financiacion_id
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
echo "<dd>".$condicion.'&nbsp;'."</dd>";
echo "  <dt>Cuenta bancaria</dt>\n";
echo "<dd>".$cuenta.'&nbsp;'."</dd>";
echo "  <dt>Fecha de vencimiento</dt>\n";
echo "<dd style='font-weight:bold'>".$this->Date->format($fecha_vencimiento).'&nbsp;'."</dd>";
echo "  <dt>Precio</dt>\n";
echo "<dd>".$precio_euro_kilo.' €/kg&nbsp;'."</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
?>
	<table>
<?php
setlocale(LC_ALL, "es_ES.UTF-8");
echo $this->html->tableheaders(array('Asociado','Reparto (%)','Peso (kg)','Coste (€)','IVA ('.$iva.'%)', 'Comisión', 'IVA ('.$iva_comision.'%)','Total anticipo','Pendiente'));
foreach($distribuciones as $linea):
    echo $this->Html->tableCells(array(
	$linea['Asociado']['nombre_corto'],
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['porcentaje_embalaje_asociado']),
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['peso_asociado']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['precio_asociado']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['iva']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['comision']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['iva_comision']),
	    array('style' => 'text-align:right')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['total']),
	    array('style' => 'text-align:right; font-weight:bold')
	),
	array(
	    $this->Number->round($linea['RepartoOperacionAsociado']['saldo_anticipo']),
	    array(
		'style' => 'text-align:right;',
		'bgcolor' => ((float)$linea['RepartoOperacionAsociado']['saldo_anticipo'] == 0) ? '#FFFFFF':'#00FFFF'
	    )
	)
    ));
endforeach;
echo $this->html->tablecells(array(
    'TOTALES',
    array(
	$this->Number->round($totales['total_porcentaje_embalaje']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_peso']),
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
    ),
    array(
	$this->Number->round($totales['total_iva']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_comision']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_iva_comision']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#5FCF80'
	)
    ),
    array(
	$this->Number->round($totales['total_general']),
	array(
	    'style' => 'text-align:right; font-weight:bold',
	    'bgcolor' => '#5FCF80'
	)
    )
)
	);
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
	.' '.$this->Button->deleteLine('anticipos',$anticipo['Anticipo']['id'],'el anticipo de '.$anticipo['Anticipo']['importe'].'€')
    ));
endforeach;
echo"</table>\n";
$this->end();
?>
