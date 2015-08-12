<?php
  $this->Html->addCrumb('Operaciones', array(
    'controller' => 'operaciones',
    'action' => 'index')
  );
?>

<div class="printdet">
  <?php 
  echo $this->element('imprimirI');
  ?>
</div>
<h2>Operaciones<?php //echo $title;?></h2>
<div class="actions">
  <?php echo $this->element('filtrooperacion');?>
  <!--h3>Filtro de operacion</h3-->
</div>
<div class='index'>
  <?php
//  //mysql almacena la fecha en formato ymd
//  $fecha = $operacion['Contrato']['fecha_embarque'];
//  $dia = substr($fecha,8,2);
//  $mes = substr($fecha,5,2);
//  $anyo = substr($fecha,0,4);
//  $fecha_embarque = $dia.'-'.$mes.'-'.$anyo;
//  $fecha = $operaciones['Contrato']['fecha_entrega'];
//  $dia = substr($fecha,8,2);
//  $mes = substr($fecha,5,2);
//  $anyo = substr($fecha,0,4);
//  $fecha_entrega = $dia.'-'.$mes.'-'.$anyo;
 
  ?>  
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('Operacion.referencia', 'Referencia')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.referencia', 'Contrato')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.fecha_embarque','Embarque')?></th>
    <th><?php echo $this->Paginator->sort('Contrato.fecha_entrega', 'Entrega')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('proveedor', 'Proveedor');?></th>
    <th><?php echo $this->Paginator->sort('PesoOperacion.cantidad_embalaje', 'Bultos')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>
  <?php foreach($operaciones as $operacion): ?>
  <tr>
    <td>
      <?php echo $operacion['Operacion']['referencia']?>
    </td>
    <td>
      <? echo $operacion['Contrato']['referencia']?>
    </td>
    <td>
      <? echo $operacion['Contrato']['fecha_embarque']?>
    </td>
    <td>
      <?php echo $operacion['Contrato']['fecha_entrega'];?>
    </td>
    <td>
      <?php echo $operacion['Contrato']['CalidadNombre']['nombre'];?>
    </td>
    <td>
      <?php echo $operacion['Contrato']['Proveedor']['Empresa']['nombre_corto'];?>
    </td>
    <td>
      <?php echo $operacion['PesoOperacion']['cantidad_embalaje']?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-info-circle"></i> Detalles',array('action'=>'view_trafico',$operacion['Operacion']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'));
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </table>
 <!-- <div class="btabla">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Operación',array('action'=>'add'), array('title'=>'Añadir Operación','escape' => false)); ?>
  </div>-->

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
