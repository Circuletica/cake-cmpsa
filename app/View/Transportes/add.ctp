
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
'controller'=>'operaciones',
'action'=>'view_trafico',
$operacion['Operacion']['id']
));
$this->Html->addCrumb('Añadir Transporte');
?>

<fieldset>
<h2>Añadir Línea de Transporte: Operación <?php echo $operacion['Operacion']['referencia'] ?><em></h2>
<?php
	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte');
	?>
	<div class="col2">
	<?php
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
	//echo $this->Form->input('embalaje_id',array('label'=>'Tipo de bulto','empty' =>true));
	echo $this->Form->input('cantidad', array('label' => 'Cantidad bultos'));
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
		<?php
		// id = 3 es el valor de IN STORE
		//echo $operacion['Contrato']['Incoterm']['nombre']
		//if ($incoterms['Contrato']['Incoterm']['id'] != 3 ){ 
		?>		<div class="formuboton">
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
	<div class="columna3">
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
	<?php
	echo $this->Form->input('observaciones', array('label'=>'Observaciones del transporte'));

	?>
<div class="detalladoform">
<h3>Seguro</h3>
		<div class="columna3">
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
</div>
	<?php	echo $this->Form->end('Guardar Línea Transporte'); ?>
</fieldset>		