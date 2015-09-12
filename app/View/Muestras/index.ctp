<div class="printdet">
  <?php 
  echo $this->element('imprimirI');
  ?>
</div>
<h2><?php echo $title;?></h2>
<?php 
  if(isset($this->request->data['Search']['tipo_id'])){
    $this->Html->addCrumb($title, '/muestras/index/Search.tipo_id:'.$this->request->data['Search']['tipo_id']);
  } else {
    $this->Html->addCrumb($title, '/muestras/index');
  }

?>

<div class="actions">
  <?php echo $this->element('filtromuestra');?>
  <!--h3>Filtro de muestra</h3-->
</div>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('tipo')?></th>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('Empresa.nombre_corto', 'Proveedor')?></th>
    <th><?php echo 'Acciones'?></th>
  </tr>
  <?php foreach($muestras as $muestra):?>
  <tr>
    <td>
      <?php echo $muestra['Muestra']['tipo']?>
    </td>
    <td>
      <?php echo $muestra['Muestra']['referencia']?>
    </td>
    <td>
      <?php
	echo $this->Date->format($muestra['Muestra']['fecha']);
     ?>
    </td>
    <td>
      <?php echo $muestra['CalidadNombre']['nombre']; ?>
    </td>
    <td>
      <?php echo $muestra['Empresa']['nombre_corto']; ?>
    </td>
    <td>
<?php echo
	$this->Html->link(
		'<i class="fa fa-info-circle"></i>',
		array(
			'action'=>'view',
			$muestra['Muestra']['id']),
		array(
			'class'=>'botond',
			'escape' => false,
			'title'=>'Detalles')
	).' '.
	$this->Form->postLink(
			'<i class="fa fa-trash"></i>',
			array(
				'action'=>'delete',
				$muestra['Muestra']['id']),
			array(
				'class'=>'botond',
				'escape'=>false,
				'title'=> 'Borrar',
				'confirm'=>'Realmente quiere borrar '.$muestra['Muestra']['referencia'].'?'
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
	'<i class="fa fa-plus"></i> Añadir Muestra',
	array(
	  'action'=>'add',
	  'tipo_id'=>$this->request->data['Search']['tipo_id']
	),array(
  'class'=>'botond','escape'=>false, 'title'=>'Añadir Muestra'));
    } else {
    echo $this->Html->link(
	'<i class="fa fa-plus"></i> Añadir Muestra',
	array('action'=>'add'),array('class'=>'botond','escape'=>false, 'title'=>'Añadir Muestra'));
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
</div>
