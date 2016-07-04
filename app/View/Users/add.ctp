<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Añadir usuario'); ?></legend>
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
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
