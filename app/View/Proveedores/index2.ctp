<h2>BancoPruebas</h2>
<?php
if (empty($bancopruebas)):
	echo "No hay bancos de prueba en esta lista";
else:
	echo print_r($bancopruebas);
endif;
?>
