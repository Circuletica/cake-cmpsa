
<h2>Agregar Cuenta Corriente almacén</h2>
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operacines ', array(
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
		<?php
		echo $this->Form->input('almacen_id',array(
				'label'=>'Nombre almacén',
	    		'empty' => array('' => 'Selecciona'),					
				)
			);
		echo $this->Form->input('cuenta_almacen',array('label'=>'Cuenta corriente / Referencia almacén'));
		echo $this->Form->input('cantidad_cuenta',array('label'=>'Cantidad bultos en cuenta'));
		echo $this->Form->input('MarcaAlmacen.nombre',array('label'=>'Marca almacenada'));
		echo $this->Form->end('Guardar Cuenta Almacén');
	?> 
</fieldset>