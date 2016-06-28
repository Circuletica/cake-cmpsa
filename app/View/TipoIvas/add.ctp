<h2>Añadir IVA</h2>
<?php
$this->Html->addCrumb('IVA','/tipo_ivas');
echo $this->Form->create();
echo $this->Form->input('nombre');
echo $this->element('cancelarform');
echo $this->Form->end('Guardar IVA');
?>
