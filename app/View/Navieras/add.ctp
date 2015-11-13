<h2>Añadir Naviera</h2>
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
$this->Html->addCrumb('Navieras', array(
	'controller' => 'navieras',
	'action' => 'index')
);
//$this->Html->addCrumb('Añadir Almacén', '/almacenes/add');
$this->Html->addCrumb('Añadir Navieras', array(
	'controller' => 'navieras',
	'action' => 'add')
);
echo $this->Form->create('Naviera', array(
	'controller' => 'navieras',
	'action' => 'add'));
	?>
<fieldset>
	<?php
	echo $this->Form->input('Empresa.nombre_corto');
	echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal'));
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
		?>
	<div class="columna3">
	<?php
	echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	echo $this->Form->input('Empresa.municipio');
	?>
	<div class="formuboton">
		<ul>
	    	<li>
			<?php
			echo $this->Form->input('Empresa.pais_id', 
				array('label'=>'País'));
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
	echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
	echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
	echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
	echo "</div>\n";
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('Empresa.bic', array('label'=>'BIC'));
	echo $this->Form->input('Empresa.website', array(
	    'label'=>'Sitio web',
	    'between'=>'http://'
	));
	echo $this->Form->end('Guardar Naviera');
	?>
</fieldset>

