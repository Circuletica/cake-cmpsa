<h2>Modificar Operacion <em><?php echo $operacion['Operacion']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$operacion['Contrato']['referencia'],'/contratos/view/'.$operacion['Contrato']['id']);

	//Pasamos el peso del embalaje de la operacion al javascript de la vista
	echo $this->Html->script('jquery')."\n"; // Include jQuery library
	$this->Js->set(compact('pesoEmbalaje'));
	echo $this->Js->writeBuffer(array('onDomReady' => false));

echo 'Contrato: '.$operacion['Contrato']['referencia']."\n";
echo "<p>\n";
echo 'Proveedor: '.$operacion['Contrato']['Proveedor']['Empresa']['nombre']."\n";
echo "<p>\n";
echo 'Calidad: '.$operacion['Contrato']['CalidadNombre']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$operacion['Contrato']['CanalCompra']['nombre'].
	' ('.$operacion['Contrato']['Incoterm']['nombre'].")\n";
echo "<p>\n";
echo 'Peso total del contrato: '.$operacion['Contrato']['peso_comprado']."kg\n";
echo "<p>\n";
echo 'Embalaje: '.$embalaje['Embalaje']['nombre']."\n";
echo "<p>\n";
echo $this->Form->create('Operacion');
echo $this->Form->input('referencia');
//necesitamos un array con la cantidad asignada a cada socio
echo "<table>";
foreach ($asociados as $codigo => $asociado):
	echo "<tr>";
	echo "<td>";
	echo substr($codigo,-2);
	echo "</td>\n";
	echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
	echo "<td>";
	//echo $this->Form->input('CantidadAsociado.'.$id, array(
	echo $this->Form->input('CantidadAsociado.'.$asociado['Asociado']['id'], array(
		'label' => '',
		'class' => 'cantidad',
		'id' => $asociado['Asociado']['id'],
		'oninput' => 'pesoAsociadoEdit()'
		)
	);
	echo "</td>";
	echo "<td>";
	echo '<div id=pesoAsociado'.$asociado['Asociado']['id'].'>'." = ??????kg".'</div>';
	echo "</td>";
	echo "</tr>";
endforeach;
echo "</table>";
echo "<div class='linea'>\n";
//Los lotes que quedan por fijar = los de RestoLotesContrato +
//los de esta operacion visto que estamos editando.
$lotes_por_fijar = $operacion['Contrato']['RestoLotesContrato']['lotes_restantes'] + $this->request->data['Operacion']['lotes_operacion'];
echo $this->Form->input('lotes_operacion',
	array(
		'label' => 'Lotes <em>(Quedan por fijar <var id="lotes">'.$lotes_por_fijar.'</var> lotes)</em>',
		'oninput' => 'lotesPorFijar()'

	)
);
echo $this->Form->input('fecha_pos_fijacion', array(
	'label' => 'Fecha de fijación',
	'dateFormat' => 'DMY',
	//'selected' => date('Y-m-1')
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
if ($operacion['Contrato']['Incoterm']['si_flete']) {
	echo $this->Form->input('flete', array(
		'between' => '(€/Tm)',
		'label' => 'Flete'
		)
	);
}
if ($operacion['Contrato']['Incoterm']['si_seguro']) {
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

<script type="text/javascript">
	window.onload = pesoAsociadoEdit();
</script>
