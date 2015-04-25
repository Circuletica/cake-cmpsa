<div class="add">
<h1>Añadir País</h1>
<?php
  echo $this->Form->create('Pais');
  ?>
  <fieldset>
  	<?php
  	 echo $this->Form->input('nombre');
 	 echo $this->Form->input('iso3166');
	 echo $this->Form->input('prefijo_tfno', array("label"=>"Prefijo telefónico"));
 	 echo $this->Form->end('Guardar país');
 	?>
 </fieldset>
</div>	