<h2>Añadir Banco</h2>
<?php
echo $this->Html->script('jquery')."\n"; // Include jQuery library
echo $this->Html->script('jquery.maskedinput')."\n"; // Include masked input jQuery plugin
?>
<script type="text/javascript">
jQuery(function($) {
	$('#BancoPruebaCuentaCliente1').mask("9999-9999-99-9999999999");
	$('#EmpresaCuentaBancaria').mask("9999-9999-99-9999999999");
});
</script>
<?php
$this->Html->addCrumb('Bancos', '/banco_pruebas');
$this->Html->addCrumb('Añadir Banco', '/banco_pruebas/add');
echo $this->Form->create('BancoPrueba', array('action' => 'add'));
echo $this->Form->input('Empresa.nombre');
echo $this->Form->input('Empresa.direccion');
echo $this->Form->input('Empresa.cp');
echo $this->Form->input('Empresa.municipio');
//echo $this->Form->select('Empresa.pais_id', $paises);
echo $this->Form->input('Empresa.pais_id');
echo $this->Form->input('Empresa.telefono');
echo $this->Form->input('Empresa.cif');
echo $this->Form->input('Empresa.codigo_contable');
echo $this->Form->input('Empresa.cuenta_bancaria');
echo $this->Form->input('BancoPrueba.bic');
echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->end('Guardar banco');
?>
