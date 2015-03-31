<h1>Modificar Muestra</h1>

<?php
	//si no esta la calidad en el listado, dejamos un enlace para
	//agragarla
	$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		'controller' => 'calidades',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_action' => 'edit',
		'from_id' => $muestra['Muestra']['id']
		)
	);
	//si no esta el proveedor en el listado, dejamos un enlace para
	//agragarlo
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_action' => 'add'
		)
	);

	echo $this->Form->create('Muestra', array('action' => 'edit'));
	echo $this->Form->input('calidad_id', array(
		'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
		'id' => 'combobox'
		)
	);
	echo $this->Form->input('proveedor_id', array(
		'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')'
		)
	);
	echo $this->Form->input('referencia');
	echo $this->Form->input('fecha', array(
		'dateFormat' => 'DMY',
		'timeFormat' => null )
	);
	echo $this->Form->input('almacen_id');
	echo $this->Form->input('aprobado');
	echo $this->Form->input('incidencia');
	echo $this->Form->input('id', array('type'=>'hidden'));
	echo $this->Form->end('Guardar Muestra');
?>
