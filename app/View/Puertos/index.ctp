
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
  <tr>
    <th><?php echo $this->Paginator->sort('id')?></th>
    <th><?php echo $this->Paginator->sort('nombre')?></th>
    <th><?php echo $this->Paginator->sort('pais')?></th>
    <th>Acciones</th>
  </tr>
<?php foreach($puertos as $pais):?>
  <tr>
    <td>
      <?php echo $pais['Puerto']['id']?>
    </td>
    <td>
      <?php echo $pais['Puerto']['nombre']?>
    </td>
    <td>
      <?php echo $pais['Pais']['nombre']?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('action'=>'edit',$pais['Puerto']['id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar'))
      .' '.$this->Form->postLink('<i class="fa fa-trash"></i>',array('action'=>'delete',$pais['Puerto']['id']), array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$pais['Puerto']['nombre'].'?'))?>
    </td>
  </tr>
<?php endforeach;?>
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
