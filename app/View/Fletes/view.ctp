<?php $this->Html->addCrumb('Fletes', array(
	'controller'=>'fletes',
	'action'=>'index'
	));
?>
<h2>Costes Flete <?php echo $flete['Flete']['id']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>
<div class="acciones">
<?php
//	echo
//	$this->Html->link(
//		'<i class="fa fa-pencil-square-o"></i> Modificar',
//		array(
//			'action'=>'edit',
//			$flete['Flete']['id']),
//		array(
//			'title'=>'Modificar Flete',
//			'escape'=>false
//		)
//	).' '.
//	$this->Form->postLink(
//		'<i class="fa fa-trash"></i> Borrar',
//		array(
//			'action'=>'delete',
//			$flete['Flete']['id'],
//			'from_controller' => 'fletes',
//			'from_id' => $flete['Flete']['id']
//		),
//		array(
//			'escape'=>false,
//			'title'=> 'Borrar',
//			'confirm'=>'¿Realmente quiere borrar el flete '.$flete['Flete']['id'].'?'
//		)
//	);
?>
</div>
<div class='view'>
	<?php
		//la tabla con los costes de flete
		echo "<table>";
	echo $this->Html->tableHeaders(array(
		'válido desde','válido hasta','coste contenedor','coste $/Tm'));
		foreach ($costes as $coste):
			echo $this->Html->tableCells(array(
				$coste['PrecioFlete']['fecha_inicio'],
				$coste['PrecioFlete']['fecha_fin'],
				$coste['PrecioFlete']['coste_contenedor_dolar'],
				$coste['PrecioFlete']['coste_contenedor_dolar']
				)
			);
		endforeach;
		echo "</table>";
?>
