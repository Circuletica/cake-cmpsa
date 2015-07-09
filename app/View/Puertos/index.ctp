
<?php $this->Html->addCrumb('Puertos', '/puertos');?>
<div class="printdet">
<ul><li>
  <?php 
  echo $this->element('imprimir');
  ?>
  </li>
  <li>
  <?php
  echo $this->element('desplegabledatos');
  ?>
  </li>
</ul>
</div>
<h2>Listado de puertos</h2>
<table>
<?php
echo $this->Html->tableHeaders(array(
    'Id',
    $this->Paginator->sort('nombre'),
    $this->Paginator->sort('pais'),
    'Acciones'));

foreach($puertos as $puerto):
 echo $this->Html->tableCells(array(
  $puerto['Puerto']['id'],
  $puerto['Puerto']['nombre'],
  $puerto['Pais']['nombre'],
  $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
    array('action'=>'edit', $puerto['Puerto']['id']),
    array('class'=>'botond','escape'=>false, 'title'=>'Modificar puerto'))
   .' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
    array('action'=>'delete',$puerto['Puerto']['id']),
    array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$puerto['Puerto']['nombre'].'?'))
 ));

endforeach;?>

</table>
<div class="btabla">
    <?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Puerto',array(
   'controller' => 'puertos',
   'action' => 'add',
   'from_controller' => 'puertos',
   'from_action' => 'index'),array(
   'escape' => false,
   'title'=>'Añadir Puerto')); ?>
</div>

<p>
<?php echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
);?>
</p>
    <div class="paging">
    <?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
	  <?php echo $this->Paginator->numbers(array('separator' => ''));?>
	  <?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
    </div>
