<h2>Detalles anticipo</h2>

<?php
echo $this->Form->create('Anticipo');
?>
<fieldset>
<?php
echo $this->Form->input('asociado_id', array(
    'value' => $this->request->data['AsociadoOperacion']['asociado_id'],
    'autofocus' => 'autofocus'
)
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
echo $this->Form->input('operacion_id', array(
    'value' => $financiacion_id,
    'type' => 'hidden'
));
echo $this->element('cancelarform');
echo $this->Form->end('Guardar anticipo');
?>
</fieldset>