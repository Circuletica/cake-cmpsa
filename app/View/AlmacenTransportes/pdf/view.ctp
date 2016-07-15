<h2>Cuenta corriente <?php echo $almacentransportes['AlmacenTransporte']['cuenta_almacen'] ?></h2>
<div class='view'>
<?php
echo "<dl>";
echo "  <dt>Nº de linea </dt>\n";
echo "<dd>";
echo $almacentransportes['Transporte']['linea'].'&nbsp;';
echo "</dd>";
echo "  <dt>Nombre del transporte </dt>\n";
echo "<dd>";
echo $this->html->link(
    $almacentransportes['Transporte']['nombre_vehiculo'],
    array(
	'controller' => 'transportes',
	'action' => 'view',
	$almacentransportes['AlmacenTransporte']['transporte_id']
    )
).'&nbsp;';
echo "</dd>";
if(!empty($almacentransportes['Transporte']['matricula'])){
	echo "<dt>BL/Matrícula </dt>\n";
	echo "<dd>";
	echo $this->html->link(
	    $almacentransportes['Transporte']['matricula'],
	    array(
		'controller' => 'transportes',
		'action' => 'view',
		$almacentransportes['AlmacenTransporte']['transporte_id']
	    )
	).'&nbsp;';
	echo "</dd>";
}
echo "  <dt>Almacén</dt>\n";
echo "  <dd>".$almacentransportes['Almacen']['nombre_corto'].'&nbsp;'."</dd>";
echo "  <dt>Cantidad</dt>\n";
echo "  <dd>".$almacentransportes['AlmacenTransporte']['cantidad_cuenta'].'&nbsp;'."</dd>";
echo "  <dt>Peso bruto</dt>\n";
echo "  <dd>".$almacentransportes['AlmacenTransporte']['peso_bruto'].'&nbsp;'."</dd>";

echo "</dl>";
?>	
	<div class="detallado">
	<h3>Distribución asociados</h3>
	<table class='tr2 tr3 tr4 tr5 tr6'>
<?php
$total_asignacion_teorica=0;
$total_asignacion_real=0;
$total_pendiente = 0;
$total_porcentaje_teorico = 0;
$total_porcentaje_real = 0;

	foreach ($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte) {
		$total_asignacion_real= $total_asignacion_real + $almacentransporte['sacos_asignados'];
	}

echo $this->Html->tableHeaders(
    array(
	'Asociado',
	'Asignación teórica',
	'Asignación real',
	'Pendiente',
	'% teorico','% real'
    )
);

foreach($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte){
    $pendiente = !empty($almacentransporte['Asociado']['Retirada'])? $almacentransporte['sacos_asignados']-$almacentransporte['Asociado']['Retirada'][0]['total_retirada_asociado']: $almacentransporte['sacos_asignados'];
    $sacos_asignados = !empty($almacentransporte['sacos_asignados']) ? $this->Number->round($almacentransporte['sacos_asignados']*100/$total_asignacion_real ,2) : 'Sin asignar';
    echo $this->Html->tableCells(
	array(
	$almacentransporte['Asociado']['Empresa']['nombre_corto'],
	$almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'],
	$almacentransporte['sacos_asignados'],
	$pendiente,
	$this->Number->round($almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'],2),			
	$sacos_asignados
	//$this->Number->round($almacentransporte['sacos_asignados']*100/$total_asignacion_real ,2)
	)
    );
    //Saco los datos de los totales de la tabla
    $total_asignacion_teorica = $total_asignacion_teorica + $almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'];
    $total_pendiente = $total_pendiente + $pendiente;
    $total_porcentaje_teorico = $total_porcentaje_teorico + $almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'];
    if ($almacentransporte['sacos_asignados'] != 0){
   	 	$total_porcentaje_real = $total_porcentaje_real + $almacentransporte['sacos_asignados']*100/$total_asignacion_real;
   	}
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
	    $total_asignacion_real,
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
	    $total_porcentaje_real.'%',
	    array(
		'style' => 'font-weight: bold;',
		'bgcolor' => '#5FCF80'
	    )
	)
    ))
);
?>
	</table>
	<?php
	if($total_asignacion_teorica !=$total_asignacion_real){
		$total_asignacion_teorica -=$total_asignacion_real;
		if ($total_asignacion_teorica > 0){
			echo "<h4>Cantidad de sacos sin adjudicar: ". $total_asignacion_teorica;
		}else{
			echo "<h4><span style=color:#c43c35;>Cantidad sacos asignados superior cuenta: ". $total_asignacion_teorica."</span>";
		}
	}
	?>	
	</h4>
	</div>
    </div>
</div>