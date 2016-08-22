<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
        <link rel="stylesheet" type="text/css" href="<?php echo APP.'webroot'.DS.'css'.DS.'cake.pdf.css'; ?>" media="all" />
<style>

</style>
    <?php //echo $this->Html->css('cake.pdf'); // Esto no funciona?>
    <title>COMERCIAL DE MATERIAS PRIMAS S.A.</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
<body>
<?php echo "<h5 style='text-align: right;'>".date('d/m/Y')."</h5>";?>
    <big><span style="font-weight: bold;">
	COMERCIAL DE MATERIAS PRIMAS S.A.</span></big><br>
	AVDA. ALBERTO ALCOCER, 5&nbsp; 1ª PLANTA<br>
	28036 MADRID<br>
	Teléfonos: 913 59 70 49 / 913 59 23 91<br>
	Fax: 913 45 23 61<br>
	<?php
		header("Content-type: application/pdf");
		echo $content_for_layout;

?>
</div>
<div id="footer">
</div>
</body>
</html>
