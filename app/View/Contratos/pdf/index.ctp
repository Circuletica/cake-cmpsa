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
		'Referencia',
		'Proveedor',
		'Incoterm',
		'Calidad',
		'Peso',
		'Bolsa',
		'Lotes',
		'Posición'
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
			$contrato['Calidad']['nombre'],
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

