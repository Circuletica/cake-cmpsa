<h1>Modificar Línea transporte</h1>
<fieldset>
<?php
  $this->Html->addCrumb('Línea transporte', '/transportes');
	//si no esta la calidad en el listado, dejamos un enlace para
	//agragarla
//	$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
//		'controller' => 'calidades',
//		'action' => 'add',
//		'from_controller' => 'muestra',
//		'from_action' => 'edit',
//		'from_id' => $muestra['Muestra']['id']
//		)
//	);
	//si no esta el proveedor en el listado, dejamos un enlace para
	//agragarlo
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'operadores',
		'from_action' => 'add'
		)
	);

	echo $this->Form->create('Transporte', array('action' => 'edit'));
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));	
	echo $this->Form->input('Puerto.nombre', array('label' => 'Puerto'));
	echo $this->Form->input('Naviera.Empresa.nombre', array('label' => 'Empresa del transporte'));
	echo $this->Form->input('Agente.Empresa.nombre', array('label' => 'Nombre del agente'));
	
?>
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
 	<?php
// 	echo $this->Form->input('observaciones');
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
	    </div>		
	    <?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->end('Guardar Muestra');
		?>
 
</div>
</fieldset>
