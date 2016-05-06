
<?php
	echo '<h2>Situación de líneas transporte despachadas a día '.date("d-m-Y").'</h2>';
?>
<table>
<?php    

	echo $this->Html->tableHeaders(array(
		'Ref. Operación',
		'Línea',
		'Calidad',
		'Cantidad',
		'Fecha despacho',
			
		)
	);
	foreach ($despachos as $despacho){		
			echo $this->Html->tableCells(array(
				$despacho['Operacion']['referencia'],
				$despacho['Transporte']['linea'],			
				$despacho['Calidad']['nombre'],
				$despacho['Transporte']['cantidad_embalaje'],					
			    $this->Date->format($despacho['Transporte']['fecha_despacho_op']),
		     	)
			);
	}
?>
</table>
