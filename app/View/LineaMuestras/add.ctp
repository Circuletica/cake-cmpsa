<h2>Agregar linea a Muestra <em><?php echo $muestra['Muestra']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Muestras','/muestras');
$this->Html->addCrumb('Muestra '.$muestra['Muestra']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
echo $this->Form->create();
echo $this->Form->input('marca');
echo $this->Form->input('numero_sacos');
echo $this->Form->input('referencia_proveedor',array(
	'label' => 'Referencia Proveedor('.$proveedor.')')
	);
echo $this->Form->input('referencia_almacen',array(
	'label' => 'Referencia Almacén('.$almacen.')')
	);
echo $this->Form->input('humedad');
echo $this->Form->input('tueste');
echo $this->Form->input('defecto');
echo $this->Form->input('criba20');
echo $this->Form->input('criba19');
echo $this->Form->input('criba13p');
echo $this->Form->input('criba18');
echo $this->Form->input('criba12p');
echo $this->Form->input('criba17');
echo $this->Form->input('criba11p');
echo $this->Form->input('criba16');
echo $this->Form->input('criba10p');
echo $this->Form->input('criba15');
echo $this->Form->input('criba9p');
echo $this->Form->input('criba14');
echo $this->Form->input('criba8p');
echo $this->Form->input('criba13');
echo $this->Form->input('criba12');
echo $this->Form->input('apreciacion_bebida');
echo $this->Form->end('Guardar Linea de muestra');
?>
