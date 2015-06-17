<?php $this->Html->addCrumb('Operaciones', array(
	'controller'=>'operaciones',
	'action'=>'index'
	));
	$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
	'controller'=>'muestras',
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
<h2>Detalles Operación <?php echo 'de '.$tipo.' '.$operacion['Operacion']['referencia']?></h2>
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
	echo "  <dt>Calidad</dt>\n";
	echo "<dd>";
	//echo $operacion['Calidad']['nombre'].'&nbsp;';
	echo $calidad_nombre['CalidadNombre']['nombre'].'&nbsp;';
//	echo $this->Html->link($calidad_nombre['CalidadNombre']['nombre'], array(
//		'controller' => 'calidades',
//		'action' => 'view',
//		$operacion['Operacion']['id'])
//	);
	echo "</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	//echo $operacion['Proveedor']['Empresa']['nombre'].'&nbsp;';
	echo $this->Html->link($operacion['Proveedor']['Empresa']['nombre'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$operacion['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Almacen</dt>\n";
	echo "<dd>";
	echo $this->Html->link( $operacion['Almacen']['Empresa']['nombre'], array(
		'controller' => 'almacenes',
		'action' => 'view',
		$operacion['Almacen']['id'])
	);
	echo "</dd>";
	echo "  <dt>Fecha</dt>\n";
	//no queremos la hora
	//mysql almacena la fecha en formato YMD
	$fecha = $operacion['Operacion']['fecha'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	echo "<dd>";
	echo $dia.'-'.$mes.'-'.$anyo;
	echo "</dd>";
	echo "  <dt>Resultado</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['aprobado'] ? 'Aprobado' : 'Rechazado'.'&nbsp;';
	echo "</dd>";
	echo "  <dt>Incidencia</dt>\n";
	echo "<dd>";
	echo nl2br(h($operacion['Operacion']['incidencia'])).'&nbsp;';
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
	foreach($operacion['LineaOperacion'] as $linea):
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
		'from_id' => $operacion['Operacion']['id']),
		 array('escape' => false,'title'=>'Añadir línea'));
		?>
		</div>
	</div>
</div>

