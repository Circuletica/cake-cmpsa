<?php
    echo "<h2>$title</h2>";
?>
	
	<div class='index'>
    <?php
	if (empty($contratos)):
		echo "No hay contratos en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Contrato.referencia','Referencia'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('Incoterm.nombre','Incoterm'),
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('Contrato.peso_comprado','Peso'),
		$this->Paginator->sort('CanalCompra.nombre','Bolsa'),
		$this->Paginator->sort('Contrato.lotes_contrato','Lotes'),
		$this->Paginator->sort('Contrato.posicion_bolsa','Posición')
		)
	);
	foreach($contratos as $contrato):
		//mysql almacena la fecha en formato ymd
		$fecha = $contrato['Contrato']['posicion_bolsa'];
		//sacamos el nombre del mes en castellano
		setlocale(LC_TIME, "es_ES.UTF-8");
		$mes = strftime("%B", strtotime($fecha));
		$anyo = substr($fecha,0,4);
		$posicion_bolsa = $mes.' '.$anyo;
		echo $this->Html->tableCells(array(
			$contrato['Contrato']['referencia'],
			$contrato['Proveedor']['nombre_corto'],
			$contrato['Incoterm']['nombre'],
			$contrato['CalidadNombre']['nombre'],
			$contrato['Contrato']['peso_comprado'].'kg',
			$contrato['CanalCompra']['nombre'],
			$contrato['Contrato']['lotes_contrato'],
			$posicion_bolsa
	));
	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
	<?php endif; ?>

</div>

