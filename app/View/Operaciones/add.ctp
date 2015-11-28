<h2>Agregar Operacion a Contrato <em><?php echo $contrato['Contrato']['referencia']?></em></h2>

<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

//Pasamos la lista de 'embalajes_completo' del contrato al javascript de la vista
echo $this->Html->script('jquery')."\n"; // Include jQuery library
$this->Js->set('embalajesCompleto', $embalajes_completo);
echo $this->Js->writeBuffer(array('onDomReady' => false));

echo $this->Form->create('Operacion');
//Info de la operación
?>
	<fieldset>
	<legend>Info</legend>
<?php
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
?>
		<div class="col2">
<?php
echo $this->Form->input('referencia');
echo $this->Form->input('embalaje_id', array(
    //'after' => '(quedan '.$embalajes_completo[1]['cantidad_embalaje'].' sin fijar)'
    'after' => '(quedan ????? sin fijar)',
    //'onchange' => 'pesoAsociado(this)'
    'onchange' => 'pesoAsociado()'
)
			);
?>
		</div>
		<div class="col2">
<?php
echo $this->Form->input('lotes_operacion',
    array(
	'label' => 'Lotes <em>(Quedan por fijar '.$contrato['RestoLotesContrato']['lotes_restantes'].' lotes)</em>'
    )
);
?>
						<div class='linea'>
<?php
echo $this->Form->input('fecha_pos_fijacion', array(
    'label' => 'Fecha de fijación',
    'dateFormat' => 'DMY',
    'minYear' => date('Y'),
    'maxYear' => date('Y')+5,
    'orderYear' => 'asc',
    'selected' => date('Y-m-1')
)
						);

?>
						</div>
		</div>
		<div class="col2">
<?php
//necesitamos un array con la cantidad asignada a cada socio
echo $this->Form->input('puerto_carga_id', array(
    'label' => 'Puerto de embarque',
    'default' => $puerto_carga_contrato_id,
    'empty' => array('' => '')
)
		);
echo $this->Form->input('puerto_destino_id', array(

    'label' => 'Puerto de destino',
    'default' => $puerto_destino_contrato_id,
    'empty' => array('' => '')
)
		);
?>
		</div>
		<div class="col4">
<?php
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
	'type' => 'select',
	'options' => $fletes,
	'empty' => true,
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
?>
<?php
echo $this->Form->input('forfait', array(
    'between' => '(€/Tm)',
    'label' => 'Forfait'
)
		);
echo $this->Form->input('cambio_dolar_euro', array(
    'label' => 'Cambio dolar/euro'
)
		);
?>
		</div>
<?php
echo $this->Form->input('comentario');
?>
		</fieldset>
		<fieldset>
		<legend>Asociados</legend>
				<table>
<?php
foreach ($asociados as $codigo => $asociado):
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
    'oninput' => 'pesoAsociado()'
)
					);
echo "</td>";
echo "<td>";
echo '<div id=pesoAsociado'.$asociado['Asociado']['id'].'>'."= ??????kg".'</div>';
echo "</td>";
echo "</tr>";
endforeach;
?>
				</table>
<?php
echo $this->Html->Link('<i class="fa fa-times"></i> Cancelar', $this->request->referer(''), array('class' => 'botond', 'escape'=>false));
echo $this->Form->end('Guardar Operación');
?>
		</fieldset>

<script type="text/javascript">
window.onload = pesoAsociado();
</script>
