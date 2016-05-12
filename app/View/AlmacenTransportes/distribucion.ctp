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
<div class='content'>
<?php
	echo "<dl>";
		echo "  <dt>Nº de linea </dt>\n";
		echo "<dd>";
		echo $this->html->link($almacentransportes['Transporte']['linea'], array(
		    'controller' => 'operaciones',
		    'action' => 'view',
		    $almacentransportes['AlmacenTransporte']['transporte_id']
		)
			).'&nbsp;';
		echo "</dd>";

		echo "  <dt>Nombre del transporte </dt>\n";
		echo "<dd>";
		echo $this->html->link($almacentransportes['Transporte']['nombre_vehiculo'], array(
		    'controller' => 'transportes',
		    'action' => 'view',
		    $almacentransportes['AlmacenTransporte']['transporte_id']
		)
			).'&nbsp;';
		echo "</dd>";

		echo "  <dt>BL/Matrícula </dt>\n";
		echo "<dd>";
		echo $this->html->link($almacentransportes['Transporte']['matricula'], array(
		    'controller' => 'transportes',
		    'action' => 'view',
		    $almacentransportes['AlmacenTransporte']['transporte_id']
		    )
			).'&nbsp;';
		echo "</dd>";
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

	<table>
<?php
	echo $this->Html->tableHeaders(array('Asociado','Asignado Teorico', 'Asignados Real','Pendiente','% teorico', '% real'));

	foreach($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte){
		echo $this->Html->tableCells(array(
			$almacentransporte['Asociado']['Empresa']['nombre_corto'],
			$almacentransporte['sacos_asignados'],
			$this->Form->input('CantidadAsociado.'.$almacentransporte['asociado_id'], array(
			    'label' => '',
			    'class' => 'cantidad',
			    'id' => $almacentransporte['asociado_id'],
			    'oninput' => 'sacosAsignados()'
			    ),
				array(
					'style'=>'text-align:right')
			),
			!empty($almacentransporte['Asociado']['Retirada'])? $almacentransporte['sacos_asignados']-$almacentransporte['Asociado']['Retirada'][0]['total_retirada_asociado']: $almacentransporte['sacos_asignados'],
			$this->Number->round($almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'],2),
			'<div id=porcentajeAsociado'.$almacentransporte['asociado_id'].'>'." %".'</div>',
			)
		);
	}
?>	</table>
	<div class='btabla'>
	<?php
		echo $this->Html->link(('<i class="fa fa-users" aria-hidden="true" fa-lg></i> Cambiar distribución'),
	 	array(
	 		'controller' => 'almacen_transportes',
	 		'action' => 'distribucion',
	 		$almacentransportes['AlmacenTransporte']['id']
	 		), 
	 	array(
			'class' => 'boton',
			'title' => 'Cambiar distribución sacos asociados',
			'escape' => false
			)
	 	);
	?>
	</div>
	</div>
</div>
<script type="text/javascript">
window.onload = sacosAsignados();
</script>


