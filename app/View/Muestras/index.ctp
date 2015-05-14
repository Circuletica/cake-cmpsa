<h2><?php echo $title;?></h2>
<?php 
  if(isset($this->request->data['Search']['tipo_id'])){
    $this->Html->addCrumb($title, '/muestras/index/Search.tipo_id:'.$this->request->data['Search']['tipo_id']);
  } else {
    $this->Html->addCrumb($title, '/muestras/index');
  }

?>

<div class="actions">
  <?php echo $this->Form->create('Muestra', array('action'=>'search'));?>
  <!--h3>Filtro de muestra</h3-->
<div class="radiomuestra">
  <?php
    //echo $this->Form->input('Search.id');
    echo $this->Form->radio('Search.tipo_id', $tipos, array(
	'legend' => ''));?>
  </div>
  <?php
    echo $this->Form->input('Search.referencia');
    echo $this->Form->input('Search.fecha', array('after'=>'aaaa o mm-aaaa'));
    echo $this->Form->input('Search.calidad');
    //echo $this->Form->input('Search.calidad_id');
    echo $this->Form->input('Search.proveedor_id', array(
      'label' => 'Proveedor',
      'empty' => true
    ));
    //  echo $this->Form->input('Search.aprobado', array(
    //    'empty'=>__('Cualquiera', true),
    //    'options'=>array(
    //      0=>__('Rechazado',true),
    //      1=>__('Aprobado',true)
    //      )
    //    ));
  ?>
  <div class="formuboton">
    <ul>
      <li><?php
	if(isset($this->request->data['Search']['tipo_id'])){
	  echo $this->Html->Link('Resetear filtro',array(
	    'action'=>'index',
	    'Search.tipo_id'=>$this->request->data['Search']['tipo_id'])
	  );
	} else {
	  echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array('action'=>'index'), array('escape'=>false));
	}
	?>
      </li>
      <li style="margin: 0">
	<?php           
	  echo $this->Form->end('Buscar');
	?>
      </li>
    </ul>
  </div>
</div>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('tipo')?></th>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('proveedor')?></th>
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
	//no queremos la hora
	//mysql almacena la fecha en formato YMD
	$fecha = $muestra['Muestra']['fecha'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	echo $dia.'-'.$mes.'-'.$anyo;
     ?>
    </td>
    <td>
      <?php echo $muestra['CalidadNombre']['nombre']; ?>
    </td>
    <td>
      <?php echo $muestra['Proveedor']['Empresa']['nombre']; ?>
    </td>
    <td>
      <?php echo $this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view',$muestra['Muestra']['id']), array('class'=>'botond','escape' => false,'title'=>'Detalles')).' '.
      $this->Form->postLink(
	'<i class="fa fa-trash"></i>',
	array('action'=>'delete',$muestra['Muestra']['id']),
	array(
    'class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
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
