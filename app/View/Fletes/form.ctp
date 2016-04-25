<h2>Añadir Flete</h2>
<?php
	$this->Html->addCrumb('Fletes', array(
		'controller' => 'fletes',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Flete', array(
		'controller' => 'fletes',
		'action' => 'add')
	);
	echo $this->Form->create('Flete');
	?>
	<fieldset>
    <?php	
  	echo $this->Form->input('naviera_id');
	echo $this->Form->input(
		'puerto_carga_id',
		array(
			'label' => 'Puerto de Carga',
			'options' => $puerto_cargas
		)
	);
	echo $this->Form->input(
		'puerto_destino_id',
		array(
			'label' => 'Puerto de Destino',
			'options' => $puerto_destinos
		)
	);
	echo $this->Form->input(
		'embalaje_id',
		array(
			'label' => 'Embalaje',
			'empty' => true
		)
	);
	echo $this->Form->input(
		'peso_contenedor_tm',
		array('label' => 'Peso contenedor (Tm)')
	);
	echo $this->Form->input(
		'contrato',
		array('label' => 'Contrato naviera')
	);
	  echo $this->element('cancelarform');
	echo $this->Form->end('Guardar Flete');
?>
</fieldset>
