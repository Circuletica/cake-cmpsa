<?php $this->Html->addCrumb('Contratos', array(
	'controller'=>'contratos',
	'action'=>'index'
	));
	$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'], array(
	'controller'=>'contratos',
	'action'=>'view',
	$contrato['Contrato']['id']
));
?>
<h2>Detalles Contrato <?php echo $contrato['Contrato']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>
<div class="acciones">
<?php
	echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
		'action'=>'edit',
		$contrato['Contrato']['id']),array('title'=>'Modificar Contrato','escape'=>false))
	.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
		'action'=>'delete',
		$contrato['Contrato']['id']),array(
		'escape'=>false, 'title'=> 'Borrar',
		'confirm'=>'¿Realmente quiere borrar el contrato '.$contrato['Contrato']['referencia'].'?')
	);
?>
</div>
	<div class='view'>
	<?php
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "  <dd>".$contrato['Contrato']['id'].'&nbsp;'."</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "  <dd>".$contrato['Contrato']['referencia'].'&nbsp;'."</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "  <dd>".$contrato['CalidadNombre']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Incoterms</dt>\n";
	echo "  <dd>".$contrato['Incoterm']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Bolsa de Londres</dt>\n";
	echo "  <dd>".$contrato['Contrato']['si_londres'].'&nbsp;'."</dd>";
	echo "  <dt>Diferencial</dt>\n";
	echo "  <dd>".$contrato['Contrato']['diferencial'].'&nbsp;'."</dd>";
	echo "  <dt>Opciones</dt>\n";
	echo "  <dd>".$contrato['Contrato']['opciones'].'&nbsp;'."</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->Html->link($contrato['Proveedor']['Empresa']['nombre'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$contrato['Proveedor']['id'])
	);
	echo "</dd>";
	echo "</dl>";?>
	<div class="detallado">
	<h3>Lotes</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Id', 'Fecha fijación', 'Precio fijación', 'Acciones'));
	foreach($contrato['Lote'] as $lote):
		echo $this->Html->tableCells(array(
			$lote['id'],
			$lote['fecha_pos_fijacion'],
			$lote['precio_fijacion'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'lotes',
				'action' => 'view',
				$lote['id'],
              			'from_controller'=>'contratos',
              			'from_id'=>$lote['contrato_id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'lotes',
					'action' => 'delete',
					$lote['id'],
					'from_controller' => 'contratos',
					'from_id' => $lote['contrato_id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$lote['id'].'?')
				)
			));
	endforeach;
?>	</table>
		<div class="btabla">
		<?php
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir',array(
		'controller' => 'lotes',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_id' => $contrato['Contrato']['id']),
		 array('escape' => false,'title'=>'Añadir lote'));
		?>
		</div>
	</div>
</div>

