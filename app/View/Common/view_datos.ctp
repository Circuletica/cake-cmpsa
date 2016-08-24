<h2><?php echo $this->fetch('titulo'); ?></h2>
<?php
	$id = $this->fetch('id');
	$clase = $this->fetch('clase');
	$controller = $this->fetch('controller');

	if (empty($clase)):
	echo "No hay agentes en esta lista";
	else:
	echo "<div class='acciones'>\n";
	echo $this->Button->edit('$controller',$empresa['$clase']['id'])
	.' '.$this->Button->delete('$controller',$empresa['$clase']['id'],$empresa['Empresa']['nombre']);
?>
</div>

<?php echo $this->fetch('content'); ?>
