
<h2>Añadir Operación</h2>
<?php
	$this->Html->addCrumb('Operaciones', array(
		'controller' => 'Operaciones',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Operación', array(
		'controller' => 'operaciones',
		'action' => 'add')
	);

//Formulario para rellenar operación

	echo $this->Form->create('Operacion', array('action' => 'add'));
	echo $this->Form->input('Empresa.nombre');
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	?>