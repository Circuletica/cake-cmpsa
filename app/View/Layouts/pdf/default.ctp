<html>
	<title>
	</title>
</head>
<body>
	<h2>COMERCIAL DE MATERIAS PRIMAS S.A.</h2>
layout>default
	<?php
 echo date('d/m/Y');
header("Content-type: application/pdf");
echo $content_for_layout;
?>
</body>