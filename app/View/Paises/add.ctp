<h2>Añadir País</h2>
<?php
$this->Html->addCrumb('Países', '/paises');
echo $this->Form->create('Pais'); ?>
<div class="col3">
<?php
   	 echo $this->Form->input('nombre',array("label"=>"Nombre del país"));
 	 echo $this->Form->input('iso3166');
	 echo $this->Form->input('prefijo_tfno', array("label"=>"Prefijo telefónico"));
	?>
	</div>
 	<?php
 	echo $this->Form->end('Guardar país');
 ?>
