<?php
  $this->Html->addCrumb('Línea de Transportes', array(
    'controller' => 'transportes',
    'action' => 'index')
  );
?>

<div class="printdet">
  <?php 
  echo $this->element('imprimirI');
  ?>
</div>
<h2>Línea de Transportes<?php //echo $title;?></h2>
<div class="actions">
  <?php echo $this->element('filtrooperacion');
   echo '<br>';
  echo  $this->Html->link(('<i class="fa fa-area-chart fa-lg"></i> Informe de situación'),
    array(
    'action' =>'situacion',
    'controller' => 'transportes'
    ),
    array(
    'escape'=>false,
    'title'=>'Informe de situación'
    )
  );
  echo  $this->Html->link(('<i class="fa fa-area-chart fa-lg"></i> Informe de despachos'),
    array(
    'action' =>'situacion',
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
  <!--h3>Filtro de transporte</h3-->
</div>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('id')?></th>
    <?//php echo $this->Paginator->sort('Operacion.muestra.sí o no')?>
    <th><?php echo $this->Paginator->sort('nombre_vehiculo')?></th>
    <th><?php echo $this->Paginator->sort('matricula')?></th>
    <th><?php echo $this->Paginator->sort('fecha_carga')?></th>
   <th><?php echo $this->Paginator->sort('fecha_llegada')?></th>
    <th><?php echo $this->Paginator->sort('EmbalajeTransporte.cantidad', 'Cantidad')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>

  <?php foreach($transportes as $transporte): ?>
  <tr>
    <td>
      <?php echo $transporte['Transporte']['id']?>
    </td>
    <td>
      <?php echo $transporte['Transporte']['nombre_vehiculo'];?>
    </td>
     <td>
      <?php echo $transporte['Transporte']['matricula'];?>
    </td>
     <td>
      <?php echo $transporte['Transporte']['fecha_carga'];?>
    </td>
     <td>
      <?php echo $transporte['Transporte']['fecha_llegada'];?>
    </td>    
    <td>
      <?php echo $transporte['EmbalajeTransporte']['cantidad'];?>
    </td>
    
    <?php
	//no queremos la hora
	//mysql almacena la fecha en formato YYY-MM-DD
//echo $transporte['LineaContratosTransporte']['LineaContrato.contrato_id'];
//['Contrato']['fecha_embarque'];
//	$dia_emb = substr($fecha_emb,8,2);
//	$mes_emb = substr($fecha_emb,5,2);
//	$anyo_emb= substr($fecha_emb,0,4);
 // echo $fecha_emb;
//	echo $dia_emb .'-'.$mes_emb .'-'.$anyo_emb;
     ?>
    </td>
          <?php
      echo $transporte['Transporte']['seguro'];
  //no queremos la hora
  //mysql almacena la fecha en formato YYY-MM-DD
	//$fecha_ent = $transporte['LineaContratosTransporte']['0']['LineaContrato']['Contrato']['fecha_entrega'];
//	$fecha_ent = $transporte['LineaContratosTransporte'][1]['LineaContrato']['Contrato']['fecha_entrega'];
//	$dia_ent = substr($fecha_ent,8,2);
//	$mes_ent = substr($fecha_ent,5,2);
//	$anyo_ent = substr($fecha_ent,0,4);
//	echo $dia_ent.'-'.$mes_ent.'-'.$anyo_ent;
     ?>
    </td>

      <td>
      <?php echo $transporte['Transporte']['forfait']?>
    </td>
      <td>
      <?php echo $transporte['Transporte']['fecha_seguro']?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('action'=>'edit',$transporte['Transporte']['id']),array('class'=>'botond','title'=>'Modificar Operación','escape'=>false)).' '.$this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view',$transporte['Transporte']['id']), array('class'=>'botond','escape' => false,'title'=>'Detalles')).' '.
      $this->Form->postLink(
	'<i class="fa fa-trash"></i>',
	array('action'=>'delete',$transporte['Transporte']['id']),
	array(
    'class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
	  'confirm'=>'Realmente quiere borrar '.$transporte['Transporte']['referencia'].'?'
	)
      )
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </table>

  <div class="btabla">
  <?php 
//    if(isset($this->request->data['Search']['tipo_id'])){
//     echo $this->Html->link(
//	'<i class="fa fa-plus"></i> Añadir Operación',
//	array(
//	  'action'=>'add',
//	  'tipo_id'=>$this->request->data['Search']['tipo_id']
//	),array(
// 'class'=>'botond','escape'=>false, 'title'=>'Añadir Operación'));
//    } else {
//    echo $this->Html->link(
//	'<i class="fa fa-plus"></i> Añadir Operación',
//	array('action'=>'add'),array('class'=>'botond','escape'=>false, 'title'=>'Añadir Operación'));
//    }
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
