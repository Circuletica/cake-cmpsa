<h2>Modificar País </h2>
<?php
$this->Html->addCrumb('Países', '/paises');
$this->Html->addCrumb('Modificar País');
echo $this->Form->create('Pais', array('action' => 'edit'));?>
<div class="col3">
<?php

   echo $this->Form->input('nombre',array("label"=>"Nombre del país"));
   echo $this->Form->input('iso3166');
   echo $this->Form->input('prefijo_tfno', array('label'=>'Prefijo Telefónico'));
   	?>
	</div>
 	<?php
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar país');
?>
