<h2>Modificar Incoterms</h2>
<?php
$this->Html->addCrumb('Modificar Incoterms');
echo $this->Form->create('Incoterms', array('action' => 'edit'));?>
<fieldset>
<?php
   echo $this->Form->input('nombre');
   echo $this->Form->input('id', array('type'=>'hidden'));
   echo $this->Form->end('Guardar Incoterms');
?>
</fieldset>