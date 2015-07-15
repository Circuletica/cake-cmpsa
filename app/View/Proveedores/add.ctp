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
<?php
$this->Html->addCrumb('Proveedores', array(
	'controller' => 'proveedores',
	'action' => 'index'));
$this->Html->addCrumb('Añadir Proveedor', array(
	'controller' => 'proveedores',
	'action' => 'add'));
echo $this->Form->create('Proveedor');
?>

<fieldset>
	<?php
		echo $this->Form->input('Empresa.nombre_corto');
		echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal');
		echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	?>
	<div class="columna3">
	<?php
		echo $this->Form->input('Empresa.cp', array(
			'label' => 'Código Postal'));
		echo $this->Form->input('Empresa.telefono', array('label'=> 'Teléfono'));
		echo $this->Form->input('Empresa.municipio');
	?>
	<div class="formuboton">
		<ul>
			<li>
			<?php
				//echo $this->Form->select('Empresa.pais_id', $paises);
				echo $this->Form->input('Empresa.pais_id',array(
					'label' => 'País',
					'empty' => true,
					'class' => 'listado'));
			?>
			</li>
			<li>
				<div class="enlinea">
					<?php            
						echo $this->Html->link('<i class="fa fa-plus"></i> Añadir País', array(
							'controller'=>'paises',
							'action'=>'add'),array("class"=>"botond", 'escape' => false)
							);
					?>
				</div>
			</li>
	    	</ul>
	 </div>
	 <?php
	echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
	echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
	?></div>
	<div class="columna2"><?php
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('BancoPrueba.bic', array(
		'label' => 'BIC')
	);
    ?>
    </div>
    <?php
//echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->end('Guardar Proveedor');
?>
</fieldset>
