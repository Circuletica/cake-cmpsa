<h2>Operaciones</h2>
	<div class='index'>
	<?php
	if (empty($operaciones)):
		echo "No hay operaciones en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Operacion.referencia','Referencia'),
		$this->Paginator->sort('Contrato.referencia','Contrato'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('Calidad.nombre','Calidad'),
		$this->Paginator->sort('PesoOperacion.peso','Peso'),
		$this->Paginator->sort('Operacion.lotes_operacion','Lotes')
		)
	);

	foreach($operaciones as $operacion):
		echo $this->Html->tableCells(array(
			$operacion['Operacion']['referencia'],
			$operacion['Contrato']['referencia'],
			$operacion['Proveedor']['nombre_corto'],
			$operacion['Calidad']['nombre'],
			$operacion['PesoOperacion']['peso'].'kg',
			$operacion['Operacion']['lotes_operacion']
	));

	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
	<?php endif; ?>
</div>
