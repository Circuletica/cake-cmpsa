<h1>Modificar Calidad</h1>
<?php
$this->Html->addCrumb('Calidades', array(
    'controller' => 'calidades',
    'action' => 'index')
  );
   echo $this->Form->create('Calidad', array('action' => 'edit'));
   ?>
   <fieldset>
    <div class="columna2">
    <?php
       echo $this->Form->input('descafeinado');
       	//Un café 'Blend' se guarda como pais_id==null en la BD
      	echo $this->Form->input('pais_id', array(
    		'label' =>'Origen',
      		'empty' => 'Blend')
    	 );
    ?>
    </div>
    <?php
   echo $this->Form->input('descripcion', array("label"=>'Descripción'));
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar Calidad');
?>
</fieldset>
