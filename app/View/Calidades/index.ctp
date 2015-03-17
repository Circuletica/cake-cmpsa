<h2>Listado de calidades</h2>
<?php
	$this->Html->addCrumb('Calidades', array(
		'controller' => 'calidades',
		'action' => 'index')
	);
	echo "<div class='actions'>\n";
	echo $this->Html->link('Añadir Calidad',array(
		'controller' => 'calidades',
		'action'=>'add',
		'from_controller' => 'calidades',
		'from_action' => 'index'));
	echo "\n";
	echo "</div>\n";
	echo "<div class='index'>\n";
//	echo '<pre>';
//	print_r($calidades);
//	echo '</pre>';
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('id')?></th>
    <th><?php echo $this->Paginator->sort('descafeinado','Proceso')?></th>
    <th><?php echo $this->Paginator->sort('Pais.nombre','Origen')?></th>
    <th><?php echo $this->Paginator->sort('descripcion')?></th>
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
      <?php echo $this->Html->link('Modificar',array('action'=>'edit',$calidad['Calidad']['id']))?>
      <?php echo '&nbsp;';?>
      <?php echo $this->Form->postLink('Borrar',array('action'=>'delete',$calidad['Calidad']['id']),array('confirm'=>'Realmente quiere borrar '.$calidad['Calidad']['descripcion'].'?'))?>
    </td>
  </tr>
<?php endforeach;?>
</table>
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
