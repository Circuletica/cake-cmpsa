<h2>Modificar Banco</h2>
<?php
	$this->Html->addCrumb('Bancos',array(
	'controller'=>'bancos',
	'action'=>'index'
	));
	echo $this->Form->create('Banco', array('action' => 'edit'));
	?>
	<fieldset><?php
	echo $this->Form->input('Empresa.nombre_corto', array('label' => 'Nombre corto'));
	echo $this->Form->input('Empresa.nombre', array('label' => 'Denominación legal'));
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
	?>
	<div class="columna3"><?php
	echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	echo $this->Form->input('Empresa.municipio');
	//echo $this->Form->select('Empresa.pais_id', $paises, array('label' => 'País')
	//	);	
	?>
	<div class="formuboton">
		<ul>
		   	<li><?php
			echo $this->Form->input('Empresa.pais_id',array('label'=>'País'));
				
				//echo $this->Html->link('Añadir País', array(
				//'controller'=>'paises',
				//'action'=>'add'));
				?>
			</li>
			<li>
			<div class="enlinea">
				<?php            
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir País', array(
						'controller'=>'paises',
						'action'=>'add'),
						array("class"=>"botond", 'escape' => false)
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
	?></div>
	<div class="columna3"><?php
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('BancoPrueba.bic', array('label'=>'BIC'));
	echo $this->Form->input('BancoPrueba.cuenta_cliente_1', array('label'=>'Cuenta Cliente Nº1'));
	//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
	      ?>
    </div>
    <?php
	echo $this->Form->input('id',array('type'=>'hidden'));
	echo $this->Form->end('Guardar banco'); 
?></fieldset>