<?php
  $this->Html->addCrumb('Operaciones', array(
    'controller' => 'operaciones',
    'action' => 'index')
  );
?>

<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
      'action' => 'index_trafico',
      'ext' => 'pdf'),
    array(
      'escape'=>false,
      'target' => '_blank',
      'title'=>'Exportar a PDF'
      )
    );
 ?>
</div>
<h2>Operaciones<?php //echo $title;?></h2>
<div class="actions">
  <?php 
  echo $this->element('filtrooperacion');
  echo '<br>';
  echo  $this->Html->link(('<i class="fa fa-area-chart fa-lg"></i> Info embarques'),
    array(
    'action' =>'info_embarque',
    'controller' => 'transportes'
    ),
    array(
    'escape'=>false,
    'title'=>'Informe de situación'
    )
  );
  echo  $this->Html->link(('<i class="fa fa-area-chart fa-lg"></i> Informe de despachos'),
    array(
    'action' =>'info_despacho',
    'controller' => 'transportes'
    ),
    array(
    'escape'=>false,
    'title'=>'Informe de despachos'
    )
  );

    echo  $this->Html->link(('<i class="fa fa-area-chart fa-lg"></i> Informe suplemento sin recl.'),
    array(
    'action' =>'situacion',
    'controller' => 'transportes'
    ),
    array(
    'escape'=>false,
    'title'=>'Informe de operaciones con suplemento sin reclamación'
    )
  );

  ?>
  <!--h3>Filtro de operacion</h3-->
</div>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('Operacion.referencia', 'Ref. Operación')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.referencia', 'Ref. Contrato')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.fecha_transporte','Embarque/Entrega')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor');?></th>
    <th><?php echo $this->Paginator->sort('PesoOperacion.cantidad_embalaje', 'Bultos')?></th>
    <th><?php echo 'Detalle'?></th>
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
      $operacion['PesoOperacion']['cantidad_embalaje'],
      //No se puede usar el ButtonHelper. Enlace distinto.
      $this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view_trafico',$operacion['Operacion']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalle'))
      ));
  endforeach;
  ?>
  </table>

  <div class="btabla">
   </div>

  <?php echo $this->Paginator->counter(
    array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
  );?>

  <div class="paging">
    <?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
    <?php echo $this->Paginator->numbers(array('separator' => ''));?>
    <?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
  </div>

</div>
