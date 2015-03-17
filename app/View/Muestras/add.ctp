<div class="add">
<h1>Añadir Muestra</h1>

<?php
	echo $this->Form->create('Muestra');
	$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		'controller' => 'calidades',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_action' => 'add',
		)
	);
	echo $this->Form->input('calidad_id', array(
		'label' => 'Calidad ('.$enlace_anyadir_calidad.')')
	);
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_action' => 'add'
		)
	);
	echo $this->Form->input('proveedor_id', array(
		'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')')
	);
	echo $this->Form->input('referencia');
	echo $this->Form->input('fecha', array(
		'dateFormat' => 'DMY',
		'timeFormat' => null )
	);
	echo $this->Form->input('almacen_id');
	echo $this->Form->input('aprobado');
	echo $this->Form->input('incidencia');
	//echo $this->Form->input('reclamacion');
	echo $this->Form->end('Guardar Muestra');
?>
</div>
