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
		echo $this->element('imprimir');
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
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['referencia'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Naviera</dt>\n";
	echo "<dd>";
	echo $operacion['Naviera']['Empresa']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Agente</dt>\n";
	echo "<dd>";
	echo $this->Html->link($operacion['Agente']['Empresa']['nombre'], array(
		'controller' => 'agentes',
		'action' => 'view',
		$operacion['Agente']['id'])
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
	<div class="detallado">
	<h3>Líneas</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Referencia Contrato','Calidad', 'Incoterms',
	       'Cantidad Contenedores', 'Acciones'));
	foreach($operacion['LineaContratosOperacion'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['LineaContrato']['Contrato']['referencia'],
			$linea['LineaContrato']['Contrato']['CalidadNombre']['nombre'],
			$linea['LineaContrato']['Contrato']['Incoterm']['nombre'],
			$linea['cantidad_contenedores'],
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'linea_muestras',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'muestras',
              			'from_id'=>$linea['muestra_id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
				array(
					'controller'=>'linea_muestras',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'muestras',
					'from_id' => $linea['muestra_id']),
					array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
						'confirm' => '¿Seguro que quieres borrar a '.$linea['marca'].'?')
				)
			));
	endforeach;
?>	</table>
		<div class="btabla">
		<?php
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir',array(
		'controller' => 'linea_muestras',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_id' => $operacion['Operacion']['id']),
		 array('escape' => false,'title'=>'Añadir línea'));
		?>
		</div>
	</div>
	<div class="detallado">
	<h3>Transportes</h3>
	</div>
</div>

