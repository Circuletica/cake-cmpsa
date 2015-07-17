<h2>Modificar Calidad</h2>
<?php
$this->Html->addCrumb('Calidades', array(
    'controller' => 'calidades',
    'action' => 'index')
  );

  echo $this->Form->create('Calidad', array('action' => 'edit'));
   $enlace_anyadir_origen = $this->Html->link ('<i class="fa fa-plus"></i> Añadir Origen', 'javascript:;', array(
    'onclick' => "var openWin = window.open('".$this->Html->url(array(
      'controller' => 'paises',
      'action' => 'add',
      'from_controller' => 'calidades',
      'from_action' => 'add'))."', '_blank',
      'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=500,height=500');  return false;",
      "class"=>"botond",
      'escape' => false)
    );
   ?>
   <fieldset>
    <div class="columna2">
    <?php
      echo $this->Form->input('descafeinado');
       	//Un café 'Blend' se guarda como pais_id==null en la BD
    ?>
    <div class="formuboton">
    <ul>
        <li>
    <?php
      echo $this->Form->input('pais_id', array(
    	   'label' =>'Origen',
      	 'empty' => 'Blend',
         'class' => 'listado')
    	 );
    ?>
      </li>
      <li>
      <div class="enlinea">
        <?php      
        echo $enlace_anyadir_origen
        ?>
      </div>
      </li>
   </ul>
   </div>
   <?php
   echo $this->Form->input('descripcion', array("label"=>'Descripción'));
   echo $this->Form->input('id', array('type'=>'hidden'));
       ?>
    </div>
    <?php
   echo $this->Form->end('Guardar Calidad');

?>
</fieldset>
