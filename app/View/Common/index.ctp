<?php
$class = $this->fetch('class');
$titulo = $this->fetch('titulo');
$add_button = $this->fetch('add_button'); //Variable que se asignará en el index cuando no se quiera  ver el botón de añadir.

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
<h2><?php echo 'Listado de '.$object.': '.$titulo; ?></h2>

<div class="actions">
    <h3>Búsqueda</h3>
    <ul>
    <?php echo $this->fetch('filter');?>
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
		<?php
        echo (
        ($add_button) ?
        $this->Button->add($controller,$object):
        ''
        );
        ?>
	</div>
    <?php echo $this->element('paginador');?>
</div>
