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
$this->Html->addCrumb('Añadir Banco');
echo $this->Form->create('BancoPrueba', array('action' => 'add'));
?>
<fieldset>
	<?php
	echo $this->Form->input('Empresa.nombre');
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	//echo $this->Form->input('Cód Postal', array('Empresa.cp'));
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
			//.$this->Html->link('Añadir País', array(
			//'controller'=>'paises',
			//'action'=>'add'), 
			//array("class"=>"botond"));
			?>
			</li>
			<li>
			<div class="enlinea">
				<?php            
				echo $this->Html->link('Añadir País', array(
					'controller'=>'paises',
					'action'=>'add'),array("class"=>"botond")
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
	<?php
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('BancoPrueba.bic', array('label'=>'BIC'));
	echo $this->Form->input('BancoPrueba.cuenta_cliente_1',array('label'=>'Cuenta Cliente Nº1'));
	//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
	echo $this->Form->end('Guardar banco');
	?>
</fieldset>

