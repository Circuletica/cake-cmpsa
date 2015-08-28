<?php
$this->extend('/Common/view');
$this->assign('titulo', 'Flete '.$referencia);
$this->assign('id',$flete['Flete']['id']);
$this->assign('clase','Flete');
$this->assign('controller','fletes');
$this->Html->addCrumb('Fletes', array(
	'controller'=>'fletes',
	'action'=>'index'
));
$this->start('filtro');
?>
<div class="actions">
	<?php echo $this->element('filtroflete'); ?>
</div>
<?php $this->end()?>
<div class='view'>
	<?php
		echo "<dl>";
		echo "  <dt>Naviera:</dt>\n";
		echo "  <dd>".$flete['Naviera']['Empresa']['nombre_corto'].'&nbsp;'."</dd>";
		echo "  <dt>Puerto de Carga:</dt>\n";
		echo "  <dd>".$flete['PuertoCarga']['nombre']
			.' ('.$flete['PuertoCarga']['Pais']['nombre'].')'
			.'&nbsp;'."</dd>";
		echo "  <dt>Puerto de Destino:</dt>\n";
		echo "  <dd>".$flete['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
		echo "  <dt>Tipo embalajes:</dt>\n";
		echo "  <dd>".$flete['Embalaje']['nombre'].'&nbsp;'."</dd>";
		echo "  <dt>Peso contenedor:</dt>\n";
		echo "  <dd>".$flete['Flete']['peso_contenedor_tm'].'Tm&nbsp;'."</dd>";
		echo "</dl>";
		//la tabla con los costes de flete
		echo "<table>";
			echo $this->Html->tableHeaders(array(
				'válido desde','válido hasta','coste contenedor','coste $/Tm', ''));
			foreach ($costes as $coste):
				$fecha_inicio = $this->Date->format($coste['PrecioFleteTonelada']['fecha_inicio']);
				$fecha_fin = $this->Date->format($coste['PrecioFleteTonelada']['fecha_fin']);
				echo $this->Html->tableCells(array(
					$fecha_inicio,
					$fecha_fin,
					$coste['PrecioFleteTonelada']['coste_contenedor_dolar'],
					$coste['PrecioFleteTonelada']['precio_dolar'],
					$this->Html->link(
						'<i class="fa fa-pencil-square-o"></i>',
						array(
							'controller'=>'precio_fletes',
							'action' => 'edit',
							$coste['PrecioFleteTonelada']['id'],
							'from'=>'fletes',
							'from_id'=>$coste['PrecioFleteTonelada']['flete_id']
						),
						array(
							'class'=>'botond',
							'escape'=>false,
							'title'=>'Modificar'
						)
					).
					$this->Form->postLink(
						'<i class="fa fa-trash"></i>',
						array(
							'controller'=>'precio_fletes',
							'action' => 'delete',
							$coste['PrecioFleteTonelada']['id'],
							'from'=>'fletes',
							'from_id'=>$coste['PrecioFleteTonelada']['flete_id']
						),
						array(
							'class'=>'botond',
							'escape'=>false,
							'title'=>'Borrar',
							'confirm' =>'¿Realmente quiere borrar el coste '.$coste['PrecioFleteTonelada']['id'].'?'
						)
					)
				)
			);
			endforeach;
		echo "</table>";
?>
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-user-plus"></i> Añadir precio',array(
		'controller'=>'precio_fletes',
		'action'=>'add',
		'from'=>'fletes',
		'from_id' => $flete['Flete']['id']), array('escape' => false,'title'=>'Añadir precio'));?>
	</div>
</div>
