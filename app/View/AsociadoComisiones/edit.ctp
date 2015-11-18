<h2>Modificar comisión <?php echo $this->request->data['Comision']['valor'].' de asociado '.$this->request->data['Asociado']['id']?></h2>
<?php
$this->Html->addCrumb('Asociados','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb($this->request->data['Asociado']['id'], '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
$this->Html->addCrumb('Modificar Comisión ', '/asociado_comisiones/edit/'.$this->request->data['AsociadoComision']['id'].'/'.'from_controller:'.$this->params['named']['from_controller'].'/from_id:'.$this->params['named']['from_id']);
echo $this->Form->create('AsociadoComision');
echo "<div class='linea'>\n";
echo $this->Form->input('AsociadoComision.fecha_inicio', array(
    'dateFormat' => 'DMY'
    )
);
echo $this->Form->input('AsociadoComision.fecha_fin', array(
    'empty' => true,
    'dateFormat' => 'DMY'
    )
);
echo "</div>\n";
echo $this->Form->input('AsociadoComision.comision_id', array(
    'label' => 'Comisión',
    'options' => $comisiones
    )
);
echo $this->Form->end('Guardar comisión');
?>
