<?php 
 echo date('d/m/Y');
 ?>
<html>
	<title>COMERCIAL DE MATERIAS PRIMAS S.A.
	</title>
<head>
	  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	  <?php
    echo $this->Html->meta('icon');
//echo $this->Html->css(array('cake.generic','cake.concreto','font-awesome-4.4.0/css/font-awesome.min.css'));
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('cmpsa');//incluye funciones javascript
?>
</head>
<body>
	<h2>COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
	<?php

header("Content-type: application/pdf");
?>
<?php
	echo $content_for_layout;
?>
</div>
</body>