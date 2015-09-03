<h2><?php echo $this->fetch('titulo'); ?></h2>

<div class="actions">
    <h3>Búsqueda</h3>
    <ul>
    <?php echo $this->fetch('filtro'); ?>
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
	$id = $this->fetch('id');
	$clase = $this->fetch('clase');
	$controller = $this->fetch('controller');
	echo $this->Html->link(
		'<i class="fa fa-pencil-square-o"></i> Modificar',
		array(
			'action'=>'edit',
			$id
		),
		array(
			'title'=>'Modificar '.$clase,
			'escape'=>false
		)
	).' '.
	$this->Form->postLink(
		'<i class="fa fa-trash"></i> Borrar',
		array(
			'action'=>'delete',
			$id,
			'from_controller' => $controller,
			'from_id' => $id
		),
		array(
			'escape'=>false,
			'title'=> 'Borrar',
			'confirm'=>'¿Realmente quiere borrar el '.$this->fetch('titulo').'?'
		)
	);
?>
	</li>
	</ul>
	</div>
</div>
<?php echo $this->fetch('content'); ?>

