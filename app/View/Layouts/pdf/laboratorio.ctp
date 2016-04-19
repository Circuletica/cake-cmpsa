<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php echo $this->Html->css('cake.pdf');?>
<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>

 <body>
 <h2>COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
<hr>


	<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;
	?>
</body>
</html>