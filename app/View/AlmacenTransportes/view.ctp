<?php 
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
?>
<div class="acciones">
	<div class="printdet">
	<ul>
		<li>
			 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
			 <?php // PARA VIEW
			 echo ' '.$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
			 	array(
			 		'action' => 'view',
			 		$id,
			 		'ext' => 'pdf',
			 		), 
			 	array(
			 		'escape'=>false,'target' => '_blank','title'=>'Exportar a PDF')).' '.
			 $this->Html->link('<i class="fa fa-envelope-o fa-lg"></i>', 'mailto:',array('escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'));
		 	?>
		</li>
		<li>
			<?php
			//Contempar si hay retirada ya o no de esto.
			echo !empty($almacentransportes['Retirada'])? '<i class="fa fa-hand-paper-o" aria-hidden="true" fa-lg ></i> Hay retiradas': 
			$this->Button->edit('almacen_transportes',$id)
			.' '.
			$this->Button->delete('almacen_transportes',$id,'la cuenta de almacén '.$almacentransportes['AlmacenTransporte']['cuenta_almacen']);
			
		?>
		</li>
	</ul>
	</div>
</div>
<h2>Cuenta corriente <?php echo $almacentransportes['AlmacenTransporte']['cuenta_almacen'] ?></h2>
<div class='view'>
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
	<table class='tr2 tr3 tr4 tr5 tr6'>
<?php
	$total_asignacion_teorica=0;
	$total_asignacion_real=0;
	$total_pendiente = 0;
	$total_porcentaje_teorico = 0;
	$total_porcentaje_real = 0;

	echo $this->Html->tableHeaders(array('Asociado','Asignación teórica', 'Asignación real','Pendiente','% teorico', '% real'));

	foreach($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte){
		$pendiente = !empty($almacentransporte['Asociado']['Retirada'])? $almacentransporte['sacos_asignados']-$almacentransporte['Asociado']['Retirada'][0]['total_retirada_asociado']: $almacentransporte['sacos_asignados'];

		echo $this->Html->tableCells(array(
			$almacentransporte['Asociado']['Empresa']['nombre_corto'],
			$almacentransporte['sacos_asignados'],
			$almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'],
			$pendiente,
			$this->Number->round($almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'],2),			
			$this->Number->round($almacentransporte['sacos_asignados']*100/$almacentransportes['AlmacenTransporte']['cantidad_cuenta'],2)
			)
		);
	$total_asignacion_teorica = $total_asignacion_teorica + $almacentransporte['sacos_asignados'];
	$total_asignacion_real = $total_asignacion_real + $almacentransporte['Asociado']['AlmacenReparto'][0]['sacos_asignados'];
	$total_pendiente = $total_pendiente + $pendiente;
	$total_porcentaje_teorico = $total_porcentaje_teorico + $almacentransporte['Asociado']['AlmacenReparto'][0]['porcentaje_embalaje_asociado'];
	$total_porcentaje_real = $total_porcentaje_real +$almacentransporte['sacos_asignados']*100/$almacentransportes['AlmacenTransporte']['cantidad_cuenta'];

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
	
?>	</table>
	<div class='btabla'>
	<?php
		echo $this->Html->link(('<i class="fa fa-users" aria-hidden="true" fa-lg></i> Cambiar distribución'),
	 	array(
	 		'controller' => 'almacen_transportes',
	 		'action' => 'distribucion',
	 		$id
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
