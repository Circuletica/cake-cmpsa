<?php
echo $this->Form->create('Contrato', array('action'=>'filtroListado'));
echo $this->Form->input('Search.referencia');
echo $this->Form->input('Search.proveedor_id', array(
	'label' => 'Proveedor',
	'empty' => true
));
echo $this->Form->input('Search.calidad');
echo $this->Form->input('Search.fecha', array(
	'label' => 'Posición de bolsa',
	'after'=>'aaaa o mm-aaaa'
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
