<h2>Almacenes</h2>
	<?php
	if (empty($empresas)):
		echo "No hay almacenes en esta lista";
	else:
	//echo "<pre>";
	//print_r($bancopruebas);
	////print_r($bancopruebas['Empresa']['nombre']);
	//echo "</pre>";

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		//'Id',
		$this->Paginator->sort('Empresa.nombre','Almacén'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono'));

	foreach($empresas as $empresa):
	echo $this->Html->tableCells(array(
		//$empresa['Almacen']['id'],
		$empresa['Empresa']['nombre'],
		$empresa['Empresa']['codigo_contable'],
		$empresa['Pais']['nombre'],
		$empresa['Empresa']['telefono']
		)
	);
	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
<?php endif; ?>

