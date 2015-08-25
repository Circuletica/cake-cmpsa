<h2>Agregar precio a <em><?php echo $flete['Flete']['id']?></em></h2>
<?php
  $this->Html->addCrumb('Fletes','/'.$this->params['named']['from']);
  $this->Html->addCrumb($flete['Flete']['id'], '/'.$this->params['named']['from'].'/view/'.$this->params['named']['from_id']);
  $this->Html->addCrumb('Añadir Precio de flete ', '/precio_fletes/add/'.'from:'.$this->params['named']['from'].'/from_id:'.$this->params['named']['from_id']);
  echo $this->Form->create();
   ?>
  <fieldset>
  <?php
  echo $this->Form->input('coste_contenedor_dolar', array(
      'label' => 'Coste de flete ($/contenedor)'
  )
);
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
  echo $this->Form->end('Guardar precio');
?>
</fieldset>
