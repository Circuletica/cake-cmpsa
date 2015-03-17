<h1>Modificar Pais</h1>

<?php
   echo $this->Form->create('Calidad', array('action' => 'edit'));
   echo $this->Form->input('descafeinado');
   echo $this->Form->input('pais_id');
   echo $this->Form->input('descripcion');
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar Calidad');
?>
