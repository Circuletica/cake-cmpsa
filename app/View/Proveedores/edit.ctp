<h2>Modificar Proveedor</h2>
<?php
 $this->Html->addCrumb('Proveedores', array(
	'controller'=>'proveedores',
	'action'=>'index'
	));
	$this->Html->addCrumb($proveedor['Empresa']['nombre'], array(
	'controller'=>'proveedores',
	'action'=>'view',
	$proveedor['Empresa']['id']
));

//$this->Html->addCrumb('Modificar Proveedor', 'proveedores/edit');
echo $this->Form->create('Proveedor', array('action' => 'edit'));
?>
<fieldset>
	<?php
	echo $this->Form->input('Empresa.nombre');
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
		?><div class="columna2">
		<?php
		echo $this->Form->input('Empresa.cp',array('label'=>'Código Postal'));
		echo $this->Form->input('Empresa.municipio');
		//echo $this->Form->select('Empresa.pais_id', $paises,
		//	array('label' => 'País'
		//	)
		//);
		?>
				<div class="formuboton">
				<ul>
			     	<li><?php
					echo $this->Form->input('Empresa.pais_id',array('label'=>'País'));
					?></li>
					<li><div class="enlinea">
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
			echo $this->Form->input('Empresa.telefono',array('label'=>'Teléfono'));
			?>
		</div>
	<?php
	echo $this->Form->input('Empresa.cif',array('label'=>'CIF'));
	echo $this->Form->input('Empresa.codigo_contable',array('label'=>'Código Contable'));
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('Empresa.bic', array(
		'label'=>'BIC'
		)
	);
	//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
	echo $this->Form->input('id',array('type'=>'hidden'));
	echo $this->Form->end('Guardar proveedor');
	?>
</fieldset>
