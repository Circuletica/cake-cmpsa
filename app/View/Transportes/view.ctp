<?php $this->Html->addCrumb('Transportes', array(
	'controller'=>'operaciones',
	'action'=>'index'
	));
	$this->Html->addCrumb('Transporte '.$transporte['Transporte']['referencia'], array(
	'controller'=>'transporte',
	'action'=>'view',
	$transporte['Transporte']['id']
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
			$transporte['Transporte']['id']),array('title'=>'Modificar Transporte','escape'=>false))
		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
			'action'=>'delete',
			$transporte['Transporte']['id']),array(
			'escape'=>false, 'title'=> 'Borrar Transporte',
			'confirm'=>'¿Realmente quiere borrar '.$transporte['Transporte']['referencia'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>
<h2>Detalles Transporte <?php echo $transporte['Transporte']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtrooperacion');
	?>
</div>

	<div class='view'>
	<?php
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $transporte['Transporte']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "<dd>";
	echo $transporte['Transporte']['referencia'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Naviera</dt>\n";
	echo "<dd>";
	echo $transporte['Naviera']['Empresa']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Agente</dt>\n";
	echo "<dd>";
	echo $this->Html->link($transporte['Agente']['Empresa']['nombre'], array(
		'controller' => 'agentes',
		'action' => 'view',
		$transporte['Agente']['id'])
	);
	echo "</dd>";
	echo "  <dt>Puerto</dt>\n";
	echo "<dd>";
	echo $this->Html->link( $transporte['Puerto']['nombre'], array(
		'controller' => 'puertos',
		'action' => 'view',
		$transporte['Puerto']['id'])
	);
	echo "</dd>";
	echo "</dl>";?>
	<div class="detallado">
	<h3>Contrato</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Referencia Contrato','Calidad', 'Incoterms',
	       'Cantidad Contenedores', 'Acciones'));
	foreach($transporte['LineaContratosTransporte'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['LineaContrato']['Contrato']['referencia'],
			$linea['LineaContrato']['Contrato']['CalidadNombre']['nombre'],
			$linea['LineaContrato']['Contrato']['Incoterm']['nombre'],
			$linea['cantidad_contenedores'],
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'operaciones',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'operaciones',
              			'from_id'=>$transporte['Transporte']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'operaciones',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'operaciones',
					'from_id'=>$transporte['Transporte']['id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$transporte['Transporte']['referencia'].'?')
				)
			));
	endforeach;
?>	</table>
		<div class="btabla">
	<?php
//		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir',array(
//		'controller' => 'linea_muestras',
//		'action' => 'add',
//		'from_controller' => 'muestras',
//		'from_id' => $transporte['Transporte']['id']),
//		 array('escape' => false,'title'=>'Añadir línea'));
		?>
		</div>
	</div>
	<div class="detallado">
	<h3>Líneas de transporte</h3>

	<table>
<?php
	echo $this->Html->tableHeaders(array('Referencia Contrato','Calidad', 'Incoterms',
	       'Cantidad Contenedores', 'Acciones'));
	foreach($transporte['LineaContratosTransporte'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['LineaContrato']['Contrato']['referencia'],
			$linea['LineaContrato']['Contrato']['CalidadNombre']['nombre'],
			$linea['LineaContrato']['Contrato']['Incoterm']['nombre'],
			$linea['cantidad_contenedores'],
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'operaciones',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'operaciones',
              			'from_id'=>$transporte['Transporte']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'operaciones',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'operaciones',
					'from_id'=>$transporte['Transporte']['id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$transporte['Transporte']['referencia'].'?')
				)
			));
	endforeach;
?>	</table>
	</div>
</div>

