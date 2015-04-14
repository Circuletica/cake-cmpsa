<h2>Añadir Proveedor</h2>
<?php
echo $this->Html->script('jquery')."\n"; // Include jQuery library
echo $this->Html->script('jquery.maskedinput')."\n"; // Include masked input jQuery plugin
?>
<script type="text/javascript">
jQuery(function($) {
	$('#EmpresaCuentaBancaria').mask("9999-9999-99-9999999999");
});
</script>
<div class="columna2">
<?php
$this->Html->addCrumb('Proveedores', '/proveedores');
$this->Html->addCrumb('Añadir Proveedor', '/proveedores/add');
	echo $this->Form->create('Proveedor');
//	echo $this->Form->create('Proveedor', array(
//		'controller' => 'proveedores',
//		'action' => 'add',
//		'from_controller' => 'proveedores',
//		'from_action' => 'add'	
//	));
echo $this->Form->input('Empresa.nombre');
echo $this->Form->input('Empresa.direccion');
echo $this->Form->input('Empresa.cp');
echo $this->Form->input('Empresa.telefono');
echo $this->Form->input('Empresa.municipio');
//echo $this->Form->select('Empresa.pais_id', $paises);
echo $this->Form->input('Empresa.pais_id');
echo $this->Html->link('Añadir País', array(
	'controller'=>'paises',
	'action'=>'add',
	'from_controller' => 'proveedores',
	'from_action' => 'add'
	)
);
echo $this->Form->input('Empresa.cif');
echo $this->Form->input('Empresa.codigo_contable');
echo $this->Form->input('Empresa.cuenta_bancaria');
//echo $this->Form->input('BancoPrueba.bic');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->end('Guardar Proveedor');
?>
</div>