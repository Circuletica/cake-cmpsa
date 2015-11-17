<h2>Modificar Línea de Transporte: Operación <?php //echo $operacion['Operacion']['referencia'] ?><em></h2>
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operación','/operaciones/index_trafico');
//$this->Html->addCrumb('Transporte ','/operacion/view_trafico/'.$operacion['Operacion']['id']);
?>
<?php
	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte');
?>
<fieldset>
<?php
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
	echo $this->Form->input('EmbalajeTransprote.cantidad', array('label' => 'Cantidad transportada'));
	?>
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
	</fieldset>
	<br><br>
	<fieldset>
	<legend>Fechas</legend>
	<div class="col2">
	<div class="linea">
	<?php
	echo $this->Form->input('fecha_carga', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Carga mercancía',
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
	'label' => 'Pago',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_enviodoc', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Envío documentación',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_entradamerc', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Entrada mercancía',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_despacho_op', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Despacho operación',
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
	'label' => 'Límite de retirada',
	'empty' => ' ')
	);
	echo $this->Form->input('fecha_reclamacion_factura', array(
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+2,
	'orderYear' => 'asc',
	'timeFormat' => null ,
	'label' => 'Reclamación factura',
	'empty' => ' ')
	);
	?>
	</div>
	</div>
	</fieldset>
	<fieldset>
	<?php
	echo $this->Form->input('observaciones', array('label'=>'Observaciones del transporte'));
	?>
</fieldset>
<fieldset>
<legend>Aseguradora</legend>
		<div class="col3">
		<div class="formuboton">
			<ul>
			<li><?php
			echo $this->Form->input('aseguradora_id',
				array(
					'label'=>'Aseguradora',
					'empty' =>true));
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
		'minYear' => date('Y')-1,
		'maxYear' => date('Y')+2,
		'orderYear' => 'asc',
		'timeFormat' => null ,
		'label' => 'Fecha del seguro',
		'empty' => ' ')
		);
		?>
		</div>
		<?php
		echo $this->Form->input('coste_seguro',array('label'=>'Coste del seguro €'));
		?>
		</div>

		<?php	
		echo $this->Html->link('Cancelar', $this->request->referer(''), array('class' => 'botond'));
		echo $this->Form->end('Modificar Línea Transporte'); ?>
</fieldset>

