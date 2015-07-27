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
<h2>Detalles Operación <?php echo $operacion['Operacion']['referencia']//.' / Contrato'.$contrato['Contrato']['referencia'] ?></h2>
<div class="actions">
	<?php
	echo $this->element('filtrooperacion');
	?>
</div>

	<div class='view'>
	<?php
		//mysql almacena la fecha en formato ymd
//	$fecha = $operacion['Operacion']['Contrato']['fecha_embarque'];
//	$dia = substr($fecha,8,2);
//	$mes = substr($fecha,5,2);
//	$anyo = substr($fecha,0,4);
//	$fecha_embarque = $dia.'-'.$mes.'-'.$anyo;
//	$fecha = $operacion['Operacion']['Contrato']['fecha_entrega'];
//	$dia = substr($fecha,8,2);
//	$mes = substr($fecha,5,2);
//	$anyo = substr($fecha,0,4);
//	$fecha_entrega = $dia.'-'.$mes.'-'.$anyo;
	echo "<dl>";
	echo "  <dt>Referencia</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['referencia'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Contrato</dt>\n";
	echo "<dd>";
	echo $this->html->link($operacion['Contrato']['referencia'], array(
		'controller' => 'contratos',
		'action' => 'view',
		$operacion['Operacion']['contrato_id'])
	);
	echo "</dd>";
	echo "  <dt>Fecha de embarque</dt>\n";
	echo "<dd>";
	echo $operacion['Contrato']['fecha_embarque'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Fecha de entrega</dt>\n";
	echo "<dd>";
	$fecha = $operacion['Contrato']['fecha_entrega'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	echo $fecha_entrega = $dia.'-'.$mes.'-'.$anyo;
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "<dd>";
	echo $operacion['Contrato']['CalidadNombre']['nombre'].'&nbsp;';
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->html->link($operacion['Contrato']['Proveedor']['Empresa']['nombre_corto'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$operacion['Contrato']['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Incoterms</dt>\n";
	echo "<dd>";
	echo $operacion['Contrato']['Incoterm']['nombre'];
	echo "</dd>";
	echo "  <dt>Peso embalaje</dt>\n";
	echo "<dd>";
	echo $operacion['Embalaje']['peso_embalaje'].' Kg';
	echo "</dd>";
	echo "  <dt>Precio de compra</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['precio_compra'];
	echo "</dd>";
	echo "  <dt>Precio fijación </dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['precio_fijacion'];
	echo "</dd>";
	echo "</dl>";?>
	<!--Se hace un index de la Linea de contratos-->

	<!--Se listan los asociados que forman parte de la operación-->
	<div class="detallado">
	<h3>Línea de transporte</h3>
	<table>
	<?php
	echo $this->Html->tableHeaders(array('Nº Línea','Nombre Transporte', 'BL/Matrícula',
	       'Fecha Carga','Cantidad','Asegurado','Acciones'));
	//hay que numerar las líneas
	$i = 1;
	foreach($operacion['Transporte'] as $linea):
		echo $this->Html->tableCells(array(
			$i,
			$linea['nombre_vehiculo'],
			$linea['matricula'],
			$linea['fecha_carga'],
			$linea['embalaje_id'],
			$linea['seguro_id'],
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i>', array(
				'controller'=>'operaciones',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'operaciones',
              			'from_id'=>$operacion['Operacion']['id']),array(
              			'class'=>'botond','escape' => false,'title'=>'Detalles'))
			));
		//numero de la línea siguiente
		$i++;
	endforeach;
?>	</table>
		<div class="btabla">
		<?php
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Línea',array(
		'controller' => 'transportes',
		'action' => 'add',
		'from_controller' => 'operaciones',
		'from_id' => $operacion['Operacion']['id']),
		 array('escape' => false,'title'=>'Añadir línea de transporte'));
		?>
		</div>
	</div>
</div>

