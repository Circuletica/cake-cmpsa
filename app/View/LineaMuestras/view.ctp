<?php $this->Html->addCrumb('Muestras', array(
	'controller'=>'muestras',
	'action'=>'index'
	));
	$this->Html->addCrumb('Muestra '.$linea['Muestra']['referencia'], array(
	'controller'=>'muestras',
	'action'=>'view',
	$linea['Muestra']['id']
));
?>
<?php
	echo "<div class='actions'>\n";
	echo $this->Html->link('Modificar',array(
		'action'=>'edit',
		$linea['LineaMuestra']['id'])
	);
	echo "\n";
	echo '<p>';
	echo $this->Form->postLink('Borrar',array(
		'action'=>'delete',
		$linea['LineaMuestra']['id']),
		array('confirm'=>'Realmente quiere borrar '.$linea['LineaMuestra']['marca'].'?')
	);
	echo "\n";
	echo "</div>\n";
?>
<div class="index">
<h2>Detalles Línea <?php echo $linea['LineaMuestra']['marca']?> de muestra <?php echo $linea['Muestra']['referencia']?></h2>
</div>
<?php
	echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Marca</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['marca'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Núm. de sacos</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['numero_sacos'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Ref. Proveedor</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['referencia_proveedor'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Referencia Almacen</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['referencia_almacen'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Humedad</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['humedad'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>tueste</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['tueste'];
	echo "</dd>";
	echo "  <dt>Defecto</dt>\n";
	echo "<dd>";
	echo nl2br(h($linea['LineaMuestra']['defecto'])).'&nbsp;';
	echo "</dd>";
	echo "  <dt>Apreciación</dt>\n";
	echo "<dd>";
	echo nl2br(h($linea['LineaMuestra']['apreciacion_bebida'])).'&nbsp;';
	echo "</dd>";
	//Tabla de criba medida y ponderada (con los caracoles)
	//Antes de todo, necesitamos saber que criba corresponde al fondo.
	for ($i=12; (!$linea['LineaMuestra']['criba'.$i] || $linea['LineaMuestra']['criba'.$i] == 0) && $i <= 19; $i++){
		$fondo = $i;
	}
	$fondo++;
	//echo "fondo: ".$fondo;
	echo "  <dt>Criba</dt>\n";
	echo "<dd>";
	echo "<table>";
	echo $this->Html->tableHeaders(array('&nbsp;', 'Medida original', 'Medida ponderada'));
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba20'] || $linea['CribaPonderada']['criba20']) {
		echo $this->Html->tableCells(array(
			$fondo == 20 ? 'Fondo' : 'Criba 20',
			+$linea['LineaMuestra']['criba20'],
			+$linea['CribaPonderada']['criba20']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba19'] || $linea['CribaPonderada']['criba19']) {
		echo $this->Html->tableCells(array(
			$fondo == 19 ? 'Fondo' : 'Criba 19',
			+$linea['LineaMuestra']['criba19'],
			+$linea['CribaPonderada']['criba19']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba13p'] && $linea['LineaMuestra']['criba13p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 13', +$linea['LineaMuestra']['criba13p'], '&nbsp;'));
	}
	//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
	if (($linea['LineaMuestra']['criba18'] && $linea['LineaMuestra']['criba18'] != 0) || ($linea['CribaPonderada']['criba18'] && $linea['CribaPonderada']['criba18'] != 0)) {
		echo $this->Html->tableCells(array(
			$fondo == 18 ? 'Fondo' : 'Criba 18',
			+$linea['LineaMuestra']['criba18'],
			+$linea['CribaPonderada']['criba18']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba12p'] && $linea['LineaMuestra']['criba12p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 12', +$linea['LineaMuestra']['criba12p'], '&nbsp;'));
	}
	if (($linea['LineaMuestra']['criba17'] && $linea['LineaMuestra']['criba17'] != 0) || ($linea['CribaPonderada']['criba17'] && $linea['CribaPonderada']['criba17'] != 0)) {
		echo $this->Html->tableCells(array(
			$fondo == 17 ? 'Fondo' : 'Criba 17',
			+$linea['LineaMuestra']['criba17'],
			+$linea['CribaPonderada']['criba17'])
		);
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba11p'] && $linea['LineaMuestra']['criba11p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 11', +$linea['LineaMuestra']['criba11p'], '&nbsp;'));
	}
	//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
	if (($linea['LineaMuestra']['criba16'] && $linea['LineaMuestra']['criba16'] != 0) || ($linea['CribaPonderada']['criba16'] && $linea['CribaPonderada']['criba16'] != 0)) {
		echo $this->Html->tableCells(array(
			$fondo == 16 ? 'Fondo' : 'Criba 16',
			+$linea['LineaMuestra']['criba16'],
			+$linea['CribaPonderada']['criba16']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba10p'] && $linea['LineaMuestra']['criba10p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 10', +$linea['LineaMuestra']['criba10p'], '&nbsp;'));
	}
	//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
	if (($linea['LineaMuestra']['criba15'] && $linea['LineaMuestra']['criba15'] != 0) || ($linea['CribaPonderada']['criba15'] && $linea['CribaPonderada']['criba15'] != 0)) {
	echo $this->Html->tableCells(array(
		$fondo == 15 ? 'Fondo' : 'Criba 15',
		+$linea['LineaMuestra']['criba15'],
		+$linea['CribaPonderada']['criba15']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba9p'] && $linea['LineaMuestra']['criba9p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 9', +$linea['LineaMuestra']['criba9p'], '&nbsp;'));
	}
	//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
	if (($linea['LineaMuestra']['criba14'] && $linea['LineaMuestra']['criba14'] != 0) || ($linea['CribaPonderada']['criba14'] && $linea['CribaPonderada']['criba14'] != 0)) {
	echo $this->Html->tableCells(array(
		$fondo == 14 ? 'Fondo' : 'Criba 14',
		+$linea['LineaMuestra']['criba14'],
		+$linea['CribaPonderada']['criba14']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba8p'] && $linea['LineaMuestra']['criba8p'] != 0) {
		echo $this->Html->tableCells(array('Caracol 8', +$linea['LineaMuestra']['criba8p'], '&nbsp;'));
	}
	//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
	if (($linea['LineaMuestra']['criba13'] && $linea['LineaMuestra']['criba13'] != 0) || ($linea['CribaPonderada']['criba13'] && $linea['CribaPonderada']['criba13'] != 0)) {
	echo $this->Html->tableCells(array(
		$fondo == 13 ? 'Fondo' : 'Criba 13',
		+$linea['LineaMuestra']['criba13'],
		+$linea['CribaPonderada']['criba13']));
	}
	//solo mostramos la línea si tiene algún valor
	if ($linea['LineaMuestra']['criba12'] || $linea['CribaPonderada']['criba12']) {
	echo $this->Html->tableCells(array(
		$fondo == 12 ? 'Fondo' : 'Criba 12',
		+$linea['LineaMuestra']['criba12'],
		+$linea['CribaPonderada']['criba12']));
	}
	echo $this->Html->tableCells(array(
		'Total',
		array($suma_linea."%",array('class' => 'total')),
		array($suma_ponderada."%",array('class' => 'total'))
		));
	echo "</table>"."&nbsp;";
	echo "<dt>Criba Media</dt>";
	echo "<dd>".$linea['CribaPonderada']['criba_media']."</dd>";
	echo "</dd>";
	echo "</dl>";
	echo "</div>";
?>
