<h2>Añadir comisión para asociado <?php echo $asociado_nombre?></h2>
<?php
$this->Html->addCrumb('Asociados','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb($asociado_nombre, '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
$this->Html->addCrumb('Modificar Comisión ', '/asociado_comisiones/edit/'.$this->request->data['AsociadoComision']['id'].'/'.'from_controller:'.$this->params['named']['from_controller'].'/from_id:'.$this->params['named']['from_id']);
echo $this->Form->create('AsociadoComision');
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_inicio', array(
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc'
    )
);
echo $this->Form->input('fecha_fin', array(
    'empty' => true,
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc'
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
echo $this->Form->end('Guardar comisión');
?>
