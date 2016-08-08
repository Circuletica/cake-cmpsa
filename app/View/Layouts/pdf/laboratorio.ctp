<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php echo $this->Html->css('cake.pdf');?>
<!--<link rel="stylesheet" type="text/css" href="<?php //echo APP.'webroot'.DS.'css'.DS.'cake.pdf.css'; ?>" media="all" /> -->
<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>

 <body>
 <div id="content">
 <?php echo "<h5 style='text-align: right;'>".date('d/m/Y')."</h5>";?>
 <h2 style="text-align: center;">	COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
<hr>


	<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;
	
?>
</div>
<div id="footer">
	<?php
	echo "<h5 style='text-align: center;'>RESULTADOS DE BEBIDA EN PRUEBA DE CAFÉ VERDE</h5>";
	echo "<hr>";
	echo "<h5>COMENTARIOS:</h5>";
	?>
	<br><br><br><h5 style='text-align: center;'>LA NO RESPUESTA SE ENTENDERÁ COMO COINCIDENCIA CON ESTE INFORME.</h5>
	<hr>
	Saludos<br>
	C.M.P.S.A
</div>
</body>
</html>