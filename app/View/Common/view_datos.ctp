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

//	echo $this->Html->link(
//		'<i class="fa fa-pencil-square-o"></i> Modificar',
//		array(
//			'action'=>'edit',
//			$id
//		),
//		array(
//			'title'=>'Modificar '.$clase,
//			'escape'=>false
//		)
//	).' '.
//	$this->Form->postLink(
//		'<i class="fa fa-trash"></i> Borrar',
//		array(
//			'action'=>'delete',
//			$id,
//			'from_controller' => $controller,
//			'from_id' => $id
//		),
//		array(
//			'escape'=>false,
//			'title'=> 'Borrar',
//			'confirm'=>'¿Realmente quiere borrar el '.$this->fetch('titulo').'?'
//		)
//	);
?>
</div>

<?php echo $this->fetch('content'); ?>

