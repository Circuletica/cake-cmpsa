<h2>Modificar Operacion <em><?php echo $operacion['Operacion']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$contrato['referencia'],'/contratos/view/'.$contrato['id']);

//Pasamos el peso del embalaje de la operacion al javascript de la vista
echo $this->Html->script('jquery')."\n"; // Include jQuery library
$this->Js->set('pesoEmbalaje', $peso_embalaje_real);
echo $this->Js->writeBuffer(array('onDomReady' => false));

echo 'Contrato: '.$contrato['referencia']."\n";
echo "<p>\n";
echo 'Proveedor: '.$contrato['Proveedor']['nombre_corto']."\n";
echo "<p>\n";
echo 'Calidad: '.$contrato['Calidad']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$contrato['CanalCompra']['nombre'].
    ' ('.$contrato['Incoterm']['nombre'].")\n";
echo "<p>\n";
echo 'Peso total del contrato: '.$contrato['peso_comprado']."kg\n";
echo "<p>\n";
echo 'Embalaje: '.$operacion['Embalaje']['nombre']."\n";
echo "<p>\n";
echo $this->Form->create('Operacion');
echo $this->Form->input('referencia');
//necesitamos un array con la cantidad asignada a cada socio
echo "<table>";
foreach ($asociados as $codigo => $asociado) {
    echo "<tr>";
    echo "<td>";
    echo substr($codigo,-2);
    echo "</td>\n";
    echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
    echo "<td>";
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
}
echo "</table>";
echo '<div id=totalReparto>'."Total sacos: ??? / Total peso: ???kg".'</div>';
echo "<div class='linea'>\n";
//Los lotes que quedan por fijar = los de RestoLotesContrato +
//los de esta operacion visto que estamos editando.
$lotes_por_fijar = $contrato['RestoLotesContrato']['lotes_restantes'] + $this->request->data['Operacion']['lotes_operacion'];
echo $this->Form->input('lotes_operacion',
    array(
	'label' => 'Lotes <em>(Quedan por fijar <var id="lotes">'.$lotes_por_fijar.'</var> lotes)</em>',
	'oninput' => 'lotesPorFijar()'
    )
);

echo $this->Form->input('puerto_carga_id', array(
    'label' => 'Puerto de Carga',
    'empty' => array('' => '')
)
);

echo $this->Form->input('puerto_destino_id', array(
    'label' => 'Puerto de Destino',
    'empty' => array('' => '')
)
);

echo $this->Form->input('fecha_pos_fijacion', array(
    'label' => 'Fecha de fijación',
    'dateFormat' => 'DMY',
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
	'between' => '(€/Tm)',
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
echo $this->Form->input('peso_pagado', array(
    'label' => 'Peso factura'
)
);
echo $this->Form->input(
    'observaciones',
    array(
	'label' => 'Comentarios'
    )
);
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Operacion');
?>
</div>

<script type="text/javascript">
window.onload = pesoAsociadoEdit();
</script>

