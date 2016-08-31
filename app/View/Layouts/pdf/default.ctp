<?php
echo $this->Html->css('cake.pdf');

?>
<html>
	<title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
	<head>
	<?php
	echo date('d/m/Y');
	?>
		  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		  <h1 style:align="">COMERCIAL DE MATERIAS PRIMAS S.A.</h1>
	</head>
	<body>
		<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;
		?>
	</body>
</html>
