<?php 
	$this->Html->addCrumb('Operación '.$transporte['Operacion']['referencia'], array(
	'controller'=>'operaciones',
	'action'=>'view_trafico',
	$transporte['Operacion']['id']
	));
	$this->Html->addCrumb('Línea Transporte ', array(
	'controller' => 'transportes',
	'action' => 'add')
	);
?><div class="acciones">
	<div class="printdet">
	<ul><li>
		<?php 
		echo $this->element('imprimirV');
		?>	
		
	</li>
	<li>
			<?php
		echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
			'action'=>'edit',
			$transporte['Transporte']['id']),array('title'=>'Modificar Transporte','escape'=>false))
		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
			'action'=>'delete',
			$transporte['Transporte']['id']),array(
			'escape'=>false, 'title'=> 'Borrar Transporte',
			'confirm'=>'¿Realmente quiere borrar con BL/Matrícula '.$transporte['Transporte']['matricula'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>
<h2>Línea de Transporte: Operación <?php echo $transporte['Operacion']['referencia'] ?></h2>

<div class="actions">
	<?php
	echo $this->element('filtrooperacion');
	?>
</div>

	<div class='view'>
	<dl><?php
		echo "  <dt>Operación</dt>\n";
			echo "<dd>";
			echo $this->Html->link($transporte['Operacion']['referencia'], array(
			'controller' => 'operaciones',
			'action' => 'view_trafico',
			$transporte['Operacion']['id'])
			);
			echo "</dd>";
		echo "  <dt>Contrato</dt>\n";
			echo "<dd>";
			echo $this->Html->link($transporte['Operacion']['Contrato']['referencia'], array(
			'controller' => 'contratos',
			'action' => 'view',
			$transporte['Operacion']['Contrato']['id'])
			);
			echo "</dd>";
		echo "  <dt>Nombre del transporte</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['nombre_vehiculo'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>BL/Matrícula</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['matricula'].'&nbsp;';
		echo "</dd>";
				echo "  <dt>Puerto destino</dt>\n";
		echo "<dd>";
		echo $this->Html->link( $transporte['Puerto']['nombre'], array(
			'controller' => 'puertos',
			'action' => 'view',
			$transporte['Puerto']['id'])
		);
		echo "  <dt>Naviera</dt>\n";
		echo "<dd>";
		echo $this->Html->link($transporte['Naviera']['Empresa']['nombre'], array(
			'controller' => 'navieras',
			'action' => 'view',
			$transporte['Naviera']['id'])
		);
		echo "</dd>";
		echo "  <dt>Agente de aduanas</dt>\n";
		echo "<dd>";
		echo $this->Html->link($transporte['Agente']['Empresa']['nombre'], array(
			'controller' => 'agentes',
			'action' => 'view',
			$transporte['Agente']['id'])
		);
		echo "</dd>";
		echo "  <dt>Observaciones</dt>\n";
		echo "<dd>";
		echo $transporte['Transporte']['observaciones'].'&nbsp;';?>
		</dd>
	<br>
	<h3>Fechas</h3>
	<?php
		echo "  <dt>Carga mercancía</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_carga'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Fecha de llegada</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_llegada'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Pago</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_pago'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Envío documentación</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_enviodoc'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Entrada mercancía</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_entradamerc'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Despacho operación</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_despacho_op'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Vencimiento seguro</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_vencimiento_seg'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Fecha de reclamación</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_reclamacion'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Límite de retirada</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_limite_retirada'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Reclamación factura</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_reclamacion_factura'].'&nbsp;';
		echo "</dd>";

?>	</dl>
	<br>
	<h3>Seguro</h3>
	<dl><?php
		echo "  <dt>Aseguradora</dt>\n";
		echo "<dd>";
			echo $transporte['Aseguradora']['Empresa']['nombre_corto'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Fecha del seguro</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['fecha_seguro'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Precio del seguro</dt>\n";
		echo "<dd>";
		echo $transporte['Transporte']['fecha_seguro'].'&nbsp;';
		echo "</dd>";
	?>		
</dl>
	<div class="detallado">

	<h3>Almacenes</h3>

	<table>
<?php
	echo $this->Html->tableHeaders(array('Cuenta Corriente/Referencia','Nombre', 'Cantidad', 'Marca','Acciones'));
	foreach($transporte['AlmacenesTransporte'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['cuenta_almacen'],
			$linea['almacen_id'],
			$linea['cantidad_cuenta'],
			$linea['MarcaAlmacen']['nombre'],			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i> Detalles', array(
				'controller'=>'almacenes_transportes',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'almacenestransportes',
              			'from_id'=>$transporte['Transporte']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'operaciones',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'operaciones',
					'from_id'=>$transporte['Transporte']['id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$transporte['Transporte']['referencia'].'?')
				)
			));
	endforeach;?>
	</table>
	<div class="btabla">
		<?php
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Cuenta Corriente',array(
		'controller' => 'almacenes_transportes',
		'action' => 'add',
		'from_controller' => 'trasportes',
		'from_id' => $transporte['Transporte']['id']),
		 array('escape' => false,'title'=>'Añadir cuenta corriente almacén'));
		?>
	</div>
	</div>
	
</div>