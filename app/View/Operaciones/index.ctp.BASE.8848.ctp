<?php
  $this->Html->addCrumb('Operaciones', array(
    'controller' => 'operaciones',
    'action' => 'index')
  );
?>

<div class="printdet">
  <?php 
  echo $this->element('imprimir');
  ?>
</div>
<h2>Operaciones<?php //echo $title;?></h2>
<div class="actions">
  <?php echo $this->element('filtrooperacion');?>
  <!--h3>Filtro de operacion</h3-->
</div>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha_embarque')?></th>
    <th><?php echo $this->Paginator->sort('fecha_entrega')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('proveedor')?></th>
    <th><?php echo $this->Paginator->sort('Linea_contratos.cantidad_contenedores', 'Sacos por contrato')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>

  <?php foreach($operaciones as $operacion):?>
  <tr>
    <td>
      <?php echo $operacion['Operacion']['referecia']?>
    </td>
     <td>
      <?php
	//no queremos la hora
	//mysql almacena la fecha en formato YYY-MM-DD
	$fecha_emb = $operacion['Operacion']['fecha_embarque'];
	$dia_emb = substr($fecha_emb,8,2);
	$mes_emb = substr($fecha_emb,5,2);
	$anyo_emb= substr($fecha_emb,0,4);
	echo $dia_emb .'-'.$mes_emb .'-'.$anyo_emb;
     ?>
    </td>
          <?php
  //no queremos la hora
  //mysql almacena la fecha en formato YYY-MM-DD
  $fecha_ent = $operacion['Operacion']['fecha_entrega'];
  $dia_ent = substr($fecha_ent,8,2);
  $mes_ent = substr($fecha_ent,5,2);
  $anyo_ent = substr($fecha_ent,0,4);
  echo $dia_ent.'-'.$mes_ent.'-'.$anyo_ent;
     ?>
    </td>

      <td>
      <?php echo $operacion['Operacion']['referencia']?>
    </td>
    <td>
      <?php echo $operacion['CalidadNombre']['nombre']; ?>
    </td>
    <td>
      <?php echo $operacion['Proveedor']['Empresa']['nombre']; ?>
    </td>
    <td>
      <?php echo $operacion['Proveedor']['Empresa']['nombre']; ?>
    </td>

    <td>
      <?php echo $this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view',$operacion['Operacion']['id']), array('class'=>'botond','escape' => false,'title'=>'Detalles')).' '.
      $this->Form->postLink(
	'<i class="fa fa-trash"></i>',
	array('action'=>'delete',$operacion['Operacion']['id']),
	array(
    'class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
	  'confirm'=>'Realmente quiere borrar '.$operacion['Operacion']['referencia'].'?'
	)
      )
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </table>

  <div class="btabla">
  <?php 
    if(isset($this->request->data['Search']['tipo_id'])){
      echo $this->Html->link(
	'<i class="fa fa-plus"></i> Añadir Operación',
	array(
	  'action'=>'add',
	  'tipo_id'=>$this->request->data['Search']['tipo_id']
	),array(
  'class'=>'botond','escape'=>false, 'title'=>'Añadir Operación'));
    } else {
    echo $this->Html->link(
	'<i class="fa fa-plus"></i> Añadir Operación',
	array('action'=>'add'),array('class'=>'botond','escape'=>false, 'title'=>'Añadir Operación'));
    }
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

  <div class="detallado">
    <h3>Líneas de la operación</h3>
  <table>
  </table>
  </div>
</div>
