<?php
	$this->Html->addCrumb('Fletes', array(
		'controller' => 'fletes',
		'action' => 'index')
	); ?>
	<h2>Fletes</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
		?>
	</div>
<div class='index'>
	<?php
	if (empty($fletes)):
		echo "No hay fletes en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Pais.nombre','País de origen'),
		$this->Paginator->sort('Empresa.nombre_corto','Naviera'),
		$this->Paginator->sort('PuertoCarga.nombre','Puerto de carga'),
		$this->Paginator->sort('PuertoDestino.nombre','Puerto de destino'),
		$this->Paginator->sort('Embalaje.nombre','Tipo embalaje'),
		$this->Paginator->sort('Flete.peso_contenedor_tm','Coste ($/Tm)'),
		$this->Paginator->sort('PrecioActualFlete.fecha_fin','válido hasta'),
		'')
	);

	foreach($fletes as $flete):
		echo $this->Html->tableCells(
			array(
				$flete['Pais']['nombre'],
				$flete['Empresa']['nombre_corto'],
				$flete['PuertoCarga']['nombre'],
				$flete['PuertoDestino']['nombre'],
				$flete['Embalaje']['nombre'],
				$flete['PrecioActualFlete']['precio_dolar'],
				$this->Date->format($flete['PrecioActualFlete']['fecha_fin']),
				$this->Html->link(
					'<i class="fa fa-info-circle"></i>',
					array(
						'action'=>'view',
						$flete['Flete']['id']),
					array(
						'class'=>'botond',
						'escape' => false,
						'title'=>'Detalles')
				)
			)
		);
	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>

	<div class="paging">
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled')); ?>
	</div>
	<?php endif; ?>
	<div class="btabla">
		<?php echo $this->Html->link('Añadir Flete',array('action'=>'add')); ?>
	</div>
</div>
