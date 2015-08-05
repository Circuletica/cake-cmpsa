<?php $this->Html->addCrumb('Contratos', array(
	'controller'=>'contratos',
	'action'=>'index'
	));
	$this->Html->addCrumb('Contrato '.$operacion['Contrato']['referencia'], array(
		'controller'=>'contratos',
		'action'=>'view',
		$operacion['Contrato']['id']
	));
?>
<h2>Detalles Operacion <?php echo $operacion['Operacion']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>
<div class="acciones">
<?php echo
	$this->Html->link(
		'<i class="fa fa-pencil-square-o"></i> Modificar',
		array(
			'action'=>'edit',
			$operacion['Operacion']['id']),
		array(
			'title'=>'Modificar Operacion',
			'escape'=>false
		)
	).' '.
	$this->Form->postLink(
		'<i class="fa fa-trash"></i> Borrar',
		array(
			'action'=>'delete',
			$operacion['Operacion']['id'],
			'from_controller' => 'contratos',
			'from_id' => $operacion['Contrato']['id']
		),
		array(
			'escape'=>false,
			'title'=> 'Borrar',
			'confirm'=>'¿Realmente quiere borrar la operacion '.$operacion['Operacion']['referencia'].'?'
		)
	);
?>
</div>
<div class='view'>
	<?php
		echo "<dl>";
		echo "  <dt>Referencia Contrato:</dt>\n";
		echo "  <dd>".$operacion['Contrato']['referencia'].'&nbsp;'."</dd>";
		echo "  <dt>Proveedor:</dt>\n";
		echo "<dd>";
		echo $this->html->link($operacion['Contrato']['Proveedor']['Empresa']['nombre_corto'], array(
			'controller' => 'proveedores',
			'action' => 'view',
			$operacion['Contrato']['Proveedor']['id'])
		);
		echo "  </dd>";
		echo "  <dt>Peso:</dt>\n";
		echo "  <dd>".$operacion['PesoOperacion']['peso'].'kg&nbsp;'."</dd>";
		echo "  <dt>Embalaje:</dt>\n";
		echo "  <dd>".
			$operacion['PesoOperacion']['cantidad_embalaje'].' x '.
			$embalaje['Embalaje']['nombre'].
			' ('.$operacion['PesoOperacion']['peso'].'kg)&nbsp;'."</dd>";
		echo "  <dt>Lotes:</dt>\n";
		echo "  <dd>".$operacion['Operacion']['lotes_operacion'].'&nbsp;'."</dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $operacion['Operacion']['fecha_pos_fijacion'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_fijacion = $dia.'-'.$mes.'-'.$anyo;
		echo "  <dt>Fecha fijación:</dt>\n";
		echo "  <dd>".$fecha_fijacion.'&nbsp;'."</dd>";
		echo "  <dt>Precio fijación:</dt>\n";
		echo "  <dd>".$operacion['Operacion']['precio_fijacion'].
			$operacion['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
//		echo "  <dt>Precio factura:</dt>\n";
//		echo "  <dd>".$operacion['Operacion']['precio_compra'].
//			$operacion['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
		echo "  <dt>Diferencial:</dt>\n";
		echo "  <dd>".$operacion['Contrato']['diferencial'].
			$operacion['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
		if ($operacion['Operacion']['opciones'] != NULL):
			echo "  <dt>Opciones:</dt>\n";
			echo "  <dd>".$operacion['Operacion']['opciones'].
			$operacion['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
		endif;
		echo "  <dt>Cambio dolar/euro:</dt>\n";
		echo "  <dd>".$operacion['Operacion']['cambio_dolar_euro'].'&nbsp;'."</dd>";
		echo "  <dt>Precio €/Tm:</dt>\n";
		echo "  <dd>".$operacion['PrecioOperacion']['precio_euro_tm'].'&nbsp;'."</dd>";
		echo "</dl>";
		echo "<table>";
		echo $this->Html->tableHeaders(array('Asociado', 'Cantidad de embalajes', 'Peso'));
		foreach ($operacion['AsociadoOperacion'] as $linea_asociado):
			$peso_asociado = $linea_asociado['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
			echo $this->Html->tableCells(array(
				$linea_asociado['Asociado']['Empresa']['nombre_corto'],
				$linea_asociado['cantidad_embalaje_asociado'],
				$peso_asociado.'kg'
				)
			);
		endforeach;
		echo "</table>";
?>
