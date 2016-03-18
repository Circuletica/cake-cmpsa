<html>
	<title>
	</title>
</head>
<body>
	<h1>COMERCIAL DE MATERIAS PRIMAS S.A.</h1>
	<h2>DEPARTAMENTO DE CONTROL DE CALIDAD</h2><br>
	<?php
	echo $this->Html->link('hola');
	?>
	FACTURA
	layout>facturas

	<?php
header("Content-type: application/pdf");
echo $content_for_layout;
?>
</body>
</html>