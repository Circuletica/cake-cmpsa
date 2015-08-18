<h2>Agregar Operacion a Contrato <em><?php echo $contrato['Contrato']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

echo 'Proveedor: '.$proveedor."\n";
echo "<p>\n";
echo 'Calidad: '.$contrato['CalidadNombre']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$contrato['CanalCompra']['nombre'].
	' ('.$contrato['Incoterm']['nombre'].")\n";
echo "<p>\n";
echo 'Peso total: '.$contrato['Contrato']['peso_comprado']."\n";
echo "<p>\n";
echo 'Peso sin fijar: '.$contrato['RestoContrato']['peso_restante']."\n";
echo "<p>\n";
echo $this->Form->create('Operacion');
echo $this->Form->input('referencia');
echo $this->Form->input('embalaje_id', array(
	//'after' => '(quedan '.$embalajes_completo[1]['cantidad_embalaje'].' sin fijar)'
	'after' => '(quedan ????? sin fijar)'
	)
);
//necesitamos un array con la cantidad asignada a cada socio
echo "<table>";
//foreach ($asociados as $id => $asociado):
foreach ($asociados as $codigo => $asociado):
	echo "<tr>";
	echo "<td>";
	echo substr($codigo,-2);
	echo "</td>\n";
	echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
	echo "<td>";
	echo $this->Form->input('CantidadAsociado.'.$asociado['Asociado']['id'], array(
		'label' => ''
		)
	);
	echo "</td>";
	echo "<td>";
	//echo $embalajes_completo[1]['peso_embalaje_real'];
	echo "?????? kg";
	echo "</td>";
	echo "</tr>";
endforeach;
echo "</table>";
echo "<div class='linea'>\n";
echo $this->Form->input('lotes_operacion',
	array(
		'label' => 'Lotes <em>(Quedan por fijar '.$contrato['RestoLotesContrato']['lotes_restantes'].' lotes)</em>'
	)
);
echo $this->Form->input('fecha_pos_fijacion', array(
	'label' => 'Fecha de fijación',
	'dateFormat' => 'DMY',
	'minYear' => date('Y'),
	'maxYear' => date('Y')+5,
	'orderYear' => 'asc',
	'selected' => date('Y-m-1')
	)
);
		echo "</div>\n";
echo $this->Form->input('precio_fijacion', array(
	'between' => '('.$divisa.')'
	)
);
echo $this->Form->input('precio_compra', array(
	'between' => '('.$divisa.')',
	'label' => 'Precio factura'
	)
);
echo $this->Form->input('opciones', array(
	'between' => '('.$divisa.')',
	'label' => 'Opciones'
	)
);
if ($contrato['Incoterm']['si_flete']) {
	echo $this->Form->input('flete', array(
		'between' => '($/Tm)',
		'label' => 'Flete'
		)
	);
}
if ($contrato['Incoterm']['si_seguro']) {
	echo $this->Form->input('seguro', array(
		'between' => '(%)',
		'label' => 'Seguro'
		)
	);
}
echo $this->Form->input('forfait', array(
	'between' => '(€/Tm)',
	'label' => 'Forfait'
	)
);
echo $this->Form->input('cambio_dolar_euro', array(
	'label' => 'Cambio dolar/euro'
	)
);
	echo $this->Form->input('comentario');
	echo $this->Form->end('Guardar Operacion');
?>
</div>

