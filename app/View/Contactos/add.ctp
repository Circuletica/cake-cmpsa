<h2>Agregar contacto a <em><?php echo $empresa['Empresa']['nombre']?></em></h2>
<?php
  $this->Html->addCrumb('Entidades','/'.$this->params['named']['from_controller']);
  $this->Html->addCrumb($empresa['Empresa']['nombre'], '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
  $this->Html->addCrumb('Añadir Contacto ', '/contactos/add/'.'from_controller:'.$this->params['named']['from_controller'].'/from_id:'.$this->params['named']['from_id']);
  echo $this->Form->create();
   ?>
  <div class="columna2">
  <?php
  echo $this->Form->input('nombre');
  echo $this->Form->input('funcion', array(
	  'label' =>'Función')
  );
  ?> 
  </div>
  <div class="columna3">
    <?php
  echo $this->Form->input('telefono1', array(
	  'label'=>'Teléfono Nº1')
  );

  echo $this->Form->input('telefono2', array(
	  'label'=>'Teléfono Nº2')
  );
  echo $this->Form->input('email');
      ?>
    </div>
    <?php
  echo $this->Form->end('Guardar contacto');
?>

