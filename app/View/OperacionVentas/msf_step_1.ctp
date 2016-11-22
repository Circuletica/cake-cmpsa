<?php

/*if ($action == 'add') {
	echo "<h2>Añadir Operación Venta (tipo 3)</h2>\n";
}
if ($action == 'edit') {
	echo "<h2>Modificar Operación Venta (tipo3)</h2>\n";
}*/
$this->Html->addCrumb('Operaciones (venta)','/operacion_ventas');

echo $this->Form->create('OperacionVenta');
//Info de la operación
?>
<fieldset>
	<legend>Datos</legend>
	<?php
	echo $this->Form->input(
		'referencia',
		array(
			'autofocus' => 'autofocus'
		)
	);
	echo $this->Form->input(
	    'calidad_id',
	    array(
		'label' => 'Calidad',
		'empty' => array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'combobox',
		'style' => 'width: 100%' //Si no marco el estilo se deforma todo el fieldset.
	    )
	);
?>
</fieldset>
<fieldset>
<br>
<?php
	echo $this->Form->input(
		'precio_directo_euro',
		array(
			'label' => 'Precio fijo (€/kg)',
			'id' => 'precioFijoEuro'
		)
	);
	echo $this->element('cancelarform');
	echo $this->Form->end('Siguiente');
?>
</legend>
