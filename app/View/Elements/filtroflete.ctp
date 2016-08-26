  <?php echo $this->Form->create('Flete', array('action'=>'filtroListado'));?>
  <div class="radiomuestra">
  </div>
<?php
  echo $this->Form->input(
      'Search.pais_id',
      array(
	  'empty' => true,
	  'label' => 'País de origen'
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
  echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array('action'=>'index'), array('escape'=>false));
?>
      </li>
      <li style="margin: 0">
<?php
  echo $this->Form->end('Buscar');
?>
      </li>
    </ul>
  </div>
