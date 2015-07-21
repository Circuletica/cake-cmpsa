<?php $this->Html->addCrumb('Contratos', array(
	'controller'=>'contratos',
	'action'=>'index'
	));
	$this->Html->addCrumb('Contrato '.$linea_contrato['Contrato']['referencia'], array(
		'controller'=>'contratos',
		'action'=>'view',
		$linea_contrato['Contrato']['id']
	));
?>
<h2>Detalles Línea de Contrato <?php echo $linea_contrato['LineaContrato']['referencia']?></h2>
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
			$linea_contrato['LineaContrato']['id']),
		array(
			'title'=>'Modificar Línea de Contrato',
			'escape'=>false
		)
	).' '.
	$this->Form->postLink(
		'<i class="fa fa-trash"></i> Borrar',
		array(
			'action'=>'delete',
			$linea_contrato['LineaContrato']['id'],
			'from_controller' => 'contratos',
			'from_id' => $linea_contrato['Contrato']['id']
		),
		array(
			'escape'=>false,
			'title'=> 'Borrar',
			'confirm'=>'¿Realmente quiere borrar la línea de contrato '.$linea_contrato['LineaContrato']['referencia'].'?'
		)
	);
?>
</div>
<div class='view'>
	<?php
		echo "<dl>";
		echo "  <dt>Referencia Contrato:</dt>\n";
		echo "  <dd>".$linea_contrato['Contrato']['referencia'].'&nbsp;'."</dd>";
		echo "  <dt>Referencia Línea:</dt>\n";
		echo "  <dd>".$linea_contrato['LineaContrato']['referencia'].'&nbsp;'."</dd>";
		echo "  <dt>Proveedor:</dt>\n";
		echo "  <dd>".$linea_contrato['Contrato']['Proveedor']['Empresa']['nombre_corto'].'&nbsp;'."</dd>";
		echo "  <dt>Peso:</dt>\n";
		echo "  <dd>".$linea_contrato['PesoLineaContrato']['peso'].'kg&nbsp;'."</dd>";
		echo "  <dt>Embalaje:</dt>\n";
		echo "  <dd>".
			$linea_contrato['PesoLineaContrato']['cantidad_embalaje'].' x '.
			$embalaje['Embalaje']['nombre'].
			' ('.$linea_contrato['PesoLineaContrato']['peso'].'kg)&nbsp;'."</dd>";
		echo "  <dt>Fecha pos. fijación:</dt>\n";
		echo "  <dd>".$linea_contrato['LineaContrato']['fecha_pos_fijacion'].'&nbsp;'."</dd>";
		echo "  <dt>Precio fijación:</dt>\n";
		echo "  <dd>".$linea_contrato['LineaContrato']['precio_fijacion'].
			$linea_contrato['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
		echo "  <dt>Precio compra:</dt>\n";
		echo "  <dd>".$linea_contrato['LineaContrato']['precio_compra'].
			$linea_contrato['Contrato']['CanalCompra']['divisa'].'&nbsp;'."</dd>";
		echo "</dl>";
		echo "<table>";
		echo $this->Html->tableHeaders(array('Asociado', 'Cantidad de embalajes', 'Peso'));
		foreach ($linea_contrato['AsociadoLineaContrato'] as $linea_asociado):
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
