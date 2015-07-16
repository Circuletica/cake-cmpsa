
<h2>Añadir Transporte</h2>
<?php
	$this->Html->addCrumb('Transportes', array(
		'controller' => 'Transportes',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Transporte', array(
		'controller' => 'transportes',
		'action' => 'add')
	);
?>

<fieldset>
<div class="col2">
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
		    'from_controller' => 'transportes',
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
	echo $this->Form->create('Transporte', array('action' => 'add'));
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));	
	echo $this->Form->input('Puerto.nombre', array('label' => 'Puerto'));
	echo $this->Form->input('Naviera.Empresa.nombre', array('label' => 'Empresa del transporte'));
	echo $this->Form->input('Agente.Empresa.nombre', array('label' => 'Nombre del agente'));
	echo $this->Form->input('Seguro.Aseguradora.Empresa.nombre', array('label' => 'Nombre Aseguradora'));
?>

</div>
<div class="columna3">
<div class="linea">
 <?php
 echo $this->Form->input('fecha_entradamerc', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha Entrada mercancía')
 );
  echo $this->Form->input('fecha_carga', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
  'label' => 'Fecha de carga')
 );
  echo $this->Form->input('fecha_llegada', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha de llegada')
 );
  echo $this->Form->input('fecha_pago', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha de pago')
 );
  echo $this->Form->input('fecha_enviodoc', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha de envío documentación')
 );
   echo $this->Form->input('fecha_despacho_op', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha despacho operación')
 );
   echo $this->Form->input('fecha_vencimiento_seg', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha vencimiento seguro')
 );
   echo $this->Form->input('fecha_reclamacion', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha de reclamación')
 );
   echo $this->Form->input('fecha_limite_retirada', array(
 'dateFormat' => 'DMY',
 'timeFormat' => null ,
 'label' => 'Fecha límite de retirada')
 );
 ?>
 </div>
 </div>
 <?php
 	echo $this->Form->input('observaciones');
	echo $this->Form->input('proveedor_id', array(
	   'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	   'empty' => array('' => 'Selecciona')
		)
	);
	echo $this->Form->end('Guardar Transporte');
?>
</fieldset>