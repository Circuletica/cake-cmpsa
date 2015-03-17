<h1>Modificar Pais</h1>

<?php
   echo $this->Form->create('Pais', array('action' => 'edit'));
   echo $this->Form->input('nombre');
   echo $this->Form->input('iso3166');
   echo $this->Form->input('prefijo_tfno');
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar Pais');
?>
