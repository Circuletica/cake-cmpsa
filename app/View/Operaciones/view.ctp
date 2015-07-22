<?php $this->Html->addCrumb('Operaciones', array(
	'controller'=>'operaciones',
	'action'=>'index'
	));
	$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
	'controller'=>'operacion',
	'action'=>'view',
	$operacion['Operacion']['id']
));
?><div class="acciones">
	<div class="printdet">
	<ul><li>
		<?php 
		echo $this->element('imprimirV');
		?>	
		
	</li>
	<li>
			<?php
		echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
			'action'=>'edit',
			$operacion['Operacion']['id']),array('title'=>'Modificar Operación','escape'=>false))
		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
			'action'=>'delete',
			$operacion['Operacion']['id']),array(
			'escape'=>false, 'title'=> 'Borrar Operación',
			'confirm'=>'¿Realmente quiere borrar '.$operacion['Operacion']['referencia'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>
<h2>Detalles Operación <?php echo $operacion['Operacion']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtrooperacion');
	?>
</div>

	<div class='view'>
	<?php
	echo "<dl>";
	//echo "  <dt>Id</dt>\n";
	//echo "<dd>";
	//echo $operacion['Operacion']['id'].'&nbsp;';
	//echo "</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['referencia'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "<dd>";
	echo $operacion['CalidadNombre']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Agente</dt>\n";
	echo "<dd>";
	echo $this->Html->link($operacion['Transporte']['Agente']['id'], array(
		'controller' => 'transportes',
		'action' => 'view',
		$operacion['Transporte']['Agente']['id'])
	);
	echo "</dd>";
	echo "  <dt>Puerto</dt>\n";
	echo "<dd>";
	echo $this->Html->link( $operacion['Puerto']['nombre'], array(
		'controller' => 'puertos',
		'action' => 'view',
		$operacion['Puerto']['id'])
	);
	echo "</dd>";
	echo "</dl>";?>
	<!--Se hace un index de la Linea de contratos-->
	<div class="detallado">
	<h3>Línea de Contratos</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Línea Contrato', 'Ref. Contrato','Calidad', 'Incoterms','Peso', 'Bolsa', 'Acciones'));

	foreach($operacion['LineaContrato']  as $lineacontrato):
		echo $this->Html->tableCells(array(
			//$contrato['Contrato']['id'],
			$lineacontrato['referencia'],
			$lineacontrato['Contrato']['referencia'],
			$lineacontrato['Contrato']['Incoterm']['nombre'],
			$lineacontrato['CalidadNombre']['nombre'],
			$lineacontrato['Contrato']['peso_comprado'].'kg',
			$lineacontrato['Contrato']['CanalCompra']['nombre'],
			$this->Html->link('Detalles',array('action'=>'view','controller' => 'linea_contratos',$lineacontrato['id']), array('class' =>'boton' ))
	));

	endforeach;

?>	</table>
		<div class="btabla">
	<?php
//		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir',array(
//		'controller' => 'linea_muestras',
//		'action' => 'add',
//		'from_controller' => 'muestras',
//		'from_id' => $operacion['Operacion']['id']),
//		 array('escape' => false,'title'=>'Añadir línea'));
		?>
		</div>
	</div>
	<!--Se listan los asociados que forman parte de la operación-->
	<div class="detallado">
	<h3>Asociados</h3>
	<table>
	<?php
	echo $this->Html->tableHeaders(array('Nombre','Calidad', 'Incoterms',
	       'Cantidad Contenedores', 'Acciones'));
	foreach($operacion['LineaContrato'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['Contrato']['referencia'],
			$linea['Contrato']['CalidadNombre']['nombre'],
			$linea['Contrato']['Incoterm']['nombre'],
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'operaciones',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'operaciones',
              			'from_id'=>$operacion['Operacion']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'operaciones',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'operaciones',
					'from_id'=>$operacion['Operacion']['id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$operacion['Operacion']['referencia'].'?')
				)
			));
	endforeach;
?>	</table>

	<!--Se listan las líneas de transporte para la operación-->
	<div class="detallado">
	<h3>Líneas de transporte</h3>
	<table>
<?php
	echo $this->Html->tableHeaders(array('Nombre', 'BL/Matrícula',
	       'Fecha carga', 'Cantidad','Acciones'));
	foreach($operacion['Transporte'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['nombre_vehiculo'],
			$linea['matricula'],
			$linea['fecha_carga'],
			$linea['EmbalajeTransporte']['cantidad'],
			$linea['agente_id'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'operaciones',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'operaciones',
              			'from_id'=>$operacion['Operacion']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'operaciones',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'operaciones',
					'from_id'=>$operacion['Operacion']['id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$operacion['Operacion']['referencia'].'?')
				)
			));
	endforeach;
?>	</table>
</div>	
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Línea Transporte',array(
			'controller' => 'transportes',
			'action' => 'add',
			'from_controller' => 'operaciones',
			'from_id' => $operacion['Operacion']['id']), 
			array('escape' => false,'title'=>'Añadir Línea Transporte'));?>	
	</div>
	</div>
</div>

