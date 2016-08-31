<?php
$class = $this->fetch('class');
//el controller se calcula por defecto a partir
//de la clase
$controller = Inflector::tableize($class);
//si no hay $object definido explicitamente en
//la vista padre, se calcula uno por defecto a partir
//de la clase
$object = $this->fetch('object');
if ($object == '')
    $object = Inflector::humanize(Inflector::singularize($controller));
$this->Html->addCrumb($object, array(
    'controller'=>$controller,
    'action'=>'index'
));
$title = $this->fetch('title');
//El encabezado del listado a mostrar para poder personalizarlo
?>
<h2><?php echo $title; ?></h2>
<div class='index'>
	<?php echo $this->fetch('main'); ?>
</div>
