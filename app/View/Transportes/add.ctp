<h2>Añadir Línea de Transporte: Operación <?php echo $operacion['Operacion']['referencia'] ?><em></h2>
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
'controller'=>'operaciones',
'action'=>'view_trafico',
$operacion['Operacion']['id']
));
$this->Html->addCrumb('Añadir Transporte');
if($operacion['Operacion']['id']!= NULL):
	$suma = 0;
	$transportado=0;
		foreach ($operacion['Transporte'] as $suma):
			if ($transporte['operacion_id']=$operacion['Operacion']['id']):
			$transportado = $transportado + $suma['cantidad'];
			endif;
		endforeach;
	endif;
echo '<h4>Cantidad/Bultos operación: '.$operacion['PesoOperacion']['cantidad_embalaje'].'</h4>';
$transportado = $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado;
echo '<h4>Cantidad/Bultos por transportar: '.$transportado.'</h4>';

	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte');
	?>
	<br>
	<div class="col3">
	<?php
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
	//echo $this->Form->input('embalaje_id',array('label'=>'Tipo de bulto','empty' =>true));
	echo $this->Form->input('cantidad', array('label' => 'Cantidad bultos'));
	?>
	</div>
	<div class="col3">
	<div class="formuboton">
		<ul>
			<li>
			<?php
			echo $this->Form->input('puerto_id',
				array('
					label'=>'Puerto destino',
					'empty' =>array('' => 'Selecciona')
					)
				);
			?>
			</li>
			<li>
				<div class="enlinea">
				<?php
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Puerto', array(
				'controller'=>'puertos',
				'action'=>'add',
				'from_controller' => $this->params['named']['from_controller'],
				'from_id' => $this->params['named']['from_id'] ),
				array("class"=>"botond", 'escape' => false, 'title'=>'Añadir puerto destino')
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
							'empty' =>array('' => 'Selecciona')
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
					'empty' =>array('' => 'Selecciona')
				));
			?>
			</li>
			<li>
				<div class="enlinea">
				<?php
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Agente', array(
				'controller'=>'agentes',
				'action'=>'add',
				$this->params['named']['from_id']),
				array("class"=>"botond", 'escape' => false)
				);
				?>
				</div>
			</li>
		</ul>
		</div>
		</div>
	<br>

<fieldset>
<legend>Fechas</legend>
	<div class='col2'>
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
			<br><br>
		</div>
	</div> 
		<?php
		echo $this->Form->input('observaciones', array('label'=>'Observaciones del transporte'));
		?>	
</fieldset>

<!-- Seguro de la línea transporte -->
<fieldset>
<legend>Seguro</legend>
	<div class="formuboton">
		<ul>
		<li><?php
				echo $this->Form->input('aseguradora_id',
					array(
					'label'=>'Aseguradora',
					'empty' =>array('' => 'Selecciona')
					)
				);
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
	<div class="col3">
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
		echo $this->Form->input('coste_seguro',array('label'=>'Coste del seguro'));
		echo $this->Form->input('suplemento_seguro',array('label'=>'Suplemento'));
		echo $this->Form->input('peso_factura',array('label'=>'Peso facturado'));
		echo $this->Form->input('peso_neto',array('label'=>'Peso neto'));
		echo $this->Form->input('averia',array('label'=>'Avería'));
		?>	
		</div>
	<div class="formuboton">
    <ul>
     	<li>
     	<?php
  		 echo $this->Html->Link('<i class="fa fa-times"></i> Cancelar', $this->request->referer(''), array('class' => 'botond', 'escape'=>false));
  		?>
     	</li>
     	<li>
  		<?php           
		echo $this->Form->end('Guardar Línea Transporte', array('escape'=>false));
 		?>
      	</li>
  	</ul>
  	</div>
</fieldset>
