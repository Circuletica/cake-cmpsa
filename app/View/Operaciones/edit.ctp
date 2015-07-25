<h2>Modificar Operacion <em><?php echo $operacion['Operacion']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$operacion['Contrato']['referencia'],'/contratos/view/'.$operacion['Contrato']['id']);

echo 'Contrato: '.$operacion['Contrato']['referencia']."\n";
echo "<p>\n";
echo 'Proveedor: '.$operacion['Contrato']['Proveedor']['Empresa']['nombre']."\n";
echo "<p>\n";
echo 'Calidad: '.$operacion['Contrato']['CalidadNombre']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$operacion['Contrato']['CanalCompra']['nombre']."\n";
echo "<p>\n";
echo 'Peso total: '.$operacion['Contrato']['peso_comprado']."kg\n";
echo "<p>\n";
echo 'Embalaje: '.$embalaje['Embalaje']['nombre']."\n";
echo "<p>\n";
echo $this->Form->create('Operacion');
echo $this->Form->input('referencia');
//echo $this->Form->input('embalaje_id', array(
//	//'after' => '(quedan '.$embalajes_completo[1]['cantidad_embalaje'].' sin fijar)'
//	'after' => '(quedan ????? sin fijar)'
//	)
//);
//necesitamos un array con la cantidad asignada a cada socio
echo "<table>";
foreach ($asociados as $id => $asociado):
	echo "<tr>";
	echo "<td>".$asociado."</td>\n";
	echo "<td>";
	echo $this->Form->input('CantidadAsociado.'.$id, array(
		'label' => ''
		)
	);
	echo "</td>";
	echo "<td>";
	echo "?????? kg";
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
	'between' => '('.$operacion['Contrato']['CanalCompra']['divisa'].')'
	)
);
echo $this->Form->input('precio_compra', array(
	'between' => '('.$operacion['Contrato']['CanalCompra']['divisa'].')',
	'label' => 'Precio factura'
	)
);
echo $this->Form->input('opciones', array(
	'between' => '('.$operacion['Contrato']['CanalCompra']['divisa'].')',
	'label' => 'Opciones'
	)
);
echo $this->Form->input('flete', array(
	'between' => '('.$operacion['Contrato']['CanalCompra']['divisa'].')',
	'label' => 'Flete'
	)
);
echo $this->Form->input('cambio_dolar_euro', array(
	'label' => 'Cambio dolar/euro'
	)
);
echo $this->Form->end('Guardar Operacion');
?>
</div>
