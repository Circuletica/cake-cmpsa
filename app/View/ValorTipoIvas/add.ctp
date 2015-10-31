<h2>Agregar valor a IVA <em><?php echo $tipo_iva['TipoIva']['nombre']?></em></h2>
<?php
$this->Html->addCrumb('Tipos de IVA','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb('IVA '.$tipo_iva['TipoIva']['nombre'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
echo $this->Form->create();
echo "<fieldset>\n";
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_inicio', array(
    'label'=>'Fecha de Validez',
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc'
    ));
echo "</div>\n";
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_fin', array(
    'label'=>'Fecha de Caducidad',
    'dateFormat' => 'DMY',
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc'
    ));
echo "</div>\n";
echo $this->Form->input('valor', array('label' => 'Valor'));
echo $this->Form->end('Guardar valor');
echo "</fieldset>\n";
?>
