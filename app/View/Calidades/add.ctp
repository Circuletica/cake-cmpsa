<div class="add">
<h2>Añadir Calidad</h2>

<?php
	$this->Html->addCrumb('Calidades', array(
		'controller' => 'calidades',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Calidad', array(
		'controller' => 'calidades',
		'action' => 'add')
	);
	echo $this->Form->create('Calidad');
	$enlace_anyadir_origen = $this->Html->link ('Añadir Origen', array(
		'controller' => 'paises',
		'action' => 'add',
		'from_controller' => 'calidades',
		'from_action' => 'add',
		)
	);

   	//Un café 'Blend' se guarda como pais_id==null en la BD
  	echo $this->Form->input('pais_id', array(
		'label' =>'Origen ('.$enlace_anyadir_origen.')',
  		'empty' => 'Blend')
	);
	//echo $this->Form->input('pais_id');
	echo $this->Form->input('descafeinado');
	echo $this->Form->input('descripcion');
	echo $this->Form->end('Guardar Calidad');
?>
</div>
