<?php
$this->Html->addCrumb('Asociados','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb($asociado_nombre, '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

if ($action == 'add') {
    echo "<h2>Añadir Comisión a Asociado <em>".$asociado_nombre."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Comisión de Asociado <em>".$asociado_nombre."</em></h2>\n";
}

echo $this->Form->create('AsociadoComision');
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_inicio', array(
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc',
    'selected' => ($action == 'add' ? date('Y-1-1') : '')
    )
);
echo $this->Form->input('fecha_fin', array(
    'empty' => true,
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc',
    'selected' => ($action == 'add' ? date('Y-12-31') : '')
    )
);
echo "</div>\n";
echo $this->Form->input('comision_id', array(
    'label' => 'Comisión',
    'options' => $comisiones
    )
);
echo $this->Form->input('asociado_id', array(
    'type' => 'hidden',
    'value' => $asociado_id
));
echo $this->element('cancelarform');
echo $this->Form->end('Guardar comisión');
?>
