
<?php $this->Html->addCrumb('Países', '/paises');?>
<h2>Listado de países</h2>
<table>
  <tr>
    <th>Id</th>
    <th><?php echo $this->Paginator->sort('nombre')?></th>
    <th><?php echo $this->Paginator->sort('iso3166')?></th>
    <th>Prefijo Telefónico</th>
    <th>Acciones</th>
  </tr>
<?php foreach($paises as $pais):?>
  <tr>
    <td>
      <?php echo $pais['Pais']['id']?>
    </td>
    <td>
      <?php echo $pais['Pais']['nombre']?>
    </td>
    <td>
      <?php echo $pais['Pais']['iso3166']?>
    </td>
    <td>
      <?php echo $pais['Pais']['prefijo_tfno']?>
    </td>
    <td>
      <?php echo $this->Html->link('Modificar',array('action'=>'edit',$pais['Pais']['id']), array('class'=>'boton'))?>
      <?php echo '&nbsp;';?>
      <?php echo $this->Form->postLink('Borrar',array('action'=>'delete',$pais['Pais']['id']), array('class'=>'boton','confirm'=>'¿Realmente quiere borrar '.$pais['Pais']['nombre'].'?'))?>
    </td>
  </tr>
<?php endforeach;?>
</table>
<div class="btabla">
    <?php echo $this->Html->link('Añadir País',array(
   'controller' => 'paises',
   'action' => 'add',
   'from_controller' => 'paises',
   'from_action' => 'index'
     )); ?>
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
