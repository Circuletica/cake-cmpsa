<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES">
<html><head>
<?php //echo $this->Html->css('cake.pdf');//Esto no fucniona ?>
<link rel="stylesheet" type="text/css" href="<?php echo APP.'webroot'.DS.'css'.DS.'cake.pdf.css'; ?>" media="all" />

<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>
<body><big><span style="font-weight: bold;">
	COMERCIAL DE MATERIAS PRIMAS S.A.</span></big><br>
	AVDA. ALBERTO ALCOCER, 5&nbsp; 1ª PLANTA<br>
	28036 MADRID<br>
	Teléfonos: 913 59 70 49 / 913 59 23 91<br>
	Fax: 913 45 23 61<br>
	<br>
	<?php
	header("Content-type: application/pdf");
	echo $content_for_layout;
	?>
</body>
</html>
