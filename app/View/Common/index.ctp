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
?>
<h2><?php echo 'Listado de '.$object; ?></h2>

<div class="actions">
    <h3>Búsqueda</h3>
    <ul>
    <?php echo $this->fetch('filter');
    echo"<hr>\n";
    echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos ?>
    </ul>
</div>
<div class="acciones">
	<div class="printdet">
	<ul>
	    <li><?php echo $this->element('imprimirI'); ?></li>
	</ul>
	</div>
</div>
<div class='index'>
	<?php echo $this->fetch('main'); ?>
	<div class="btabla">
		<?php echo $this->Button->add($controller,$object);?>
	</div>
    <?php echo $this->element('paginador');?>
</div>
