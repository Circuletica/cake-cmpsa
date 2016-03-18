<?php
    $this->layout = 'reclamacion';
    $reclamacion = $transporte['Transporte']['peso_factura'] -$transporte['Transporte']['peso_neto'];
    $suma = $reclamacion + $transporte['Transporte']['averia'];
if(empty($transporte['Aseguradora']['nombre'] && $transporte['Transporte']['peritacion'])){
	echo '<h1>Faltan campos del seguro por rellenar para generar la carta</h1>';
}else{
?>
	<div style="margin-left: 435px;">
	<br>
	<b><?php echo $transporte['Aseguradora']['nombre'] ?></b>
<br><br>
	Madrid, <?php echo $dia.' de '. $mes.' del '.$ano?>
	</div>
	<br><br>
<?php echo '<b>Ref.: '.$transporte['Operacion']['referencia'].' '.'('.$num.'ª parte)&nbsp&nbsp&nbsp&nbsp Supl.: '.$transporte['Transporte']['suplemento_seguro'].'</b>'?> 

<br>
<br>
<?php echo '<h2>Café '.$transporte['Operacion']['Contrato']['CalidadNombre']['nombre'].'</h2>';?>
<br>
Muy Sres. nuestros:<br>
<br>
Adjunto les enviamos los siguientes documentos para que nos efectúen
liquidación por la diferencia de kilos faltantes:<br><br>
<?php 
echo '<ul>';
echo '<li>Certificado de Averías SGS</li>';
echo '<li>Factura Comercial</li>';
echo '<li>B/L (Copia)</li>';
echo '</ul><br><br>';
echo 'A la vista de los citados documentos, rogamos el abono de:';
?>
<br><br>
<ul>
	<li><?php echo $reclamacion.' Kg respecto al peso facturado';?></li>
<?php
if (!empty($transporte['Transporte']['averia'])){
	echo '<li>'.$transporte['Transporte']['averia'].'Kg de avería</li>';
	echo '</ul><br>';
	echo 'Siendo el importe de <b>'.$suma.' total de kilogramos </b>('.$transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'].' €/Kg) = '.$suma*$transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'].' Euros';
}else{
	echo '</ul><br>';
	echo 'Siendo el importe de <b>'.$reclamacion.'</b> ('.$transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'].' €/Kg) ='.$suma*$transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'];
}
echo '<br><br>';
echo 'El importe de la peritación SGS: '.$transporte['Transporte']['peritacion'].' €';
echo '<br><br>';
$total = ($reclamacion*$transporte['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total'])+$suma;
echo '<b>Total importe reclamación: '.$total.' Euros</b>';
echo '<br><br>'; 
echo 'Sin otro particular, les saludamos atentamente.';
}
?>