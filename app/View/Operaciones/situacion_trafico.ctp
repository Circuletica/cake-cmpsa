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
      
      $operacion['Transporte']['fecha_carga'], 
 	  $operacion['Transporte']['fecha_llegada'],      
 	  $operacion['Transporte']['nombre_vehiculo'],
	  $operacion['Transporte']['fecha_prevista']
	  )
	);
  	endforeach;
?>
	</table>

	<?php endif; ?>
</div>
