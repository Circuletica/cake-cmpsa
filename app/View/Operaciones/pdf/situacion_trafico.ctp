<h2>Operaciones</h2>
	<div class='index'>
	<?php
	if (empty($operaciones)):
		echo "No hay operaciones en esta lista";
	else:

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		'Calidad',
		'Operación', 
		'Proveedor',
		'T-M',
		'Embarque/Entrega',
		'Pto.Destino', 
		'Fecha llegada',
		'Barco', 
		'Llegada prevista'
		)
	);
	foreach($operaciones as $operacion):
		foreach($operacion['Operacion'] as $transporte]):
	if (empty($transporte['Transporte']['fecha_despacho_op']) && date("d-m-Y", strtotime("-1 month") <= date("d-m-Y"))){	}
		endforeach;
		  if (isset($operacion['Contrato']['si_entrega'])) {
			  $entrega  = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
			  $entrega = ' ('.$entrega.')';
		  } else { $entrega ='';}
	    echo $this->Html->tableCells(array(
	      $operacion['CalidadNombre']['nombre'],    	
	      $operacion['Operacion']['referencia'],
	      $operacion['Proveedor']['nombre_corto'],  
	      $operacion['PesoOperacion']['cantidad_embalaje'],
	      $this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,
	      $operacion['Operacion']['Transporte'][]['fecha_carga'], 
	 	  $operacion['Operacion']['Transporte'][]['fecha_llegada'],      
	 	  $operacion['Operacion']['Transporte'][]['nombre_vehiculo'],
		  $operacion['Operacion']['Transporte'][]['fecha_prevista']
		  )
		);
	
  	endforeach;
?>
	</table>

	<?php endif; ?>
</div>
