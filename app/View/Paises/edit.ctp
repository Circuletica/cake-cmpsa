<h2>Modificar País</h2>
<?php
$this->Html->addCrumb('Modificar País');
echo $this->Form->create('Pais', array('action' => 'edit'));?>
<fieldset>
<div class="columna3">
<?php

   echo $this->Form->input('nombre');
   echo $this->Form->input('iso3166');
   echo $this->Form->input('prefijo_tfno', array('label'=>'Prefijo Telefónico'));
   	?>
	</div>
 	<?php
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar País');
?>
</fieldset>