<h2>Listado de calidades</h2>
<?php
	$this->Html->addCrumb('Calidades', array(
		'controller' => 'calidades',
		'action' => 'index')
	);
?>
  <div class="actions">
  <?php
  echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
	?>
	</div>

	<div class='index'>
	<?php //print_r($calidades);?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('id')?></th>
    <th><?php echo $this->Paginator->sort('descafeinado','Proceso')?></th>
    <th><?php echo $this->Paginator->sort('Pais.nombre','Origen')?></th>
    <th><?php echo $this->Paginator->sort('descripcion', 'Descripción')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>
<?php foreach($calidades as $calidad):?>
  <tr>
    <td>
      <?php echo $calidad['Calidad']['id']?>
    </td>
    <td>
      <?php echo $calidad['Calidad']['descafeinado'] ? 'Descafeinado' : 'Natural'; ?>
    </td>
    <td>
      <?php echo $calidad['Pais']['nombre'] ? $calidad['Pais']['nombre'] : 'Blend'?>
    </td>
    <td>
      <?php echo $calidad['Calidad']['descripcion']?>
      <?php //echo $calidad['Calidad']['nombre']?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('action'=>'edit',$calidad['Calidad']['id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar'))
      .' '.$this->Form->postLink('<i class="fa fa-trash"></i>',array('action'=>'delete',$calidad['Calidad']['id']),array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$calidad['Calidad']['descripcion'].'?'))?>
    </td>
  </tr>
<?php endforeach;?>
</table>
    <div class="btabla">
    <?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Calidad',array(
    'controller' => 'calidades',
    'action'=>'add',
    'from_controller' => 'calidades',
    'from_action' => 'index'),array('escape' => false));
      ?>
       </div>

    <?php echo $this->Paginator->counter(
	   array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
      );?>
<div class="paging">
	<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
	 echo $this->Paginator->numbers(array('separator' => ''));
	 echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
  </div>
</div>

