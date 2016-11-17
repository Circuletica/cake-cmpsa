<h2>Operaciones<?php //echo $title;?></h2>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('OperacionCompra.referencia', 'Ref. Operación')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.referencia', 'Ref. Contrato')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.fecha_transporte','Embarque/Entrega')?></th>
    <th><?php echo $this->Paginator->sort('Calidad.nombre', 'Calidad')?></th>
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
      $operacion['OperacionCompra']['referencia'],
      $operacion['Contrato']['referencia'],
      $this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,
      $operacion['Calidad']['nombre'],
      $operacion['Proveedor']['nombre_corto'],
      $operacion['PesoOperacion']['cantidad_embalaje']
      )
    );
  endforeach;
  ?>
  </table>

  <div class="btabla">
   </div>

  <?php echo $this->Paginator->counter(
    array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
  );?>
</div>
