<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php //echo $this->Html->css('cake.pdf'); // Esto no funciona?>
<link rel="stylesheet" type="text/css" href="<?php echo APP.'webroot'.DS.'css'.DS.'cake.pdf.css'; ?>" media="all" />

<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>

 <body>
 <div id="content">
 <?php echo "<h5 style='text-align: right;'>".date('d/m/Y')."</h5><br>";?>
 <h2 style="text-align: center;">	COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
<hr>


	<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;

?>
</div>
<div id="footer">
</div>
</body>
</html>
