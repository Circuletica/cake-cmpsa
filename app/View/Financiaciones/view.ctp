<?php
	$this->extend('/Common/view');
	$this->assign('object', 'Financiación operación '.$referencia);
	$this->assign('line_object', 'Distribución');
	$this->assign('id',$financiacion['Financiacion']['id']);
	$this->assign('class','Financiacion');
	$this->assign('controller','financiaciones');
	$this->assign('line_controller','reparto_operacion_asociados');

	$this->start('filter');
	//echo $this->element('filtrofinanciacion');
	$this->end();

	$this->start('main');
	echo "<dl>";
	echo "  <dt>Operación</dt>\n";
	echo "  <dd>".$referencia.'&nbsp;'."</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "  <dd>".$calidad.'&nbsp;'."</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->html->link($proveedor, array(
		'controller' => 'proveedores',
		'action' => 'view',
		$proveedor_id)
	);
	echo "</dd>";
	echo "  <dt>Transporte</dt>\n";
	echo "<dd>".$transporte.'&nbsp;'."</dd>";
	echo "  <dt>Cuenta bancaria</dt>\n";
	echo "<dd>".$cuenta.'&nbsp;'."</dd>";
	echo "  <dt>Fecha de vencimiento</dt>\n";
	echo "<dd>".$this->Date->format($fecha_vencimiento).'&nbsp;'."</dd>";
	echo "</dl>";
	$this->end();

	$this->start('lines');
	?>
	<table>
	<?php
	echo $this->html->tableheaders(array('Asociado','Reparto (%)','Bultos', 'Peso (kg)', 'Precio sin IVA (€)','Precio con IVA (€)'));
	foreach($repartos as $linea):
		echo $this->Html->tableCells(array(
			$linea['Asociado']['Empresa']['nombre_corto'],
			array(
			    //$this->Number->roundTo2($linea['porcentaje_embalaje_socio'])."%",
			    $this->Number->roundTo2($linea['porcentaje_embalaje_socio']),
			    array('style' => 'text-align:right')
			),
			array(
			    $linea['cantidad_embalaje_asociado'],
			    array('style' => 'text-align:right')
			),
			array(
			    //$linea['peso_asociado'].'kg',
			    $this->Number->roundTo2($linea['peso_asociado']),
			    array('style' => 'text-align:right')
			),
			array(
			    //$this->Number->roundTo2($linea['precio_asociado']).'€',
			    $this->Number->roundTo2($linea['precio_asociado']),
			    array('style' => 'text-align:right')
			),
			array(
			    //$this->Number->roundTo2($linea['precio_asociado_con_iva']).'€',
			    $this->Number->roundTo2($linea['precio_asociado_con_iva']),
			    array('style' => 'text-align:right')
			),
		    )
		);
	endforeach;
	echo $this->html->tablecells(array(
	    'TOTALES',
	    array(
		//$this->Number->roundTo2($totales['total_porcentaje_embalaje'])."%",
		$this->Number->roundTo2($totales['total_porcentaje_embalaje']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		$totales['total_cantidad_embalaje'],
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$totales['total_peso'].'kg',
		$this->Number->roundTo2($totales['total_peso']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$this->Number->roundTo2($totales['total_precio']).'€',
		$this->Number->roundTo2($totales['total_precio']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$this->Number->roundTo2($totales['total_precio_con_iva']).'€',
		$this->Number->roundTo2($totales['total_precio_con_iva']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    )
	);
	echo"</table>\n";
	$this->end();
?>
	</div>
</div>

