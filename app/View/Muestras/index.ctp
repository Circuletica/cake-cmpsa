<h2>Listado de muestras</h2>
<?php 
  $this->Html->addCrumb('Muestras', '/muestras');
?>

  <div class="actions">
    <?php echo $this->Form->create('Muestra', array('action'=>'search'));?>
  <h3>Filtro de muestra</h3>
  <?php
  //echo $this->Form->input('Search.id');
  echo $this->Form->input('Search.referencia');
  echo $this->Form->input('Search.fecha', array('after'=>'dd/mm/aaaa'));
  echo $this->Form->input('Search.calidad');
  //echo $this->Form->input('Search.calidad_id');
  echo $this->Form->input('Search.proveedor_id', array(
    'label' => 'Proveedor',
    'empty' => true
  ));
//  echo $this->Form->input('Search.aprobado', array(
//    'empty'=>__('Cualquiera', true),
//    'options'=>array(
//      0=>__('Rechazado',true),
//      1=>__('Aprobado',true)
//      )
//    ));
  
?>
  <div class="tabla">
  <table>
   <tr>
     <td>
      <?php
      echo $this->Html->Link('Cancelar búsqueda',array(
        'action'=>'index')
       );
       ?>
     </td>
     <td>
        <?php
        echo $this->Form->end('Buscar');
        ?>
     </td>
    </tr>
  </table>
  </div>
</div>
<div class='index'>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha')?></th>
    <th><?php echo $this->Paginator->sort('Calidad.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('proveedor')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>
<?php foreach($muestras as $muestra):?>
  <tr>
    <td>
      <?php echo $muestra['Muestra']['referencia']?>
    </td>
    <td>
      <?php
  //no queremos la hora
  //mysql almacena la fecha en formato YMD
  $fecha = $muestra['Muestra']['fecha'];
  $dia = substr($fecha,8,2);
  $mes = substr($fecha,5,2);
  $anyo = substr($fecha,0,4);
  echo $dia.'-'.$mes.'-'.$anyo;
     ?>
    </td>
    <td>
      <?php 
  //concatenamos la calidad de la muestra
      echo $muestra['Calidad']['descafeinado'] ? 'Descafeinado ' : ''
        .$muestra['Calidad']['Pais']['nombre'].
        ' '.$muestra['Calidad']['descripcion'];
  ?>
    </td>
    <td>
      <?php 
    //echo $muestra['Muestra']['aprobado'] ? 'Aprobado' : 'Rechazado';
    echo $muestra['Proveedor']['Empresa']['nombre'];
  ?>
    </td>
    <td>
  <?php echo $this->Html->link('Detalles',array('action'=>'view',$muestra['Muestra']['id']), array('class'=>'botond')).' '.
    //$this->Html->link('Modificar',array('action'=>'edit',$muestra['Muestra']['id']))
  $this->Form->postLink(
    'Borrar',
    array('action'=>'delete',$muestra['Muestra']['id']),
    array(
      'class'=>'botond',
      'confirm'=>'Realmente quiere borrar '.$muestra['Muestra']['referencia'].'?'
    )
  )
  ?>
    </td>
  </tr>
  <?php endforeach;?>
  </table>

  <div class="btabla">
  <?php echo $this->Html->link('Añadir Muestra',array('action'=>'add'));
  ?>
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
