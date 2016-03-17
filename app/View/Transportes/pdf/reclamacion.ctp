<?php
    $this->layout = 'reclamacion';	
$dia = date ('d');
$mes=date('m');
$ano = date('Y');

if ($mes=="1") $mes="Enero";
if ($mes=="2") $mes="Febrero";
if ($mes=="3") $mes="Marzo";
if ($mes=="4") $mes="Abril";
if ($mes=="5") $mes="Mayo";
if ($mes=="6") $mes="Junio";
if ($mes=="7") $mes="Julio";
if ($mes=="8") $mes="Agosto";
if ($mes=="9") $mes="Setiembre";
if ($mes=="10") $mes="Octubre";
if ($mes=="11") $mes="Noviembre";
if ($mes=="12") $mes="Diciembre";
?>
	<div style="margin-left: 500px;">
	<br>
	<b><?php echo $transporte['Aseguradora']['nombre'] ?></b>
	</div>
<br><br><br>
	<div style="margin-left: 400px;">
	Madrid, <?php echo $dia.' de '. $mes.' del '.$ano?>
	</div>
<?php echo 'Referencia: '.$transporte['Operacion']['referencia'].' '.'('.$parte.' parte)'?> 

<br>
<br>
<br>
Muy Sres. nuestros:<br>
<br>
Adjunto les enviamos los siguientes documentos para que nos efectúen
liquidación por la diferencia de kilos faltantes:<br><br>
<ul style="margin-left: 80px;">
<li>- Certificado de Averías SGS</li>
<li>- Factura Comercial</li>
<li>- B/L (Copia)<br><br>
</li>
</ul>
A la vista de los citados documentos, rogamos el abono de: <br>
<br>
Sin otro particular, les saludamos atentamente.