<?php
$id = $this->fetch('id');
$class = $this->fetch('class');
$controller = $this->fetch('controller');
$line_controller = $this->fetch('line_controller');
$line2_controller = $this->fetch('line2_controller');
$object = $this->fetch('object');
$line_object = $this->fetch('line_object');
$line2_object = $this->fetch('line2_object');
$line_add = $this->fetch('line_add');
$line2_add = $this->fetch('line2_add');
$from_controller = $this->fetch('from_controller');
$from_id = $this->fetch('from_id');

$this->Html->addCrumb(ucfirst($controller), array(
    'controller'=>$controller,
    'action'=>'index'
));
?>
<h2><?php echo $object; ?></h2>

<div class="actions">
    <ul>
    <?php echo $this->fetch('filter'); ?>
    </ul>
</div>
<div class="acciones">
	<div class="printdet">
	<ul><li>
<?php 
echo $this->element('imprimirV');
?>	

	</li>
	<li>
<?php
echo $this->Button->edit($controller,$id)
    .' '.
    //si esta definido el $from_controller, ponemos un botón
    //que devuelve al controller mencionado,
    //si no es el caso, volvemos al index del controller del
    //borrado
    (empty($from_controller) ? 
    $this->Button->deleteLine($controller,$id,$from_controller,$from_id,$object):
    $$this->Button->delete($controller,$id,$object)
);
?>
	</li>
	</ul>
	</div>
</div>
<div class='view'>
	<?php echo $this->fetch('main'); ?>
	<div class="detallado">
	<?php echo "<h3>".ucfirst($line_object)."</h3>\n";?>
	<?php echo $this->fetch('lines'); ?>
	</div>
<?php if($line_add):?>
	<div class="btabla">
		<?php echo $this->Button->addLine($line_controller,$controller,$id,$line_object);?>
	</div>
<?php endif;?>
<?php if($line2_object):?>
	<div class="detallado">
	<?php echo "<h3>".ucfirst($line2_object)."</h3>\n";?>
	<?php echo $this->fetch('lines2'); ?>
	</div>
<?php if($line2_add):?>
	<div class="btabla">
		<?php echo $this->Button->addLine($line2_controller,$controller,$id,$line2_object);?>
	</div>
<?php endif;?>
<?php endif;?>
<?php $this->fetch('content');?>
</div>
