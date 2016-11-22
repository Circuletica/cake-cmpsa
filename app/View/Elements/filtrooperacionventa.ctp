<?php
echo $this->Form->create('OperacionVenta', array('action'=>'filtroListado'));
echo $this->Form->input('Search.referencia',
  array(
  'label' => 'Ref. operación'
  )
);
echo $this->Form->input('Search.calidad', array(
	'label' => 'Calidad',
	'empty' => true
));
?>
<div class="formuboton">
	<ul>
		<li><?php
echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array('action'=>'index'), array('escape'=>false));
?>
		</li>
		<li style="margin: 0">
<?php
echo $this->Form->end('Buscar');
?>
		</li>
	</ul>
</div>
