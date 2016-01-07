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
<h2>Operación <?php echo $operacion['Operacion']['referencia']//.' / Contrato'.$contrato['Contrato']['referencia'] ?></h2>
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
	echo $operacion['Contrato']['Incoterm']['nombre'].'&nbsp;';
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
	       'Fecha Carga','Bultos','Asegurado','Detalle'));
	//hay que numerar las líneas
	$i = 1;
	foreach($operacion['Transporte'] as $linea):
		echo $this->Html->tableCells(array(
			$i,
			$linea['nombre_vehiculo'],
			$linea['matricula'],
			//Nos da el formato DD-MM-YYYY
			$this->Date->format($linea['fecha_carga']),
			$linea['cantidad_embalaje'],
			$this->Date->format($linea['fecha_seguro']),
			//$linea['referencia_almacen'],
			$this->Button->viewLine('transportes',$linea['id'],'transportes',$linea['operacion_id'])
			));
		//numero de la línea siguiente
		$i++;
	endforeach;
?>	</table>
<?php
	echo "<h4>Bultos transportados: ".$transportado."</h4>";
?>
		<div class="btabla">
		<?php
		echo $this->Button->addLine('transportes','operaciones',$operacion['Operacion']['id'],'transporte');
		?>
		</div>
	</div>
	<br><br>		<!--Se listan los asociados que forman parte de la operación-->

	<div class="detallado">
	<h3>Resumen retiradas</h3>
	<table>
		<?php
		//Se calcula la cantidad total de bultos retirados

		echo $this->Html->tableHeaders(array('Asociado','Sacos','Peso solicitado', 'Sacos retirados','Peso retirado','Detalle'));
		foreach ($lineas_retirada as $linea_retirada):
			echo $this->Html->tableCells(array(
				$linea_retirada['Nombre'],
				$linea_retirada['Cantidad'],
				$linea_retirada['Peso'],
				$linea_retirada['Cantidad_retirado'],
				$linea_retirada['Peso_retirado'],
				//$this->Button->viewLine('retiradas',$linea['operacion_id'],'operaciones',$linea['operacion_id'])
				)
			);
		endforeach;
		?>
		</table>
<table>
<?php
echo $this->html->tablecells(array(
    'TOTALES',
    array(
	$this->Number->round($totales['total_sacos']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#00FF00'
	)
    ),
    array(
	$this->Number->round($totales['total_peso_solicitado']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#00FF00'
	)
    ),
    array(
	$this->Number->round($totales['total_sacos_retirado']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#00FF00'
	)
    ),
    array(
	$this->Number->round($totales['total_peso_retirado']),
	array(
	    'style' => 'text-align:right',
	    'bgcolor' => '#00FF00'
	)
    ),

)
	);
?></table>
		<div class="btabla">
		<?php
		echo $this->Button->addLine('retiradas','operaciones',$operacion['Operacion']['id'],'retirada');
		?>
		</div>
	</div>
	</div>
</div>

