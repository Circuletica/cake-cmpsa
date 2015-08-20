<?php
$this->extend('/Common/edit');
$this->assign('objeto', 'Flete '.$referencia);
$this->Html->addCrumb('Fletes','/fletes');
$this->Html->addCrumb('Flete '.$flete['Flete']['id'],'/fletes/view/'.$flete['Flete']['id']);
echo $this->Form->create('Flete');
echo '	<fieldset>';
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
	echo $this->Form->end('Guardar Flete');
echo'	</fieldset>';
//necesitamos un array con la cantidad asignada a cada socio
//echo "<table>";
////foreach ($asociados as $id => $asociado):
//foreach ($asociados as $codigo => $asociado):
//	echo "<tr>";
//	echo "<td>";
//	echo substr($codigo,-2);
//	echo "</td>\n";
//	echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
//	echo "<td>";
//	//echo $this->Form->input('CantidadAsociado.'.$id, array(
//	echo $this->Form->input('CantidadAsociado.'.$asociado['Asociado']['id'], array(
//		'label' => ''
//		)
//	);
//	echo "</td>";
//	echo "<td>";
//	echo "?????? kg";
//	echo "</td>";
//	echo "</tr>";
//endforeach;
//echo "</table>";
?>
</div>
