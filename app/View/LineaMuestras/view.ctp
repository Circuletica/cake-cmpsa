<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('titulo', 'Línea '.$linea['Muestra']['referencia'].' de la muestra '.$linea['Muestra']['referencia']);
$this->assign('id',$linea['LineaMuestra']['id']);
$this->assign('clase','LineaMuestra');
$this->assign('controller','linea_muestras');
$this->assign('from_controller','muestras');
$this->assign('from_id',$linea['Muestra']['id']);

$this->Html->addCrumb('Muestras', array(
    'controller'=>'muestras',
    'action'=>'index'
));
$this->Html->addCrumb('Muestra '.$linea['Muestra']['referencia'], array(
    'controller'=>'muestras',
    'action'=>'view',
    $linea['Muestra']['id']
));
$this->start('filter');
echo $this->element('filtromuestra');
$this->end();

$this->start('main');
echo "<dl>\n";
echo "  <dt>Ref. Proveedor</dt><dd>".$linea['LineaMuestra']['referencia_proveedor']."</dd>\n";
echo "  <dt>Referencia Almacen</dt><dd>".$linea['LineaMuestra']['referencia_almacen']."</dd>\n";
echo "  <dt>Marca</dt><dd>".$linea['LineaMuestra']['marca']."&nbsp;</dd>\n";
echo "  <dt>Núm. de sacos</dt><dd>".$linea['LineaMuestra']['numero_sacos']."&nbsp;</dd>\n";
echo "  <dt>Humedad</dt><dd>".$linea['LineaMuestra']['humedad']."&nbsp;</dd>\n";
echo "  <dt>Defectos</dt><dd>".nl2br(h($linea['LineaMuestra']['defecto']))."&nbsp;</dd>\n";
echo "  <dt>Tueste</dt><dd>".$linea['LineaMuestra']['tueste']."&nbsp;</dd>\n";
echo "  <dt>Bebida</dt><dd>".nl2br(h($linea['LineaMuestra']['apreciacion_bebida']))."&nbsp;</dd>\n";
//Tabla de criba medida y ponderada (con los caracoles)
//Antes de todo, necesitamos saber que criba corresponde al fondo.
for ($i=12; (!$linea['LineaMuestra']['criba'.$i] || $linea['LineaMuestra']['criba'.$i] == 0) && $i <= 19; $i++){
    $fondo = $i;
}
$fondo++;
$this->end();

$this->start('lines');
echo "<div class='cribai'>\n";
echo "<table>\n";
echo $this->Html->tableHeaders(array('Criba', 'Medida original', 'Medida ponderada'));
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
echo "</table>\n";
echo "</div>\n";
echo 'Criba Media '.$linea['CribaPonderada']['criba_media'];
$this->end()
?>
