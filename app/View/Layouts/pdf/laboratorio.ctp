<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php echo $this->Html->css('cake.pdf');?>
<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>

 <body>
 <h2 style="text-align: center;">	COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
<hr>


	<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;
	
echo "<hr><br>";
echo "<h3 style='text-align: center;'>RESULTADOS DE BEBIDA EN PRUEBA DE CAFÉ VERDE</h3>";
echo "<hr>";
echo "<h5>COMENTARIOS:</h5>";
?>
<br><br><br><h5 style='text-align: center;'>LA NO RESPUESTA SE ENTENDERÁ COMO COINCIDENCIA CON ESTE INFORME.</h5>
<hr>
Saludos<br>
C.M.P.S.A

</body>
</html>