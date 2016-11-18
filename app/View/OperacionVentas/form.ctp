<?php
if ($action == 'add') {
	echo "<h2>Añadir Operación Venta</h2>\n";
}
if ($action == 'edit') {
	echo "<h2>Modificar Operación a Contrato</h2>\n";
}
$this->Html->addCrumb('Operaciones (venta)','/operacion_ventas');

echo $this->Form->create('OperacionVenta');
//Info de la operación
?>
<fieldset>
	<legend>Datos</legend>
	<div class='col2'>
<?php
echo $this->Form->input(
	'referencia',
	array(
		'autofocus' => 'autofocus'
	)
);
echo $this->Form->input(
	'embalaje_id'
);
echo $this->Form->input(
	'precio_directo_euro',
	array(
		'label' => 'Precio fijo',
		'id' => 'precioFijoEuro',
		'between' => '(€/kg)'
	)
);
?>
<fieldset>
	<legend>Asociados</legend>
	<table>
	<tr>
	  <th>Código</th>
	  <th>Asociado</th>
	  <th>Cantidad</th>
	  <th>Peso</th>
	</tr>
<?php
foreach ($asociados as $codigo => $asociado){
	echo "<tr>";
	echo "<td>";
	echo substr($codigo,-2);
	echo "</td>\n";
	echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
	echo "<td>";
	echo $this->Form->input(
		'CantidadAsociado.'.$asociado['Asociado']['id'],
		array(
			'label' => '',
			'class' => 'cantidad',
			'id' => $asociado['Asociado']['id'],
		//	'oninput' => 'pesoAsociado()'
		)
	);
	echo "</td>";
	echo "<td>";
	echo '<div style=width:100px; id=pesoAsociado'.$asociado['Asociado']['id'].'>'."= ??????kg".'</div>';
	echo "</td>";
	echo "</tr>";
}
?>
	</table>
<?php
echo '<div id=totalReparto>Total peso: ???kg</div>';
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Operación');
?>
</fieldset>
