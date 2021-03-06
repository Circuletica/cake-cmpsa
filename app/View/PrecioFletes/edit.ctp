<?php
$this->extend('/Common/edit');
$this->assign('objeto', 'Precio Flete '.$flete['Flete']['id']);
$this->Html->addCrumb('Fletes','/fletes');
$this->Html->addCrumb('Fletes','/'.$this->params['named']['from_controller']);
$this->Html->addCrumb('Flete '.$flete['Flete']['id'],'/fletes/view/'.$flete['Flete']['id']);
echo $this->Form->create('PrecioFlete');
?>
<fieldset>
<?php
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_inicio', array(
	  'label'=>'Fecha de Validez',
	  'dateFormat' => 'DMY',
	  'minYear' => date('Y')-1,
	  'maxYear' => date('Y')+5,
	  'orderYear' => 'asc'
	  )
    );
echo "</div>\n";
?>
</fieldset>
<fieldset>
<?php
  echo "<div class='linea'>\n";
    echo $this->Form->input('fecha_fin', array(
	  'label'=>'Fecha de Caducidad',
	  'dateFormat' => 'DMY',
	  'minYear' => date('Y')-1,
	  'maxYear' => date('Y')+5,
	  'orderYear' => 'asc'
	  )
    );
  echo "</div>\n";
?>
</fieldset>
<fieldset>
<?php
echo $this->Form->input('coste_contenedor_dolar', array(
    'label' => 'Coste de flete ($/contenedor)'
  )
);
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Precio');
?>
</fieldset>