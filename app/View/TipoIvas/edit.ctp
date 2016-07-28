<h2>Modificar <?php echo $referencia?></h2>
<?php
$this->Html->addCrumb('IVA','/tipo_ivas');
echo $this->Form->create('TipoIva', array('action' => 'edit'));
echo $this->Form->create();
echo $this->Form->input('nombre');
echo $this->element('cancelarform');
echo $this->Form->end('Guardar IVA');
?>
