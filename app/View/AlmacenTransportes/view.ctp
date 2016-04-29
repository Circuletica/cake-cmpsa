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
			$this->Button->edit('almacentransportes',$almacentransportes['AlmacenTransporte']['id'])
			.' '.
			$this->Button->delete('almacentransportes',$almacentransportes['AlmacenTransporte']['id'],'la cuenta de almacén '.$almacentransportes['AlmacenTransporte']['cuenta_almacen']);
			
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

	<table>
<?php
	echo $this->Html->tableHeaders(array('Asociado','Asignados', 'Pendientes','Porcentaje'));
	//	echo $this->Html->tableCells(array(
	//		$almacentransporte['AsociadoOperacion']['Asociado']['nombre_corto']));
	
?>	</table>
	<div class='btabla'>
	<?php
		echo $this->Html->link(('<i class="fa fa-users" aria-hidden="true" fa-lg></i> Cambiar distribución'),
	 	array(
	 		'controller' => 'transportes',
	 		'action' => 'view',
	 		$almacentransportes['AlmacenTransporte']['transporte_id']
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
