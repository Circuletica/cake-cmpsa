<?php $this->Html->addCrumb('Muestras', array(
	'controller'=>'muestras',
	'action'=>'index'
	));
	$this->Html->addCrumb('Muestra '.$muestra['Muestra']['referencia'], array(
	'controller'=>'muestras',
	'action'=>'view',
	$muestra['Muestra']['id']
));
?>
<?php
	echo "<div class='actions'>\n";
	echo $this->Html->link('Modificar muestra',array(
		'action'=>'edit',
		$muestra['Muestra']['id'])
	);
	echo "\n";
	echo '<p>';
	echo $this->Form->postLink('Borrar muestra',array(
		'action'=>'delete',
		$muestra['Muestra']['id']),
		array('confirm'=>'¿Realmente quiere borrar '.$muestra['Muestra']['referencia'].'?')
	);
	echo $this->Html->link('Añadir línea',array(
		'controller' => 'linea_muestras',
		'action' => 'add',
		'from_controller' => 'muestras',
		'from_id' => $muestra['Muestra']['id'])
	);
	echo "\n";
	echo "</div>\n";
?>
<div class="index">
<h2>Detalles Muestra <?php echo $muestra['Muestra']['referencia']?></h2>
</div>
<?php
	echo "<div class='view'>\n";
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
	//echo $muestra['Calidad']['nombre'].'&nbsp;';
	echo $calidad_nombre['CalidadNombre']['nombre'].'&nbsp;';
//	echo $this->Html->link($calidad_nombre['CalidadNombre']['nombre'], array(
//		'controller' => 'calidades',
//		'action' => 'view',
//		$muestra['Muestra']['id'])
//	);
	echo "</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	//echo $muestra['Proveedor']['Empresa']['nombre'].'&nbsp;';
	echo $this->Html->link($muestra['Proveedor']['Empresa']['nombre'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$muestra['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Almacen</dt>\n";
	echo "<dd>";
	echo $muestra['Almacen']['Empresa']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Fecha</dt>\n";
	//no queremos la hora
	//mysql almacena la fecha en formato YMD
	$fecha = $muestra['Muestra']['fecha'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	echo "<dd>";
	echo $dia.'-'.$mes.'-'.$anyo;
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
			$this->Html->link('Detalles', array(
				'controller'=>'linea_muestras',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'muestras',
              			'from_id'=>$linea['muestra_id']),array('class'=>'botond'))
				.' '.$this->Form->postLink('Borrar',
				array(
					'controller'=>'linea_muestras',
					'action' => 'delete',
					$linea['id'],
					'from_controller' => 'muestras',
					'from_id' => $linea['muestra_id']),
					array('class'=>'botond',
						'confirm' => '¿Seguro que quieres borrar a '.$linea['marca'].'?')
				)
			));
		//numero de la línea siguiente
		$i++;
	endforeach;
?>
	</table>
	</div></div>

