<?php
	$this->Html->addCrumb('Calidades', array(
		'controller' => 'calidades',
		'action' => 'index')
	);
?>
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
<h2>Listado de calidades</h2>
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
    </td>
    <td>
<?php echo $this->Button->edit('calidades',$calidad['Calidad']['id'],'calidades')
		.' '.$this->Button->delete('calidades',$calidad['Calidad']['id'],$calidad['Calidad']['descripcion']);
?>
    </td>
  </tr>
<?php endforeach;?>
</table>
<div class="btabla">
    <?php echo $this->Button->add('calidades','calidad');?>
</div>
<?php echo $this->element('paginador');?>
