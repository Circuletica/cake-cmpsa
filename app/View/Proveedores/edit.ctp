<h2>Modificar Proveedor: <?php echo $proveedor['Empresa']['nombre_corto']?></h2>
<?php
	$this->Html->addCrumb('Proveedores', array(
		'controller'=>'proveedores',
		'action'=>'index'
		)
	);
	$this->Html->addCrumb($proveedor['Empresa']['nombre'], array(
		'controller'=>'proveedores',
		'action'=>'view',
		$proveedor['Empresa']['id']
		)
	);
	echo $this->Form->create('Proveedor', array('action' => 'edit'));
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
		echo $this->Form->input('Empresa.cp',array('label'=>'Código Postal'));
		echo $this->Form->input('Empresa.municipio');
		?>
		</div>
		<div class="col2">
		<div class="formuboton">
			<ul>
			     	<li><?php
					echo $this->Form->input('Empresa.pais_id',array('label'=>'País'));
					?></li>
					<li><div class="enlinea">
						<?php            
						echo $this->Html->link('<i class="fa fa-plus"></i> Añadir País', array(
							'controller'=>'paises',
							'action'=>'add'
							),
							array(
								"class"=>"botond",
								'escape' => false
							)
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
		<div class="col4">
		<?php
		echo $this->Form->input('Empresa.cif',array('label'=>'CIF'));
		echo $this->Form->input('Empresa.codigo_contable',array('label'=>'Código Contable'));
		echo $this->Form->input('Empresa.cuenta_bancaria');
		echo $this->Form->input('Empresa.bic', array(
			'label'=>'BIC'
			)
		);
	?>
	</div>
	<?php
		//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->end('Guardar proveedor');
	?>

