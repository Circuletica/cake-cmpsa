  <?php echo $this->Form->create('Muestra', array('action'=>'filtroListado'));?>
  <div class="radiomuestra">
  </div>
<?php
  echo $this->Form->input(
      'Search.tipo_registro',
      array(
	  'label' => 'Registro'
      )
  );
  echo $this->Form->input(
      'Search.fecha',
      array(
	  'after'=>'aaaa o mm-aaaa'
      )
  );
  echo $this->Form->input(
      'Search.tipo_id', array(
	  'type' => 'hidden'
      )
  );
  echo $this->Form->input(
      'Search.nombre',
      array(
	  'label' => 'Calidad'
      )
  );
  echo $this->Form->input('Search.proveedor_id', array(
      'label' => 'Proveedor',
      'empty' => true
  ));
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
