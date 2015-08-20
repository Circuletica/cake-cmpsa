<h2>Modificar Línea de Transporte: Operación <?php echo $operacion['Operacion']['referencia'] ?><em></h2>
<?php
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
'controller'=>'operaciones',
'action'=>'view_trafico',
$operacion['Operacion']['id']
));
$this->Html->addCrumb('Añadir Transporte', array(
'controller' => 'transportes',
'action' => 'edit')
);
?>
<?php
	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte');
	?>
	<div class="col2">
	<?php
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
	?>
	</div>
	<div class="formuboton">
		<ul>
			<li>
			<?php
			echo $this->Form->input('puerto_id',
				array('
					label'=>'Puerto destino',
					'empty' =>true
					));
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
		<div class="formuboton">
		<ul>
			<li>
			<?php
			echo $this->Form->input('naviera_id',
				array(
					'label'=>'Naviera',
					'empty' =>true 
					));
			?>
			</li>
			<li>
				<div class="enlinea">
				<?php
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Naviera',
					 array(
					'controller'=>'navieras',
					'action'=>'add'),
					array(
					"class"=>"botond",
					'escape' => false)
				);
				?>
				</div>
			</li>
		</ul>
		</div>
		<div class="formuboton">
		<ul>
			<li>
			<?php
			echo $this->Form->input('agente_id',
				array(
					'label'=>'Agente aduanas',
					'empty' =>true 
				));
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
	<br><br>
	<h3>Fechas</h3>
<div class="linea">
	<?php
	echo $this->Form->input('fecha_carga', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha de carga',
	'empty' => ' ')
	);

	echo $this->Form->input('fecha_llegada', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha de llegada',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_pago', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha de pago',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_enviodoc', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha de envío documentación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_entradamerc', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha Entrada mercancía',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_despacho_op', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha despacho operación',
	'empty' => ' ')
	);

	echo $this->Form->input('fecha_reclamacion', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha de reclamación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_limite_retirada', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha límite de retirada',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_reclamacion_factura', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha reclamacion factura',
	'empty' => ' ')
	);
	?>
	</div>

	<?php
	echo $this->Form->input('observaciones', array('label'=>'Observaciones del transporte'));

	?>
<div class="detalladoform">
<h3>Seguro</h3>
		<div class="formuboton">
			<ul>
			<li><?php
			echo $this->Form->input('aseguradora_id',array('label'=>'Aseguradora'));
			?>
			</li>
			<li>
			<div class="enlinea">
				<?php            
				echo $this->Html->link('<i class="fa fa-plus"></i> Aseguradora', array(
				'controller'=>'aseguradoras',
				'action'=>'add'),array("class"=>"botond", 'escape' => false)
				);
				?>
			</div>
			</li>
			</ul>
		</div>
		<div class="linea">
		<?php
		echo $this->Form->input('fecha_seguro', array(
		'dateFormat' => 'DMY',
		'timeFormat' => null ,
		'label' => 'Fecha del seguro',
		'empty' => ' ')
		);
		?>
		</div>
		<?php
		echo '<label>Coste del seguro</label>';
		//echo $transporte['Transporte']['costeseguro'] .'€';

				echo $this->Form->input('fecha_vencimiento_seg', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Fecha vencimiento seguro',
	'empty' => ' ')
	);
		?>
		
	</div>
	<?php	echo $this->Form->end('Modificar Línea Transporte'); ?>
