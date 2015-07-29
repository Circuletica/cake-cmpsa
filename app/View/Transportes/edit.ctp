
<h2>Modificar Línea de Transporte a la Operación xxx<em></h2>
<?php
$this->Html->addCrumb('Línea de Transporte', array(
'controller' => 'transportes',
'action' => 'view')
);
$this->Html->addCrumb('Modificar Transporte', array(
'controller' => 'transportes',
'action' => 'edit')
);
?>
<fieldset>
<?php
	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte', array('action' => 'edit'));
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
	?>
<div class="linea">
	<div class="columna3">
	<?php
	echo $this->Form->input('fecha_carga', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha de carga',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_llegada', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha de llegada',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_pago', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha de pago',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_enviodoc', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha de envío documentación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_entradamerc', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha Entrada mercancía',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_despacho_op', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha despacho operación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_vencimiento_seg', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha vencimiento seguro',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_reclamacion', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha de reclamación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_limite_retirada', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha límite de retirada',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_reclamacion_factura', array(
	'dateFormat' => 'DMY',
	'timeFormat' => null ,
	'label' => 'Fecha reclamacion factura',
	'empty' => ' ')
	);
	echo $this->Form->input('flete');
	echo $this->Form->input('forfait');
	?>
	</div>
</div>
	<div class="formuboton">
	<ul>
		<li>
		<?php
		echo $this->Form->input('puerto_id',
		array('label'=>'Puerto destino'));
		?>
		</li>
		<li>
			<div class="enlinea">
			<?php
			echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Puerto', array(
			'controller'=>'puertos',
			'action'=>'add'),array("class"=>"botond", 'escape' => false)
			);
			?>
			</div>
		</li>
	</ul>
	</div>
<br>
	<div class="formuboton">
	<ul>
		<li>
		<?php
		echo $this->Form->input('naviera_id',array('label'=>'Naviera'));
		?>
		</li>
		<li>
			<div class="enlinea">
			<?php
			echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Naviera', array(
			'controller'=>'navieras',
			'action'=>'add'),
			array("class"=>"botond", 'escape' => false)
			);
			?>
			</div>
		</li>
	</ul>
	</div>
<br><br>
	<div class="formuboton">
	<ul>
		<li>
		<?php
		echo $this->Form->input('agente_id',array('label'=>'Agente Aduanas'));
		?>
		</li>
		<li>
			<div class="enlinea">
			<?php
			echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Agente', array(
			'controller'=>'agentes',
			'action'=>'add'),array("class"=>"botond", 'escape' => false)
			);
			?>
			</div>
		</li>
	</ul>
	</div>
	<?php
	echo $this->Form->input('observaciones', array('label'=>'Observaciones transporte'));

	?>
<div class="detallado">
	<h3>Almacén</h3>
					<div class="formuboton">
					<ul>
						<li><?php
						echo $this->Form->input('almacen_id',array('label'=>'Nombre almacén'));
						?>
						</li>
						<li>
						<div class="enlinea">
								<?php            
								echo $this->Html->link('<i class="fa fa-plus"></i> Almacén', array(
								'controller'=>'almacenes',
								'action'=>'add'),array("class"=>"botond", 'escape' => false)
								);
								?>
						</div>
						</li>
					</ul>
				</div>
		<?php
		echo $this->Form->input('cuenta_almacen',array('label'=>'Cuenta corriente / Referencia almacén'));
		echo $this->Form->input('cantidad_cuenta',array('label'=>'Cantidad embalajes en cuenta'));
		echo $this->Form->input('MarcaAlmacen.nombre',array('label'=>'Marca'));
	?> 
</div>
<div class="detallado">
<h3>Aseguradora</h3>
		<?php
		echo $this->Form->input('aseguradora_id',array('label'=>'Nombre aseguradora'));
		?>
		<div class="linea">
		<?php
		echo $this->Form->input('Seguro.fecha_seguro', array(
		'dateFormat' => 'DMY',
		'timeFormat' => null ,
		'label' => 'Fecha del seguro',
		'empty' => ' ')
		);
		?>
		</div>
		<?php
		echo $this->Form->input('MarcaAlmacen.nombre',array('label'=>'Marca'));
		echo '<label>Nº embalajes</label>';
		//echo $almacenaje['cantidad_cuenta'].' Kg';
		echo '<label>Cantidad Asegurada</label>';
		//echo $almacenaje['cantidad_cuenta'].' Kg';
		echo '<label>Precio de compra</label>';
		//echo $operacion['Operacion']['precio_compra'];

	?>
	</div>
	<?php	echo $this->Form->end('Modificar Línea Transporte'); ?>
</fieldset>