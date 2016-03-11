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
?>
<h2><?php echo $object; ?></h2>
<div class='view'>
	<?php echo $this->fetch('main'); ?>
	<div class="detallado">
	<?php echo "<h3>".ucfirst($line_object)."</h3>\n";?>
	<?php echo $this->fetch('lines'); ?>
	</div>

<?php if($line2_object):?>
	<div class="detallado">
	<?php echo "<h3>".ucfirst($line2_object)."</h3>\n";?>
	<?php echo $this->fetch('lines2'); ?>
	</div>
<?php endif;?>
<?php $this->fetch('content');?>
</div>
