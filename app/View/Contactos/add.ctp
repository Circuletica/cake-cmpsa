<h2>Agregar contacto a <em><?php echo $empresa['Empresa']['nombre']?></em></h2>
<?php
  //echo '<pre>';
  //print_r($empresa);
  //echo '</pre>';
  //echo $this->Form->create('Contacto');
  $this->Html->addCrumb('Entidades','/'.$this->params['named']['from']);
  $this->Html->addCrumb($empresa['Empresa']['nombre'], '/'.$this->params['named']['from'].'/view/'.$this->params['named']['from_id']);
  $this->Html->addCrumb('Añadir Contacto ', '/contactos/add/'.'from:'.$this->params['named']['from'].'/from_id:'.$this->params['named']['from_id']);
  echo $this->Form->create();
   ?>
  <fieldset><?php
  echo $this->Form->input('nombre');
  echo $this->Form->input('funcion', array(
	  'label' =>'Función')
  );

  echo $this->Form->input('telefono1', array(
	  'label'=>'Teléfono Nº1')
  );
      ?>
  </fieldset>
  <fieldset>
  <?php
  echo $this->Form->input('telefono2', array(
	  'label'=>'Teléfono Nº2')
  );

  echo $this->Form->input('email');
  //echo 'Empresa';
  //echo $this->Form->select('pais_id', array($paises,
  //'label' => 'País'));
  //echo $this->Form->select('empresa_id', $empresas);
  echo $this->Form->end('Guardar contacto');
?>
</fieldset>
