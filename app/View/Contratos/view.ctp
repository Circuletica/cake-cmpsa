<?php
	$this->extend('/Common/view');
	$this->assign('object', 'Contrato '.$referencia);
	$this->assign('line_object', 'operación');
	$this->assign('id',$contrato['Contrato']['id']);
	$this->assign('class','Contrato');
	$this->assign('controller','contratos');
	$this->assign('line_controller','operaciones');

	$this->start('filter');
	echo $this->Html->link(
		'Duplicar contrato',
		array(
			'controller' => 'contratos',
			'action' => 'copy',
			$contrato['Contrato']['id'],
		),
		array(
			'class' => 'boton',
			'title' => 'Duplicar contrato',
			'escape' => false
		)
	);
	//echo $this->element('filtrocontrato');
	$this->end();

	$this->start('main');
	echo "<dl>";
	echo "  <dt>Referencia</dt>\n";
	echo "  <dd>".$referencia.'&nbsp;'."</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->html->link($contrato['Proveedor']['Empresa']['nombre_corto'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$contrato['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "  <dd>".$contrato['CalidadNombre']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Lotes</dt>\n";
	echo "  <dd>".$contrato['Contrato']['lotes_contrato'].' ('.$posicion_bolsa.')&nbsp;'."</dd>";
	echo "  <dt>Peso comprado</dt>\n";
	echo "  <dd>".$contrato['Contrato']['peso_comprado'].' kg&nbsp;'."</dd>";
	echo "  <dt>Peso distribuido</dt>\n";
	echo "  <dd>".$peso_fijado." kg&nbsp;</dd>";
	echo "  <dt>Peso no distribuido</dt>\n";
	echo "  <dd>".$peso_por_fijar." kg&nbsp;</dd>";
	?>
	</dl>
<div class="detallado">
	<table>
	<?php
	echo $this->html->tableheaders(array('Cantidad','Embalaje', 'Peso ud.', 'Peso'));
	$peso_total = 0;
	foreach($contrato['ContratoEmbalaje'] as $embalaje):
		$peso_embalaje = $embalaje['cantidad_embalaje'] * $embalaje['peso_embalaje_real'];
		echo $this->html->tablecells(array(
			$embalaje['cantidad_embalaje'],
			$embalaje['Embalaje']['nombre'],
			$embalaje['peso_embalaje_real']." kg",
			$peso_embalaje." kg",
			));
		$peso_total += $peso_embalaje;
	endforeach;
	?>
	</table>
</div>
	<?php
	echo "<dl>";
	echo "  <dt>$tipo_fecha_transporte</dt>\n";
	echo "  <dd>".$this->Date->format($fecha_transporte)."</dd>";
	echo "  <dt>$tipo_puerto</dt>\n";
	echo "  <dd>".$puerto."&nbsp;</dd>";
	echo "  <dt>Bolsa</dt>\n";
	echo "  <dd>".$contrato['CanalCompra']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Diferencial</dt>\n";
	echo "  <dd>".$contrato['Contrato']['diferencial']." ".$contrato['CanalCompra']['divisa']."</dd>";
	echo "  <dt>Incoterm</dt>\n";
	echo "  <dd>".$contrato['Incoterm']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Comentarios</dt>\n";
	echo "  <dd>".$contrato['Contrato']['comentario'].'&nbsp;'."</dd>";
	echo "</dl>";
	$this->end();

	$this->start('lines');
	?>
	<table>
	<?php
	echo $this->html->tableheaders(array('Referencia','Peso','Fecha de fijación', 'Precio de fijación', 'Precio de factura','Detalle'));
	foreach($contrato['Operacion'] as $linea):
		echo $this->html->tablecells(array(
			$linea['referencia'],
			$linea['PesoOperacion']['peso']." kg",
			$linea['fecha_pos_fijacion'],
			$linea['precio_fijacion']." ".$contrato['CanalCompra']['divisa'],
			$linea['precio_compra']." ".$contrato['CanalCompra']['divisa'],
			$this->Button->view('operaciones',$linea['id'])
		));
	endforeach;
	?>
	</table>
	<?php
	//lotes que quedan por fijar
	echo "<em>Quedan por fijar ".$contrato['RestoLotesContrato']['lotes_restantes']
		." lotes</em>";
	$this->end();
?>
	</div>
</div>

