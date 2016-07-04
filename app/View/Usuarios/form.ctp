<?php
$this->Html->addCrumb('Usuarios');
echo $this->Form->create('Usuario');
?>
<fieldset>
<?php
echo '<legend>';
if ($action == 'add') {
    echo "Añadir UsuarioCMPSA";
}
if ($action == 'edit') {
    echo "Modificar Usuario ".$usuario;
}
echo "</legend>\n";
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
	'username',
	array(
		'label' => 'Usuario'
	)
);
echo $this->Form->input(
	'password',
	array(
		'label' => 'Contraseña'
	)
);
echo $this->Form->input(
	'role',
	array(
		'label' => 'Rol',
		'options' => array(
			'admin' => 'Admin',
			'contabilidad' => 'Contabilidad'
		)
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
echo "</fieldset>\n";
echo $this->element('cancelarform');
echo $this->Form->end('Guardar usuario');
?>
