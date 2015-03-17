<div class="add">
<h1>Añadir pais</h1>

<?php
  echo $this->Form->create('Pais');
  echo $this->Form->input('nombre');
  echo $this->Form->input('iso3166');
  echo $this->Form->input('prefijo_tfno');
  echo $this->Form->end('Guardar país');
?>
</div>
