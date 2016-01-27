
<h2>Agregar Cuenta Corriente almacén</h2>
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operaciones ', array(
'controller'=>'operaciones',
'action'=>'index_trafico'
));
/*$this->Html->addCrumb('Transporte', array(
'controller'=>'transportes',
'action'=>'view'
));
$this->Html->addCrumb('Añadir Cuenta Corriente');*/
echo $this->Form->create('AlmacenTransporte');
?>
<fieldset>	
		<div class="col2">
		<?php
		echo $this->Form->input('almacen_id',array(
				'label'=>'Nombre almacén',
	    		'empty' => array('' => 'Selecciona'),					
				)
			);
		echo $this->Form->input('cuenta_almacen',array('label'=>'Cuenta / Referencia almacén'));
		echo $this->Form->input('cantidad_cuenta',array('label'=>'Cantidad bultos en cuenta'));
		echo $this->Form->input('marca_almacen',array('label'=>'Marca almacenada'));
			?> 
	</div>
	<?php
		echo $this->Form->end('Guardar Cuenta Almacén');
	?> 
	</div>
</fieldset>