<?php
echo $this->Html->script('jquery')."\n"; // Include jQuery library
echo $this->Js->set('cantidadCuenta',$almacentransportes['AlmacenTransporte']['cantidad_cuenta']);
echo $this->Js->writeBuffer(array('onDomReady' => false));

$this->Html->addCrumb('Operación', array(
	'controller'=>'operaciones',
	'action'=>'view_trafico',
	//	$almacentransportes['AlmacenTransporte']['Transporte']['operacion_id']
));
$this->Html->addCrumb('Línea de Transporte', array(
	'controller' => 'transportes',
	'action' => 'view',
	$almacentransportes['AlmacenTransporte']['transporte_id']
)
	);
echo $this->Form->create('AlmacenTransporteAsociado');

?>
<h2>Cuenta corriente <?php echo $almacentransportes['AlmacenTransporte']['cuenta_almacen'] ?></h2>
<fieldset>
<legend>Info</legend>
<?php
echo "<dl>";
echo "<dt style=width:50%;>Nº de linea </dt>\n";
echo "<dd style=margin-left:50%;>";
echo $almacentransportes['Transporte']['linea'].'&nbsp;';
echo "</dd>";
echo "<dt style=width:50%;>Nombre del transporte </dt>\n";
echo "<dd style=margin-left:50%;>";
echo $this->html->link($almacentransportes['Transporte']['nombre_vehiculo'], array(
	'controller' => 'transportes',
	'action' => 'view',
	$almacentransportes['AlmacenTransporte']['transporte_id']
)
			).'&nbsp;';
echo "</dd>";

echo "<dt style=width:50%;>BL/Matrícula </dt>\n";
echo "<dd style=margin-left:50%;>";
echo $almacentransportes['Transporte']['matricula'].'&nbsp;';
echo "</dd>";
echo "<dt style=width:50%;>Almacén</dt>\n";
echo "  <dd style=margin-left:50%;>".$almacentransportes['Almacen']['nombre_corto'].'&nbsp;'."</dd>";
echo "<dt style=width:50%;>Cantidad</dt>\n";
echo "  <dd style=margin-left:50%;>".$almacentransportes['AlmacenTransporte']['cantidad_cuenta'].'&nbsp;sacos'."</dd>";
echo "<dt style=width:50%;>Peso bruto</dt>\n";
echo "<dd style=margin-left:50%;>".$almacentransportes['AlmacenTransporte']['peso_bruto'].'&nbsp;Kg'."</dd>";

echo "</dl>";

?>
</fieldset>
<fieldset style='width: 66%'>
<legend>Distribución asociados</legend>

<table class="tr2 tr3 tr4 tr5 tr6">
<?php
$total_asignacion_teorica=0;
$total_asignacion_real=0;
$total_pendiente = 0;
$total_porcentaje_teorico = 0;
$total_porcentaje_real = 0;

echo $this->Html->tableHeaders(array('Asociado','Asignado Teorico', 'Asignados Real','Pendiente','% teorico', '% real'));

foreach($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte){
	$pendiente = !empty($almacentransporte['Asociado']['Retirada'])? $almacentransporte['sacos_asignados']-$almacentransporte['Asociado']['Retirada'][0]['total_retirada_asociado']: $almacentransporte['sacos_asignados'];

	echo $this->Html->tableCells(array(
		$almacentransporte['Asociado']['Empresa']['nombre_corto'],
		$almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'],
		$this->Form->input('CantidadAsociado.'.$almacentransporte['asociado_id'], array(
			'label' => '',
			'class' => 'cantidad',
			'id' => $almacentransporte['asociado_id'],
			'oninput' => 'sacosAsignados()'
		)
	),
	$pendiente,
	$this->Number->round($almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'],2),
	'<div id=porcentajeAsociado'.$almacentransporte['asociado_id'].' class=porcentajeAsociado>'." %".'</div>',
)
		);
	$total_asignacion_teorica = $total_asignacion_teorica + $almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'];
	$total_asignacion_real = $total_asignacion_real + $almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'];
	$total_pendiente = $total_pendiente + $pendiente;
	$total_porcentaje_teorico = $total_porcentaje_teorico + $almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'];
	//$total_porcentaje_real = $total_porcentaje_real +$almacentransporte['sacos_asignados']*100/$almacentransportes['AlmacenTransporte']['cantidad_cuenta'];

}
echo $this->html->tablecells(array(
	array(
		array(
			'TOTALES',
			array(
				'style' => 'font-weight: bold; text-align:center'
			)
		),
		array(
			$total_asignacion_teorica,
			array(
				'style' => 'font-weight: bold;',
				'bgcolor' => '#5FCF80'
			)
		),
		array(
			'<div id=totalCantidad></div>',
			array(
				'style' => 'font-weight: bold;',
				'bgcolor' => '#5FCF80'
			)
		),
		array(
			$total_pendiente,
			array(
				'style' => 'font-weight: bold;',
				'bgcolor' => '#5FCF80'
			)
		),
		array(
			$total_porcentaje_teorico.'%',
			array(
				'style' => 'font-weight: bold;',
				'bgcolor' => '#5FCF80'
			)
		),
		array(
			'<div id=totalPorcentaje></div>',
			array(
				'style' => 'font-weight: bold;',
				'bgcolor' => '#5FCF80'
			)
		)
	)
));
?>	</table>
<div style='font-weight:bold' id=sinAdjudicar></div>
<?php
echo $this->Html->Link('<i class="fa fa-arrow-left"></i> Cancelar',
	array(
		'action'=>'view',
		'controller' => 'almacen_transportes',
		$id
	),
	array(
		'class' => 'botond',
		'escape'=>false
	)
);
echo $this->Form->end('Guardar Distribución');
?>
</div>
</fieldset>
<script type="text/javascript">
window.onload = sacosAsignados();
</script>
