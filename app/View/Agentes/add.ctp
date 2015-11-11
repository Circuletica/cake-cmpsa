<h2>Añadir Agente</h2>
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
$this->Html->addCrumb('Agentes', array(
	'controller' => 'agentes',
	'action' => 'index')
);
//$this->Html->addCrumb('Añadir Almacén', '/almacenes/add');
$this->Html->addCrumb('Añadir Agente', array(
	'controller' => 'agentes',
	'action' => 'add')
);
echo $this->Form->create('Agente', array(
	'controller' => 'agentes',
	'action' => 'add'));
	?>
	<div class="col2">
	<?php
echo $this->Form->input('Empresa.nombre_corto');
echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal'));
	?>
	</div>
	<div class="col3">
	<?php
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	echo $this->Form->input('Empresa.municipio');
			?>
		</div>
		<div class="col2">
		<?php
//echo $this->Form->select('Empresa.pais_id', $paises);
echo $this->Form->input('Empresa.pais_id', array('label'=>'País'));
//	'controller'=>'paises',
//	'action'=>'add')
//);
echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
	?>
	</div>
	<div class="col4">
	<?php
	echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
	echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('Empresa.bic', array('label'=>'BIC'));
	?>
	</div>
	<?php
//echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');

echo $this->Form->end('Guardar Agente');
?>
