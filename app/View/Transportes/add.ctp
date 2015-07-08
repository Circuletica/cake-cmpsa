
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
?>

<fieldset>
    <?php
	    //si no esta la calidad en el listado, dejamos un enlace para agregarlo
	    $enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		    'controller' => 'calidades',
		    'action' => 'add',
		    'from_controller' => 'operaciones',
		    'from_action' => 'add',
		    )
	    );
	    //si no esta el proveedor en el listado, dejamos un enlace para agregarlo

	    $enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		    'controller' => 'proveedores',
		    'action' => 'add',
		    'from_controller' => 'operaciones',
		    'from_action' => 'add',
		    )
	    );
	//si no esta el almacén en el listado, dejamos un enlace para agregarlo
	//    $enlace_anyadir_incoterms = $this->Html->link ('Añadir Incoterms', array(
	//	    'controller' => 'incoterms',
	//	    'action' => 'add',
	//	    'from_controller' => 'operaciones',
	//	    'from_action' => 'add',
	//	    )
	 //  );
	    //Formulario para rellenar operación
	echo $this->Form->create('Operacion', array('action' => 'add'));
	echo $this->Form->input('Operacion.referencia');
	echo $this->Form->input('proveedor_id', array(
	   'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	   'empty' => array('' => 'Selecciona')
		)
	);
	echo $this->Form->end('Guardar Operación');
?>
</fieldset>