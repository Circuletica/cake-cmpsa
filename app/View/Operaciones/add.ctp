
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

	//   //si no esta el almacén en el listado, dejamos un enlace para agregarlo
	//    $enlace_anyadir_almacen = $this->Html->link ('Añadir Almacén', array(
//		    'controller' => 'almacenes',
//		    'action' => 'add',
//		    'from_controller' => 'operaciones',
//		    'from_action' => 'add',
//		    )
//	    );
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
	echo $this->Form->input('Operacion.packing');
	echo $this->Form->input('Operacion.si_fob',  array('label' => '¿Es FOB?');
	echo $this->Form->input('Operacion.flete);
	echo $this->Form->input('Operacion.flete);



	echo $this->Form->input('Operacion.fecha_seguro', array(
							'label' => 'Fecha de asegurado',
							'dateFormat' => 'DMY'));
	echo $this->Form->input('incoterm_id', array(
	    'label' => 'Incoterms ('.$enlace_anyadir_incoterms.')',
	    'empty' => array('' => 'Selecciona')
	    )
	);
    echo $this->Form->input('calidad_id', array(
		    'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
		    'empty' => array('' => 'Selecciona'),
		    //'class' => 'ui-widget',
		    //'id' => 'combobox'
		    )
	    );
	    echo $this->Form->input('proveedor_id', array(
		    'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
		    'empty' => array('' => 'Selecciona')
		    )
	    );
	    	    echo $this->Form->input('proveedor_id', array(
		    'label' => 'Almacen ('.$enlace_anyadir_almacen.')',
		    'empty' => array('' => 'Selecciona')
		    )
	    );

	    echo $this->Form->end('Guardar Operación');
?>
</fieldset>