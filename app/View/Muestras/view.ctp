<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('titulo', 'Muestra de '.$tipo.' '.$muestra['Muestra']['referencia']);
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('clase','Muestra');
$this->assign('controller','muestras');
$this->Html->addCrumb('Muestras', array(
			'controller'=>'muestras',
			'action'=>'index'
			));
$this->Html->addCrumb('Muestra '.$muestra['Muestra']['referencia'], array(
			'controller'=>'muestras',
			'action'=>'view',
			$muestra['Muestra']['id']
			));
$this->start('filtro');
	echo $this->element('filtromuestra');
$this->end()?> 


	<div class='view'>
	<?php
	echo "<dl>";
	//echo "  <dt>Id</dt>\n";
	//echo "<dd>";
	//echo $muestra['Muestra']['id'].'&nbsp;';
	//echo "</dd>";
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
		if (isset($muestra['Almacen']['Empresa']['nombre'])):
			echo $this->Html->link( $muestra['Almacen']['Empresa']['nombre'], array(
			'controller' => 'almacenes',
			'action' => 'view',
			$muestra['Almacen']['id']));
		else:
			echo '--';
		endif;

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
		 <?php echo $this->Button->addLine('linea_muestras','muestras',$muestra['Muestra']['id'],'Línea');?>
		</div>
	</div>
</div>

