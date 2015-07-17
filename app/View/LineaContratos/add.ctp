<h2>Agregar linea a Contrato <em><?php echo $contrato['Contrato']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

echo 'Proveedor: '.$proveedor."\n";
echo "<p>\n";
echo 'Calidad: '.$contrato['CalidadNombre']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$contrato['CanalCompra']['nombre']."\n";
echo "<p>\n";
echo 'Peso total: '.$contrato['Contrato']['peso_comprado']."\n";
echo "<p>\n";
echo 'Peso sin fijar: '.$contrato['RestoContrato']['peso_restante']."\n";
echo "<p>\n";
echo $this->Form->create('LineaContrato');
echo $this->Form->input('referencia');
echo $this->Form->input('embalaje_id', array(
	'after' => '(quedan '.$embalajes_contrato[0]['ContratoEmbalaje']['cantidad_embalaje'].' sin fijar)'
	)
);
//echo $this->Form->input('peso_linea_contrato');
//necesitamos un select multiple con la cantidad asignada a cada socio
echo $this->Form->input('asociado_id');
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_pos_fijacion', array(
	'label' => 'Fecha de fijación',
	'dateFormat' => 'DMY')
);
		echo "</div>\n";
echo $this->Form->input('precio_fijacion', array(
	'between' => '('.$contrato['CanalCompra']['divisa'].')'
	)
);
echo $this->Form->input('precio_compra', array(
	'between' => '('.$contrato['CanalCompra']['divisa'].')'
	)
);
echo $this->Form->end('Guardar Linea de contrato');
?>
</div>

