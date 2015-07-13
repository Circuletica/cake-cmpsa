<h1>Agregar empresa</h1>

<?php
  echo $this->Form->create('Empresa');
  echo $this->Form->input('nombre');
  echo $this->Form->input('direccion');
  echo $this->Form->input('cp');
  echo $this->Form->input('municipio');
  echo 'Pais';
  //echo $this->Form->select('pais_id', array($paises,
//	  'label' => 'País'));
  echo $this->Form->select('pais_id', $paises);
  echo $this->Form->end('Guardar');
?>
