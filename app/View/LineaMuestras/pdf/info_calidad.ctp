<?php
$this->layout = 'laboratorio';
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/pdf/viewPdf');
//$this->assign('object', 'Línea de la muestra '.$linea['Muestra']['tipo_registro']);
//$this->assign('id',$linea['LineaMuestra']['id']);
	$this->assign('class','LineaMuestra');
	$this->assign('controller','linea_muestras');
	$this->assign('from_controller','muestras');
	$this->assign('from_id',$linea['Muestra']['id']);

$this->start('main');
echo "<h3 style='text-align: center;'>DEPARTAMENTO DE CONTROL DE CALIDAD</h3>";
echo "<h3 style='text-align: center;'>INFORME DE CALIDAD Nº ".$linea['Muestra']['tipo_registro'].'</h3>';
echo "<hr><br>";

if(!empty($linea['LineaMuestra']['a'] or $linea['LineaMuestra']['atn'] or $linea['LineaMuestra']['ref'])){
echo "<dl>";
	echo "<dt>A: </dt><dd>".$linea['LineaMuestra']['a']."</dd>\n";
	echo "<dt>ATN: </dt><dd>".$linea['LineaMuestra']['atn']."</dd>\n";
	echo "<dt>REF: </dt><dd>".nl2br(h($linea['LineaMuestra']['ref']))."&nbsp;</dd>\n";
echo "</dl><br>";
}

