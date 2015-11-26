<h2>Modificar Línea de Transporte</h2>
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operación','/operaciones/index_trafico');
//$this->Html->addCrumb('Transporte ','/operacion/view_trafico/'.$operacion['Operacion']['id']);
 /*   $suma = 0;
    $transportado=0;
        foreach ($transporte['Transporte']['cantidad_embalaje'] as $suma):
            if ($transporte['operacion_id']=$transporte['Transporte']['Operacion']['id']):
            $transportado = $transportado + $suma;
        	echo $transportado;
            endif;
        endforeach;*/

echo '<h4>Bultos operación: '.$operacion['PesoOperacion']['cantidad_embalaje'].'</h4>';
/*$transportado = $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado;
echo '<h4>Bultos pendientes: '.$transportado.'</h4>';*/
	//Formulario para rellenar transporte
	echo $this->Form->create('Transporte');
	?>
	<div class="col3">
	<?php
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));
    echo $this->Form->input('cantidad_embalaje', array('label' => 'Cantidad de '.$embalaje['Embalaje']['nombre']));
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
					'empty' =>array('' => 'Selecciona')	
					)
				);
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
				'action'=>'add'),array("class"=>"botond", 'escape' => false)
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
				<br><br>
			</div>
	</div>
	<?php
	echo $this->Form->input('observaciones', array('label'=>'Observaciones del transporte'));
	?>
</fieldset>
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
	
		<?php
		echo $this->Form->input('coste_seguro',array('label'=>'Coste del seguro'));
		echo $this->Form->input('suplemento_seguro',array('label'=>'Suplemento'));
		echo $this->Form->input('peso_factura',array('label'=>'Peso facturado'));
		echo $this->Form->input('peso_neto',array('label'=>'Peso neto'));
		echo $this->Form->input('averia',array('label'=>'Avería'));
		?>
	<div class="formuboton">
    <ul>
      <li><?php
  		  echo $this->Html->Link('<i class="fa fa-times"></i> Cancelar', $this->request->referer(''), array('class' => 'botond', 'escape'=>false));
  		?>
      </li>
      <li style="margin: 0">
  <?php           
		echo $this->Form->end('Modificar Línea Transporte');
?>
      </li>
    </ul>
  </div>
</fieldset>

