<h2>Fletes <?php echo $titulo;?></h2>
<div class='index'>
	<?php
	if (empty($fletes)):
		echo "No hay fletes en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Pais.nombre','País de origen'),
		$this->Paginator->sort('Naviera.nombre_corto','Naviera'),
		$this->Paginator->sort('PuertoCarga.nombre','Puerto de carga'),
		$this->Paginator->sort('PuertoDestino.nombre','Puerto de destino'),
		$this->Paginator->sort('Embalaje.nombre','Tipo embalaje'),
		$this->Paginator->sort('Flete.peso_contenedor_tm','Coste ($/Tm)'),
		$this->Paginator->sort('PrecioActualFlete.fecha_fin','válido hasta')
		)
	);

	foreach($fletes as $flete):
		echo $this->Html->tableCells(
			array(
				$flete['Pais']['nombre'],
				$flete['Naviera']['nombre_corto'],
				$flete['PuertoCarga']['nombre'],
				$flete['PuertoDestino']['nombre'],
				$flete['Embalaje']['nombre'],
				$flete['PrecioActualFlete']['precio_dolar'],
				$this->Date->format($flete['PrecioActualFlete']['fecha_fin'])
				)
			);
	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
	<?php endif; ?>
</div>
