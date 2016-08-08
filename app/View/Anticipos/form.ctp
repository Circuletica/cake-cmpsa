<?php
$this->Js->set('lista_operaciones', $lista_operaciones);
echo $this->Js->writeBuffer(array('onDomReady' => false));
switch ($action) {
case 'add':
	echo "<h2>Añadir anticipo</h2>";
	break;
case 'edit':
	$asociado_id = $this->request->data['AsociadoOperacion']['asociado_id'];
	echo "<h2>Modificar anticipo ".$asociados[$asociado_id]."</h2>";
	break;
}
if (isset($this->request->data['Anticipo']) && $this->request->data['Anticipo']['si_contabilizado']) {
	echo "<em>Este anticipo ya ha sido exportado.\n
		Si se modifica, se generará un asiento inverso y\n
		otro asiento nuevo con los datos corregidos.</em>";
}
echo $this->Form->create('Anticipo');
?>
<fieldset>
<?php
echo $this->Form->hidden('si_contabilizado');
echo $this->Form->input(
	'AsociadoOperacion.operacion_id',
	array(
		'autofocus' => 'autofocus',
		'oninput' => 'anticipoAsociado()'
	)
);
echo $this->Form->input(
	'AsociadoOperacion.asociado_id'
);
?>
<div class="linea">
<?php
echo $this->Form->input('fecha_conta');
?>
</div>
</fieldset>
<fieldset>
<?php
echo $this->Form->input('importe');
echo $this->Form->input('banco_id');
//echo $this->Form->input(
//	'operacion_id',
//	array(
//		'value' => $operacion_id,
//		'type' => 'hidden'
//	)
//);
echo $this->element('cancelarform');
echo $this->Form->end('Guardar anticipo');
?>
</fieldset>
