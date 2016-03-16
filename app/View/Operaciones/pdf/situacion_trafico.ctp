<h2>Operaciones</h2>
	<div class='index'>
	<?php
/*	echo $this->Html->tableHeaders(array(
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
	/*foreach($operaciones as $operacion):
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
	
  	endforeach;*/
  	?>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('Operacion.referencia', 'Ref. Operación')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.referencia', 'Ref. Contrato')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.fecha_transporte','Embarque/Entrega')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor');?></th>
    <th><?php echo $this->Paginator->sort('PesoOperacion.cantidad_embalaje', 'Bultos')?></th>
  </tr>
  <?php
  foreach($operaciones as $operacion):
	  if (isset($operacion['Contrato']['si_entrega'])) {
		  $entrega  = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
		  $entrega = ' ('.$entrega.')';
	  } else { $entrega ='';}
    echo $this->Html->tableCells(array(
      $operacion['Operacion']['referencia'],
      $operacion['Contrato']['referencia'],
      $this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,
      $operacion['CalidadNombre']['nombre'],
      $operacion['Proveedor']['nombre_corto'],
      $operacion['PesoOperacion']['cantidad_embalaje']
      ));
  endforeach;
  ?>
  </table>

</div>
