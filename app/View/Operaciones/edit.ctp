<h2>Modificar Operacion <em><?php //echo $operacion['Operacion']['referencia']?></em></h2>
<fieldset>
<?php
//$this->Html->addCrumb('Operaciones','/operaciones');
//$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'],'/operacion/view/'.$operacion['Operacion']['id']);


	//si no esta el proveedor en el listado, dejamos un enlace para
	//agragarlo
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'operadores',
		'from_action' => 'add'
		)
	);

	echo $this->Form->create('Operacion', array('action' => 'edit'));
	//echo $this->Form->input('referencia', array('label'=>'Referencia Operación'));
	//echo $this->Form->input('Contrato.referencia');
	?>
	<div class="linea">
	<?php
	echo $this->Form->input('Contrato.fecha_embarque', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha embarque',
	'empty' => ' ')
	);
	echo $this->Form->input('Contrato.fecha_entrega', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha embarque',
	'empty' => ' ')
	);
	?>
	</div>
	<?php
	echo $this->Form->input('Contrato.CalidadNombre.nombre', 'Calidad');
	echo $this->Form->input('proveedor', 'Proveedor');
	echo $this->Form->input('Contrato.Incoterm', 'Incoterms');
	echo $this->Form->input('Embalaje.peso_embalaje','Peso embalaje');





	echo $this->Form->input('calidad_id', array('label' => 'Calidad'));
	echo $this->Form->input('proveedor_id', array('label' => 'Proveedor'));
	 ?>
		    <div class="linea">
			<?php
			echo $this->Form->input('fecha', array(
				'dateFormat' => 'DMY',
				'timeFormat' => null )
			);
			  ?>
			</div>
		<?php 
		echo $this->Form->input('almacen_id');
		echo $this->Form->input('aprobado');
			echo $this->Form->input('incidencia');
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->end('Guardar Muestra');
		?>
 
</fieldset>
