<h1>Modificar País</h1>
<div class="columna2">
<?php
$this->Html->addCrumb('Modificar País');
   echo $this->Form->create('Pais', array('action' => 'edit'));
   echo $this->Form->input('nombre');
   echo $this->Form->input('iso3166');
   echo $this->Form->input('prefijo_tfno', array('label'=>'Prefijo Telefónico'));
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar País');
?>
</div>