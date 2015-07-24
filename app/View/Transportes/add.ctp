
<h2>Añadir Línea de Transporte a la Operación xxx<em><?php// echo $operaciones['referencia']?></em></h2>
<?php
	$this->Html->addCrumb('Línea de Transporte', array(
		'controller' => 'Transportes',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Transporte', array(
		'controller' => 'transportes',
		'action' => 'add')
	);
?>

<fieldset>
    <?php
   
	    //Formulario para rellenar transporte
	?>
<div class="col2">
	<?php
	echo $this->Form->create('Transporte', array('action' => 'add'));
	echo $this->Form->input('nombre_vehiculo', array('label' => 'Nombre del transporte'));
	echo $this->Form->input('matricula', array('label' => 'BL/Matrícula'));	
	?>
</div>
<div class="linea">
	<div class='columna3'>
		 <?php
		 echo $this->Form->input('fecha_entradamerc', array(
		 'dateFormat' => 'DMY',
		 'timeFormat' => null ,
		 'label' => 'Fecha Entrada mercancía',
		 'empty' => ' ')
		 );
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
<div class='columna3'>
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
	<br><br>
	<div class="formuboton">
			<ul>
	    	<li>
			<?php
			echo $this->Form->input('naviera_id', 
				array('label'=>'Naviera'));
			?>
			</li>
			<li>
			<div class="enlinea">
				<?php            
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Naviera', array(
					'controller'=>'navieras',
					'action'=>'add'),array("class"=>"botond", 'escape' => false)
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
			echo $this->Form->input('agente_id', 
				array('label'=>'Agente Aduanas'));
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
 	<?php
	echo $this->Form->input('observaciones');
	echo $this->Form->end('Guardar Transporte');
	?>

</fieldset>