<h2>Añadir Incoterms</h2>
<?php echo $this->Form->create('Incoterms'); ?>
<fieldset>
<?php
   	echo $this->Form->input('nombre');
   	  echo $this->element('cancelarform');
 	echo $this->Form->end('Guardar Incoterms');
 ?>
 </fieldset>
