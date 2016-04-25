<?php
if ($action == 'add') {
    echo "<h2>Añadir Contacto a ".$this->params['named']['from_controller'].' '.$empresa['Empresa']['nombre']."</h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Contacto ".$referencia."</h2>\n";
}
$this->Html->addCrumb('Entidades','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb($empresa['Empresa']['nombre'], '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
echo $this->Form->create();
?>
<fieldset>
<?php
echo $this->Form->input(
    'nombre',
    array( 'autofocus' => 'autofocus')
);
echo $this->Form->input(
    'departamento_id',
    array(
	'empty' => true
    )
);
?>
</fieldset>
<fieldset>
<?php
echo $this->Form->input(
    'funcion',
    array('label' =>'Función')
);
echo $this->Form->input(
    'telefono1',
    array('label'=>'Teléfono Nº1'
        )
    );
?>
</fieldset>
<fieldset>
<?php

echo $this->Form->input(
    'telefono2',
    array('label'=>'Teléfono Nº2'
        )
    );
echo $this->Form->input(
    'email',
    array('label'=> 'e-Mail'
        )
    );
echo $this->element('cancelarform');
echo $this->Form->end('Guardar contacto');
?>
</fieldset>
