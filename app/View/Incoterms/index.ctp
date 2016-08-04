
<?php $this->Html->addCrumb('Incoterms', '/incoterms');?>
<div class="printdet">
<ul><li>
  <?php 
  echo $this->element('imprimirI');
  ?>
  </li>
  <li>
  <?php
  echo $this->element('desplegabledatos');
  ?>
  </li>
</ul>
</div>
<h2>Listado de Incoterms</h2>
<table class="tc3">
  <tr>
    <th>Id</th>
    <th><?php echo $this->Paginator->sort('nombre')?></th>
    <th>Detalle</th>
  </tr>
<?php foreach($incoterms as $incoterm):?>
  <tr>
    <td>
      <?php echo $incoterm['Incoterm']['id']?>
    </td>
    <td>
      <?php echo $incoterm['Incoterm']['nombre']?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('action'=>'edit',$incoterm['Incoterm']['id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar Incoterm'))
      .' '.$this->Form->postLink('<i class="fa fa-trash"></i>',array('action'=>'delete',$incoterm['Incoterm']['id']), array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$incoterm['Incoterm']['nombre'].'?'))?>
    </td>
  </tr>
<?php endforeach;?>
</table>
<div class="btabla">
    <?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Incoterms',array(
   'controller' => 'incoterms',
   'action' => 'add',
   'from_controller' => 'incoterms',
   'from_action' => 'index'),array(
   'escape' => false,
   'title'=>'Añadir Incoterms')); ?>
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
