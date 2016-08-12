<?php
$this->Html->addCrumb('Tipos de IVA','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb('IVA '.$tipo_iva['nombre'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

if ($action == 'add') {
    echo "<h2>Añadir Valor a Tipo de IVA <em>".$tipo_iva['nombre']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Valor de Tipo de IVA <em>".$tipo_iva['nombre']."</em></h2>\n";
}

echo $this->Form->create();
echo "<fieldset>\n";
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_inicio', array(
    'label'=>'Fecha de Validez',
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-25,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc'
));
echo "</div>\n";
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_fin', array(
    'label'=>'Fecha de Caducidad',
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-25,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc',
    'empty' => true
));
echo "</div>\n";
echo $this->Form->input('valor', array('label' => 'Valor'));
echo $this->element('cancelarform');
echo $this->Form->end('Guardar valor');
echo "</fieldset>\n";
?>
