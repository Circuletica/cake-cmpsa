<?php echo $this->Form->create('Retiradas', array('action'=>'filtroListado'));?>
  <div class="radiomuestra">
  </div>
  <div class="linea">
<?php
  echo $this->Form->input(
      'Search.fechadesde',
      array(
	  'type'=>'date',
	  'dateFormat' => 'DMY',
	  'minYear' => date('Y')-4,
	  'maxYear' => date('Y'),
	  'orderYear' => 'asc',
	  'label'=> 'Retirada desde'
      )
  );
  echo $this->Form->input(
      'Search.fechahasta',
      array(
	  'type'=>'date',
	  'dateFormat' => 'DMY',
	  'minYear' => date('Y')-4,
	  'maxYear' => date('Y'),
	  'orderYear' => 'asc',
	  'label'=> 'Retirada hasta'
      )
  );    
?>
  </div>
<?php

?>
  <div class="formuboton">
    <ul>
    <li><?php
  if(isset($this->request->data['Search']['tipo_id'])){
      echo $this->Html->Link(
	  '<i class="fa fa-refresh"></i> Resetear',
	  array(
	      'action'=>'index'
	  ),
	  array('escape'=>false)
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
