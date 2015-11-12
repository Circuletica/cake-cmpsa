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
	).'&nbsp;';
	echo "</dd>";
	echo "  <dt>Condición</dt>\n";
	echo "<dd>".$condicion.'&nbsp;'."</dd>";
	echo "  <dt>Cuenta bancaria</dt>\n";
	echo "<dd>".$cuenta.'&nbsp;'."</dd>";
	echo "  <dt>Fecha de vencimiento</dt>\n";
	echo "<dd>".$this->Date->format($fecha_vencimiento).'&nbsp;'."</dd>";
	echo "  <dt>Precio</dt>\n";
	echo "<dd>".$precio_euro_kilo.'€/kg&nbsp;'."</dd>";
	echo "</dl>";
	$this->end();

	$this->start('lines');
	?>
	<table>
	<?php
	echo $this->html->tableheaders(array('Asociado','Reparto (%)','Peso (kg)','Coste (€)','IVA ('.$iva.'%)', 'Comisión', 'IVA Comisión('.$iva_comision.'%)','Precio final'));
	foreach($repartos as $linea):
		echo $this->Html->tableCells(array(
			$linea['Empresa']['nombre_corto'],
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['porcentaje_embalaje_asociado']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['peso_asociado']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['precio_asociado']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['iva']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['comision']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['iva_comision']),
			    array('style' => 'text-align:right')
			),
			array(
			    $this->Number->roundTo2($linea['RepartoOperacionAsociado']['total']),
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
		$this->Number->roundTo2($totales['total_iva']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$this->Number->roundTo2($totales['total_precio_con_iva']).'€',
		$this->Number->roundTo2($totales['total_comision']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$this->Number->roundTo2($totales['total_precio_con_iva']).'€',
		$this->Number->roundTo2($totales['total_iva_comision']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    ),
	    array(
		//$this->Number->roundTo2($totales['total_precio_con_iva']).'€',
		$this->Number->roundTo2($totales['total_general']),
		array(
		    'style' => 'text-align:right',
		    'bgcolor' => '#00FF00'
		)
	    )
	    )
	);
	echo"</table>\n";
	$this->end();
?>
	</div>
</div>

