<?php
$primera_linea = 'Financiación '.$referencia.' - '.$calidad.' - '.$condicion
.' - Vencimiento: '.$this->Date->format($fecha_vencimiento);
$segunda_linea = $proveedor.' - '.$cuenta;
//$tercera_linea = $this->Number->round($precio_euro_kilo)
$tercera_linea = $precio_euro_kilo
	.'€/kg Comisión + IVA';

$this->extend('/Common/pdf/viewPdf');
//$this->assign('object', 'Financiación operación '.$referencia);
//$this->assign('object', $primera_linea);
$this->assign('object',
	$primera_linea."<p>".$segunda_linea."<p>".$tercera_linea
);
$this->assign('line_object', 'Distribución');
$this->assign('id',$financiacion['Financiacion']['id']);
$this->assign('class','Financiacion');
$this->assign('controller','financiaciones');
$this->assign('line_controller','reparto_operacion_asociados');
$this->assign('line2_object', '');
$this->assign('line2_controller','');
$this->assign('line_add', '0'); // si se muestra el botón de añadir 'line'
$this->assign('line2_add', '0'); //si se muestra el botón de añadir 'line2'

echo $segunda_linea."\n";
echo $tercera_linea."\n";

$this->start('main');
//echo "<dl>";
//echo "  <dt>Operación</dt>\n";
//echo "<dd>";
//echo $referencia.'&nbsp;';
//echo "</dd>";
//echo "  <dt>Calidad</dt>\n";
//echo "  <dd>".$calidad.'&nbsp;'."</dd>";
//echo "  <dt>Proveedor</dt>\n";
//echo "<dd>";
//echo $proveedor.'&nbsp;';
//echo "</dd>";
//echo "  <dt>Condición</dt>\n";
//echo "<dd>".$condicion.'&nbsp;'."</dd>";
//echo "  <dt>Cuenta bancaria</dt>\n";
//echo "<dd>".$cuenta.'&nbsp;'."</dd>";
//echo "  <dt>Fecha de vencimiento</dt>\n";
//echo "<dd style='font-weight:bold'>".$this->Date->format($fecha_vencimiento).'&nbsp;'."</dd>";
//echo "  <dt>Precio</dt>\n";
//echo "<dd>".$precio_euro_kilo.' €/kg&nbsp;'."</dd>";
//echo "</dl>";
$this->end();

$this->start('lines');
echo "	<table>\n";
setlocale(LC_ALL, "es_ES.UTF-8");
echo $this->html->tableheaders(
	array(
		'Asociado',
		//'Reparto (%)',
		'%',
		//'Peso (kg)',
		'kg',
		//'Coste (€)',
		'Café €',
		//'IVA ('.$iva.'%)',
		$iva.'%',
		//'Comisión',
		'Comisión €',
		//'IVA ('.$iva_comision.'%)',
		$iva_comision.'%',
		//'Total anticipo',
		'Total anticipo €',
		//'Pendiente'
	)
);
foreach($distribuciones as $linea):
	echo $this->Html->tableCells(array(
		$linea['Asociado']['nombre'],
		array(
			$this->Number->round($linea['RepartoOperacionAsociado']['porcentaje_embalaje_asociado']),
//			number_format(
//				(float)$linea['RepartoOperacionAsociado']['porcentaje_embalaje_asociado'],
//				4,',', ''
//			),
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
//		array(
//			$this->Number->round($linea['RepartoOperacionAsociado']['saldo_anticipo']),
//			array(
//				'style' => 'text-align:right;',
//				'bgcolor' => ((float)$linea['RepartoOperacionAsociado']['saldo_anticipo'] == 0) ? '#FFFFFF':'#00FFFF'
//			)
//		)
	));
endforeach;

echo $this->html->tablecells(array(
	'TOTALES',
	array(
		//$this->Number->round($totales['total_porcentaje_embalaje']),
		round(
			(float)$totales['total_porcentaje_embalaje'],
			0,
			PHP_ROUND_HALF_UP
		),
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
//echo "<table>\n";
//echo $this->Html->tableHeaders(array(
//	'Asociado','fecha','importe','Banco',''));
//foreach ($anticipos as $anticipo):
//	echo $this->Html->tableCells(array(
//		$anticipo['AsociadoOperacion']['Asociado']['nombre'],
//		$this->Date->format($anticipo['Anticipo']['fecha_conta']),
//		$anticipo['Anticipo']['importe'],
//		$anticipo['Banco']['nombre_corto']
//	));
//endforeach;
//echo"</table>\n";
$this->end();
?>
