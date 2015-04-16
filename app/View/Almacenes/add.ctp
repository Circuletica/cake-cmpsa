<h2>Añadir Almacén</h2>
<?php
echo $this->Html->script('jquery')."\n"; // Include jQuery library
echo $this->Html->script('jquery.maskedinput')."\n"; // Include masked input jQuery plugin
?>
<script type="text/javascript">
jQuery(function($) {
	$('#EmpresaCuentaBancaria').mask("9999-9999-99-9999999999");
});
</script>

<?php
//$this->Html->addCrumb('Almacenes', '/almacenes');
$this->Html->addCrumb('Almacenes', array(
	'controller' => 'almacenes',
	'action' => 'index')
);
//$this->Html->addCrumb('Añadir Almacén', '/almacenes/add');
$this->Html->addCrumb('Añadir Almacén', array(
	'controller' => 'almacenes',
	'action' => 'add')
);
echo $this->Form->create('Almacen', array(
	'controller' => 'almacenes',
	'action' => 'add'));
	?>
	<fieldset>
	<?php
echo $this->Form->input('Empresa.nombre');
echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	?>
	</fieldset>
	<fieldset>
	<?php
echo $this->Form->input('Empresa.municipio');
//echo $this->Form->select('Empresa.pais_id', $paises);
echo $this->Form->input('Empresa.pais_id', array('label'=>'País'));
//	'controller'=>'paises',
//	'action'=>'add')
//);
echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
	?>
	</fieldset>
	<fieldset>
	<?php
echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
echo $this->Form->input('Empresa.cuenta_bancaria');
//echo $this->Form->input('BancoPrueba.bic');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->end('Guardar Almacén');
?>

