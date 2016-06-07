<?php
if ($action == 'add') {
    echo "<h2>Añadir Usuario de CMPSA</h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Usuario ".$usuario."</h2>\n";
}
$this->Html->addCrumb($empresa['Empresa']['nombre'], '/Usuarios');
echo $this->Form->create('Usuario');
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
echo $this->Form->end('Guardar usuario');
?>
</fieldset>
