<?php $this->Html->addCrumb('Operaciones', array(
	'controller'=>'operaciones',
	'action'=>'index_trafico'
	));
	$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
	'controller'=>'operaciones',
	'action'=>'view_trafico',
	$operacion['Operacion']['id']
));
?><div class="acciones">
	<div class="printdet">
		<?php 
		echo $this->element('imprimirV');
		?>	
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
	echo "<dl>";
	echo "  <dt>Operación</dt>\n";
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
	echo "  <dt>$tipo_fecha_transporte</dt>\n";
	echo "  <dd>".$fecha_transporte."</dd>";
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
		echo "  <dt>Peso:</dt>\n";
	echo "  <dd>".$operacion['PesoOperacion']['peso'].'kg&nbsp;'."</dd>";
	echo "  <dt>Embalaje:</dt>\n";
	echo "  <dd>".
		$operacion['PesoOperacion']['cantidad_embalaje'].' x '.
				 $embalaje['Embalaje']['nombre'].
				 ' ('.$operacion['PesoOperacion']['peso'].'kg)&nbsp;'."
				 </dd>";
	echo "  <dt>Precio $/Tm total:</dt>\n";
		echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_dolar_tonelada'].'$/Tm&nbsp;'."</dd>";
		if ($operacion['Contrato']['Incoterm']['si_flete']) {
			echo "  <dt>Flete:</dt>\n";
			echo "  <dd>".$operacion['Operacion']['flete'].'$/Tm&nbsp;'."</dd>";
		}
	echo "  <dt>Observaciones</dt>\n";
	echo "  <dd>".$operacion['Operacion']['observaciones'].'&nbsp;'."</dd>";
	echo "</dl>";
	?>
	<!--Se hace un index de la Linea de contratos-->

	<!--Se listan los asociados que forman parte de la operación-->
	<div class="detallado">
	<h3>Líneas de transporte</h3>
	<table>
	<?php
	echo $this->Html->tableHeaders(array('Nº Línea','Nombre Transporte', 'BL/Matrícula',
	       'Fecha Carga','Cantidad/Bultos','Asegurado','Acciones'));
	//hay que numerar las líneas
	$i = 1;
	foreach($operacion['Transporte'] as $linea):
		echo $this->Html->tableCells(array(
			$i,
			$linea['nombre_vehiculo'],
			$linea['matricula'],
			//Nos da el formato DD-MM-YYYY
			$this->Date->format($linea['fecha_carga']),
			$linea['cantidad'],
			//$linea['EmbalajeTransporte']['cantidad'],
			$this->Date->format($linea['fecha_seguro']),
			//$linea['referencia_almacen'],
			$this->Html->link('<i class="fa fa-info-circle"></i> Detalles', array(
				'controller'=>'transportes',
				'action' => 'view',
				$linea['id'],
              			'from_controller'=>'transportes',
              			'from_id'=>$operacion['Operacion']['id']),array(
              			'class'=>'boton','escape' => false,'title'=>'Detalles'))
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
	<br><br>		<!--Se listan los asociados que forman parte de la operación-->
	<div class="detallado">
	<h3>Asociados</h3>
	<table>
		<?php
		echo $this->Html->tableHeaders($columnas_reparto);
		foreach ($lineas_reparto as $codigo => $linea_reparto):
			echo $this->Html->tableCells(array(
				$codigo,
				$linea_reparto['Nombre'],
				$linea_reparto['Cantidad'],
				$linea_reparto['Peso'],
				)
			);
		endforeach;
		?>
		</table>		
	</div>
	</div>
</div>

