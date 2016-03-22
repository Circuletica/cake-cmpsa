<?php
    $this->layout = 'trafico';
  /*if(empty($transporte['Aseguradora']['nombre'])){
	echo '<h1>Faltan campos del seguro por rellenar para generar la carta</h1>';
}else{*/
?>
	<div style="margin-left: 450px;">
	<br>
	<b><?php echo $transporte['Aseguradora']['nombre'] ?></b>
<br><br>
	Madrid, <?php echo $dia.' de '. $mes.' del '.$ano?>
	</div>
	<br><br><br>
<?php echo '<h2>Solicitamos asegurar Ref.: '.$transporte['Operacion']['referencia'].' '.'('.$transporte['Transporte']['linea'].'ª parte)</h2>'?>
<br><br>
Muy Sres. nuestros,<br>
<br>
Les escribimos para solicitarles asegurar lo siguiente:<br><br>
<?php
echo "<dl>";
echo "  <dt>Ref. operación</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['referencia'];
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['Contrato']['CalidadNombre']['nombre'];
echo "</dd>";
echo "  <dt>Puerto de carga</dt>\n";
echo "<dd>";
echo $transporte['PuertoCarga']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Puerto de destino</dt>\n";
echo "<dd>";
echo $transporte['PuertoDestino']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Naviera</dt>\n";
echo "<dd>";
echo $transporte['Naviera']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Nombre vehículo</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['nombre_vehiculo'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['Contrato']['Proveedor']['nombre'].'&nbsp;';
echo "</dd>";
echo '<br><table>';
echo $this->Html->tableHeaders(array(
	'Cantidad de sacos',
	'Tonelada métrica',
	'BL/Matrícula',
	'€/Kg',
	'Fecha de carga'
	)
);
	echo $this->Html->tableCells(array(
		$transporte['Transporte']['cantidad_embalaje'],
		$transporte['Transporte']['cantidad_embalaje']*$transporte['Operacion']['Embalaje']['peso_embalaje'],
		$transporte['Transporte']['matricula'],
		number_format($transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'], 4, ',', '.'),
		 $this->Date->format($transporte['Transporte']['fecha_carga']),
		)

	);

echo '</table><br>';
echo 'Sin otro particular, les saludamos atentamente.';
//}
?>