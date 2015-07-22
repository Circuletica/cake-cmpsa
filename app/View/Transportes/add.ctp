
<h2>Añadir Línea de Transporte</h2>
<?php
	$this->Html->addCrumb('Línea de Transporte', array(
		'controller' => 'Transportes',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Transporte', array(
		'controller' => 'transportes',
		'action' => 'add')
	);
?>

<fieldset>
    <?php
	    //si no esta la calidad en el listado, dejamos un enlace para agregarlo
	    $enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		    'controller' => 'calidades',
		    'action' => 'add',
		    'from_controller' => 'muestras',
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
	    $enlace_anyadir_puerto = $this->Html->link ('Añadir Puerto', array(
		    'controller' => 'puertos',
		    'action' => 'add',
		    'from_controller' => 'transportes',
		    'from_action' => 'add',
		    )
	    );
	    $enlace_anyadir_naviera = $this->Html->link ('Añadir Naviera', array(
		    'controller' => 'navieras',
		    'action' => 'add',
		    'from_controller' => 'transportes',
		    'from_action' => 'add',
		    )
	    );
	    $enlace_anyadir_seguro = $this->Html->link ('Añadir Seguro', array(
		    'controller' => 'seguros',
		    'action' => 'add',
		    'from_controller' => 'transportes',
		    'from_action' => 'add',
		    )
	    );	
	   $enlace_anyadir_agente = $this->Html->link ('Añadir Agente', array(
		    'controller' => 'agentes',
		    'action' => 'add',
		    'from_controller' => 'transportes',
		    'from_action' => 'add',
		    )
	    );		    
		//si no esta en el listado, dejamos un enlace para agregarlo

	    //Formulario para rellenar operación
	?>
	<div class="col2">
	<?php
	echo $this->Form->create('Transporte', array('action' => 'add'));
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));	
?>
</div>
<div class="linea">
	<div class='columna3'>
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
		 'label' => 'Fecha de pago',
		 'selected' => '')
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
		  echo $this->Form->input('fecha_reclamacion_factura', array(
		 'dateFormat' => 'DMY',
		 'timeFormat' => null ,
		 'label' => 'Fecha reclamacion factura')
		 );
		echo $this->Form->input('flete');
		echo $this->Form->input('forfait');
		?>
		</div>
		<?php
		echo $this->Form->input('puerto_id', array(
		    'label' => 'Puerto ('.$enlace_anyadir_puerto.')',
		    'empty' => array('' => 'Selecciona')
		    ));
		echo $this->Form->input('naviera_id', array(
		    'label' => 'Naviera ('.$enlace_anyadir_naviera.')',
		    'empty' => array('' => 'Selecciona')
		    ));
//		echo $this->Form->input('operacion_id', array(
//		    'label' => 'Operación ('.$enlace_anyadir_operacion.')',
//		    'empty' => array('' => 'Selecciona')
//		    ));
		echo $this->Form->input('agente_id', array(
		    'label' => 'Agente ('.$enlace_anyadir_agente.')',
		    'empty' => array('' => 'Selecciona')
		    ));
		?>

 </div>
 	<?php
	echo $this->Form->input('observaciones');
		    echo $this->Form->input('calidad_id', array(
		    'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
		    'empty' => array('' => 'Selecciona')
		    )
	    );
	    echo $this->Form->input('proveedor_id', array(
		    'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
		    'empty' => array('' => 'Selecciona')
		    )
	    );

//	echo $this->Form->input('proveedor_id', array(
//	   'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
//	   'empty' => array('' => 'Selecciona')
//		)
//	);
	?>
	<div class="detalladoform">
	<h3>Aseguradora</h3>

	<table>
<?php
	echo $this->Form->input('Seguro.Aseguradora.Empresa.nombre', array('label' => 'Nombre aseguradora'));
?>	</table>
	</div>
<?php
	echo $this->Form->end('Guardar Transporte');
?>
</fieldset>