<h2>Añadir Puerto</h2>
<?php echo $this->Form->create('Puerto'); ?>
<fieldset>
<div class="columna2">
<?php

   echo $this->Form->input('nombre');
   echo $this->Form->input('pais_id', array('label'=>'País'));
?>
	</div>
 <?php
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->element('cancelarform');
   echo $this->Form->end('Guardar Puerto');
?>
</fieldset>
