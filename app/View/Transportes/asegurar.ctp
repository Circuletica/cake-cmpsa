<?php
    $this->layout = 'trafico';
  /*if(empty($transporte['Aseguradora']['nombre'])){
	echo '<h1>Faltan campos del seguro por rellenar para generar la carta</h1>';
}else{*/
?>
	<div style="margin-left: 435px;">
	<br>
	<b><?php echo $transporte['Aseguradora']['nombre'] ?></b>
<br><br>
	Madrid, <?php echo $dia.' de '. $mes.' del '.$ano?>
	</div>
	<br><br><br>
<?php echo '<h1>Solicitamos asegurar Ref.: '.$transporte['Operacion']['referencia'].' '.'('.$num.'ª parte)</h1>'?>
<br><br>
Muy Sres. nuestros:<br>
<br>
Les escribimos para solicitarles asegurar los siguiente:<br><br>
<?php
echo "<dl>";
echo "  <dt>Nuestra ref. operación</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['referencia'];
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $transporte['Operacion']['Contrato']['Calidad']['nombre'];
echo "</dd>";
echo "  <dt>Puerto de carga</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['telefono'].'&nbsp;';
echo "</dd>";
echo "  <dt>Puerto de destino</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['cif'].'&nbsp;';
echo "</dd>";
echo "  <dt>Naviera</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['cif'].'&nbsp;';
echo "</dd>";
echo "  <dt>Nombre vehículo</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['nombre_vehículo'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['bic'].'&nbsp;';
echo "</dd>";

echo $this->Html->tableCells(array(
	'Cantidad de sacos',
	'Tonelada métrica',
	'€/Kg',
	'Fecha de carga'
	)
);
echo 'Sin otro particular, les saludamos atentamente.';
//}
?>