echo "<dl>\n";
if ($linea['Muestra']['tipo_id'] != 1) {
	echo "  <dt>Descripción</dt><dd>".$linea['Muestra']['Calidad']['nombre']."&nbsp;</dd>\n"; //Calidad!!
	echo "  <dt>Sacos</dt><dd>".$linea['LineaMuestra']['sacos']."&nbsp;</dd>\n";
    if(empty($linea['AlmacenTransporte']['cuenta_almacen'])){
    	    echo "  <dt>Marca</dt><dd>".$linea['AlmacenTransporte']['marca_almacen']."&nbsp;</dd>\n";
    }elseif(empty($linea['AlmacenTransporte']['marca_almacen'])){
    	echo "  <dt>Ref. Almacén</dt><dd>".$linea['AlmacenTransporte']['cuenta_almacen']."&nbsp;</dd>\n";
    }else{
    	 echo "  <dt>Marca</dt><dd>".$linea['AlmacenTransporte']['marca_almacen']."&nbsp;</dd>\n";
    	 echo "  <dt>Ref. Almacén</dt><dd>".$linea['AlmacenTransporte']['cuenta_almacen']."&nbsp;</dd>\n";
    }
	echo "  <dt>Proveedor</dt><dd>".$linea['Muestra']['Proveedor']['nombre']."&nbsp;</dd>\n";
    echo "  <dt>Ficha/Operación</dt><dd>".$linea['Operacion']['referencia']."&nbsp;</dd>\n";
    echo "  <dt>Transporte</dt><dd>".$linea['Muestra']['Contrato']['transporte']."&nbsp;</dd>\n";


}
//Tabla de criba medida y ponderada (con los caracoles)
//Antes de todo, necesitamos saber que criba corresponde al fondo.
$fondo=11; //Se asigna en caso de que no haya criba que lo genere.
for ($i=12; (!$linea['LineaMuestra']['criba'.$i] || $linea['LineaMuestra']['criba'.$i] == 0) && $i <= 19; $i++){
    $fondo = $i;
}
$fondo++;
echo "<dt>Criba</dt>";
echo "<dl style=width:50%;margin-left:12%>\n";
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba20'] || $linea['CribaPonderada']['criba20']) {
	 echo "  <dt>".($fondo == 20 ? 'Fondo' : 'Criba 20')."</dt><dd>".+$linea['LineaMuestra']['criba20']."</dd>\n";
	}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba19'] || $linea['CribaPonderada']['criba19']) {
	echo "  <dt>".($fondo == 19 ? 'Fondo' : 'Criba 19')."</dt><dd>".+$linea['LineaMuestra']['criba19']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba13p'] && $linea['LineaMuestra']['criba13p'] != 0) {
    echo "  <dt>Caracol 13</dt><dd>".+$linea['LineaMuestra']['criba13p']."</dd>\n";
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba18'] && $linea['LineaMuestra']['criba18'] != 0) || ($linea['CribaPonderada']['criba18'] && $linea['CribaPonderada']['criba18'] != 0)) {
	echo "  <dt>".($fondo == 18 ? 'Fondo' : 'Criba 18')."</dt><dd>".+$linea['LineaMuestra']['criba18']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba12p'] && $linea['LineaMuestra']['criba12p'] != 0) {
  echo "  <dt>Caracol 12</dt><dd>".+$linea['LineaMuestra']['criba12p']."</dd>\n";
}
if (($linea['LineaMuestra']['criba17'] && $linea['LineaMuestra']['criba17'] != 0) || ($linea['CribaPonderada']['criba17'] && $linea['CribaPonderada']['criba17'] != 0)) {
	echo "  <dt>".($fondo == 17 ? 'Fondo' : 'Criba 17')."</dt><dd>".+$linea['LineaMuestra']['criba17']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba11p'] && $linea['LineaMuestra']['criba11p'] != 0) {
	echo "  <dt>Caracol 11</dt><dd>".+$linea['LineaMuestra']['criba11p']."</dd>\n";
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba16'] && $linea['LineaMuestra']['criba16'] != 0) || ($linea['CribaPonderada']['criba16'] && $linea['CribaPonderada']['criba16'] != 0)) {
	echo "  <dt>".($fondo == 16 ? 'Fondo' : 'Criba 16')."</dt><dd>".+$linea['LineaMuestra']['criba16']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba10p'] && $linea['LineaMuestra']['criba10p'] != 0) {
	echo "  <dt>Caracol 10</dt><dd>".+$linea['LineaMuestra']['criba10p']."</dd>\n";
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba15'] && $linea['LineaMuestra']['criba15'] != 0) || ($linea['CribaPonderada']['criba15'] && $linea['CribaPonderada']['criba15'] != 0)) {
   echo "  <dt>".($fondo == 15 ? 'Fondo' : 'Criba 15')."</dt><dd>".+$linea['LineaMuestra']['criba15']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba9p'] && $linea['LineaMuestra']['criba9p'] != 0) {
	echo "  <dt>Caracol 9</dt><dd>".+$linea['LineaMuestra']['criba9p']."</dd>\n";
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba14'] && $linea['LineaMuestra']['criba14'] != 0) || ($linea['CribaPonderada']['criba14'] && $linea['CribaPonderada']['criba14'] != 0)) {
	echo "  <dt>".($fondo == 14 ? 'Fondo' : 'Criba 14')."</dt><dd>".+$linea['LineaMuestra']['criba14']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba8p'] && $linea['LineaMuestra']['criba8p'] != 0) {
	echo "  <dt>Caracol 8</dt><dd>".+$linea['LineaMuestra']['criba8p']."</dd>\n";
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba13'] && $linea['LineaMuestra']['criba13'] != 0) || ($linea['CribaPonderada']['criba13'] && $linea['CribaPonderada']['criba13'] != 0)) {
	echo "  <dt>".($fondo == 13 ? 'Fondo' : 'Criba 13')."</dt><dd>".+$linea['LineaMuestra']['criba13']."</dd>\n";
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba12'] || $linea['CribaPonderada']['criba12']) {
	echo "  <dt>".($fondo == 12 ? 'Fondo' : 'Criba 12')."</dt><dd>".+$linea['LineaMuestra']['criba12']."</dd>\n";
}
echo "</dl>\n";
echo "</dl>\n";
echo "<br><dl>";
echo "  <dt>Criba Media</dt><dd>".$linea['CribaPonderada']['criba_media']."</dd>\n";
echo "  <dt>Humedad</dt><dd>".$linea['LineaMuestra']['humedad']."&nbsp;</dd>\n";
echo "  <dt>Defectos</dt><dd>".nl2br(h($linea['LineaMuestra']['defecto']))."&nbsp;</dd>\n";
echo "  <dt>Tueste</dt><dd>".$linea['LineaMuestra']['tueste']."&nbsp;</dd>\n";
echo "  <dt>Bebida</dt><dd>".nl2br(h($linea['LineaMuestra']['apreciacion_bebida']))."&nbsp;</dd>\n";
echo "  <dt>Observaciones</dt><dd>".$linea['LineaMuestra']['observacion_externa']."</dd>\n";
echo "</dl>";
$this->end();
?>
