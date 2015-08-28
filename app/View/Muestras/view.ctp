<?php $this->Html->addCrumb('Muestras', array(
	'controller'=>'muestras',
	'action'=>'index'
	));
	$this->Html->addCrumb('Muestra '.$muestra['Muestra']['referencia'], array(
	'controller'=>'muestras',
	'action'=>'view',
	$muestra['Muestra']['id']
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
			$muestra['Muestra']['id']),array('title'=>'Modificar Muestra','escape'=>false))
		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
			'action'=>'delete',
			$muestra['Muestra']['id']),array(
			'escape'=>false, 'title'=> 'Borrar Muestra',
			'confirm'=>'¿Realmente quiere borrar '.$muestra['Muestra']['referencia'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>
<h2>Detalles Muestra <?php echo 'de '.$tipo.' '.$muestra['Muestra']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>

	<div class='view'>
	<?php
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $muestra['Muestra']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "<dd>";
	echo $muestra['Muestra']['referencia'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "<dd>";
	echo $calidad_nombre['CalidadNombre']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->Html->link($muestra['Proveedor']['Empresa']['nombre'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$muestra['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Almacen</dt>\n";
	echo "<dd>";
	echo $this->Html->link( $muestra['Almacen']['Empresa']['nombre'], array(
		'controller' => 'almacenes',
		'action' => 'view',
		$muestra['Almacen']['id'])
	);
	echo "</dd>";
	echo "  <dt>Fecha</dt>\n";
	echo "<dd>";
	echo $this->Date->format($muestra['Muestra']['fecha']);
	echo "</dd>";
	echo "  <dt>Resultado</dt>\n";
	echo "<dd>";
	echo $muestra['Muestra']['aprobado'] ? 'Aprobado' : 'Rechazado'.'&nbsp;';
	echo "</dd>";
	echo "  <dt>Incidencia</dt>\n";
	echo "<dd>";
	echo nl2br(h($muestra['Muestra']['incidencia'])).'&nbsp;';
	echo "</dd>";
	echo "</dl>";?>
	<div class="detallado">
	<h3>Líneas</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Id','Marca', 'Número de Sacos',
	       'Ref. Proveedor', 'Ref Almacén', 'Acciones'));
	//mostramos todas las catas de esta muestra
	//hay que numerar las líneas
	$i = 1;
	foreach($muestra['LineaMuestra'] as $linea):
		echo $this->Html->tableCells(array(
			$i,
			$linea['marca'],
			$linea['numero_sacos'],
			$linea['referencia_proveedor'],
			$linea['referencia_almacen'],
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
		//numero de la línea siguiente
		$i++;
	endforeach;
?>	</table>
		<div class="btabla">
		<?php
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir',array(
		'controller' => 'linea_muestras',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_id' => $muestra['Muestra']['id']),
		 array('escape' => false,'title'=>'Añadir línea'));
		?>
		</div>
	</div>
</div>

