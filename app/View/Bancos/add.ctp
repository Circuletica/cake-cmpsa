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
	$this->Html->addCrumb('Bancos', array(
		'controller' => 'bancos',
		'action' => 'index')
	);

	$this->Html->addCrumb('Añadir Banco', array(
		'controller' => 'bancos',
		'action' => 'add')
	);
	echo $this->Form->create('Banco', array('action' => 'add'));
?>
<fieldset>
	<?php
	echo $this->Form->input('Empresa.nombre_corto');
	echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal'));
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	?>
	<div class="columna3">
		<?php
		echo $this->Form->input('Empresa.cp', array(
			'label' => 'Código Postal'));
		echo $this->Form->input('Empresa.municipio');
		?>
		<div class="formuboton">
			<ul>
				<li>
				<?php
				echo $this->Form->input('Empresa.pais_id', array(
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
		echo $this->Form->input('Empresa.telefono', array('label'=> 'Teléfono'));
		echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
		echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));	
	?>
	</div>
	<div class="columna3"><?php
		echo $this->Form->input('Empresa.cuenta_bancaria');
		echo $this->Form->input('Banco.bic', array('label'=>'BIC'));
		echo $this->Form->input('Banco.cuenta_cliente_1',array('label'=>'Cuenta Cliente Nº1'));
		?>
	</div>
	<?php echo $this->Form->end('Guardar banco'); ?>
</fieldset>
