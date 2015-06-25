<h2>Añadir País</h2>
<?php echo $this->Form->create('Pais'); ?>
<fieldset>
<div class="columna3">
<?php
   	 echo $this->Form->input('nombre');
 	 echo $this->Form->input('iso3166');
	 echo $this->Form->input('prefijo_tfno', array("label"=>"Prefijo telefónico"));
	?>
	</div>
 	<?php
 	echo $this->Form->end('Guardar país');
 ?>
 </fieldset>
