  <?php echo $this->Form->create('Flete', array('action'=>'filtroListado'));?>
  <div class="radiomuestra">
  </div>
<?php
  echo $this->Form->input(
      'Search.pais_id',
      array(
	  'empty' => true
      )
  );
  echo $this->Form->input(
      'Search.naviera_id',
      array(
	  'empty' => true
      )
  );
  echo $this->Form->input(
      'Search.puerto_carga_id',
      array(
	  'empty' => true
      )
  );
  echo $this->Form->input(
      'Search.puerto_destino_id',
      array(
	  'empty' => true
      )
  );
?>
  <div class="formuboton">
    <ul>
    <li><?php
  if(isset($this->request->data['Search']['tipo_id'])){
      echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array(
	  'action'=>'index',
	  'Search.tipo_id'=>$this->request->data['Search']['tipo_id']),
      array(
	  'escape'=>false)
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
