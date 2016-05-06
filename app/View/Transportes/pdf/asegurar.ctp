<?php
    $this->layout = 'trafico';
  /*if(empty($transporte['Aseguradora']['nombre'])){
	echo '<h1>Faltan campos del seguro por rellenar para generar la carta</h1>';
}else{*/
?>
	<div style="margin-left: 390px;">
	<br>
	<b><?php echo $transporte['Aseguradora']['nombre'] ?></b>
<br><br>
	Madrid, <?php echo $dia.' de '. $mes.' del '.$ano?>
	</div>
	<br><br>
<?php echo '<h2>Solicitamos asegurar Ref.: '.$transporte['Operacion']['referencia'].' '.'('.$transporte['Transporte']['linea'].'ª parte)</h2>'?>
<br>
Muy Sres. nuestros,
<br><br>
Les escribimos para solicitarles asegurar lo siguiente:<br><br>
<?php
echo "<dl>";
echo "  <dt>Ref. operación</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['referencia'];
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['Contrato']['Calidad']['nombre'];
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
	'Kilogramos totales',
	'BL/Matrícula',
	'€/Kg',
	'Fecha de carga'
	)
);
	echo $this->Html->tableCells(array(
		array(
			array(
				$transporte['Transporte']['cantidad_embalaje'],
				array(
					'style' => 'text-align:center'
					)
				),
		array(
			$transporte['Transporte']['cantidad_embalaje']*$transporte['Operacion']['Embalaje']['peso_embalaje'],
			array('style' => 'text-align:center'
				)
			),
		array(
		$transporte['Transporte']['matricula'],
				array('style' => 'text-align:center'
				)
			),
		array(
		number_format($transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'], 4, ',', '.'),
		array('style' => 'text-align:center'
				)		
		),
		array(
		 $this->Date->format($transporte['Transporte']['fecha_carga']),
		 		array('style' => 'text-align:center'
				)
				)
				)
		)
	);

echo '</table><br>';
echo 'Sin otro particular, les saludamos atentamente.';
//}
?>
