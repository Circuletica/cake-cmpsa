<?php
echo $this->Form->create('Anticipo', array('action'=>'filtroListado'));
echo $this->Form->input(
	'Search.fecha',
	array(
		'label' => 'Fecha contable',
		'after'=>'aaaa o mm-aaaa'
	)
);
echo $this->Form->input(
	'Search.referencia',
	array(
		'label' => 'Operación',
		'empty' => true
	)
);
echo $this->Form->input(
	'Search.asociado_id',
	array(
		'label' => 'Asociado',
		'empty' => true
	)
);
echo $this->Form->input(
	'Search.banco_id',
	array(
		'label' => 'Banco',
		'empty' => true
	)
);
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
echo $this->Html->Link('Importar',array('action'=>'contabilizar'), array('escape'=>false));
?>
		</li>
	</ul>
</div>
