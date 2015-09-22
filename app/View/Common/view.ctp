<?php
	$id = $this->fetch('id');
	$class = $this->fetch('class');
	$controller = $this->fetch('controller');
	$line_controller = $this->fetch('line_controller');
	$object = $this->fetch('object');
	$line_object = $this->fetch('line_object');
	$this->Html->addCrumb(ucfirst($controller), array(
		'controller'=>$controller,
		'action'=>'index'
));
?>
<h2><?php echo $object; ?></h2>

<div class="actions">
    <h3>Búsqueda</h3>
    <ul>
    <?php echo $this->fetch('filter'); ?>
    </ul>
</div>
<div class="acciones">
	<div class="printdet">
	<ul><li>
		<?php 
		//echo $this->element('imprimirV');
		?>	
		
	</li>
	<li>
<?php
	echo $this->Button->edit($class,$id)
	.' '.$this->Button->delete($controller,$id,$object);
?>
	</li>
	</ul>
	</div>
</div>
<div class='view'>
	<?php echo $this->fetch('main'); ?>
	<?php echo $this->fetch('lines'); ?>
	<div class="btabla">
		<?php echo $this->Button->addLine($line_controller,$controller,$id,$line_object);?>
	</div>
</div>
