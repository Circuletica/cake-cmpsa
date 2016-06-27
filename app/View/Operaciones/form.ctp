<?php
if ($action == 'add') {
    echo "<h2>Añadir Operación a Contrato <em>".$contrato['Contrato']['referencia']."</em></h2>\n";
    $this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
}
if ($action == 'edit') {
    echo "<h2>Modificar Operación a Contrato <em>".$contrato['Contrato']['referencia']."</em></h2>\n";
    $this->Html->addCrumb('Operaciones','/operaciones');
}

//Pasamos la lista de 'embalajes_completo' del contrato al javascript de la vista
echo $this->Html->script('jquery')."\n"; // Include jQuery library
$this->Js->set('embalajesCompleto', $embalajes_completo);
$this->Js->set('precioFletes', $precio_fletes);
echo $this->Js->writeBuffer(array('onDomReady' => false));

echo $this->Form->create('Operacion');
//Info de la operación
?>
<fieldset>
    <legend>Info</legend>
<?php
echo "<dl>";
echo "<dt style=width:30%;>Proveedor</dt>\n";
echo "<dd style=margin-left:30%;>";
echo $proveedor.'&nbsp;';
echo "</dd>";
echo "<dt style=width:30%;>Calidad</dt>\n";
echo "<dd style=margin-left:30%;>";
echo $contrato['Contrato']['calidad'].'&nbsp;';
echo "</dd>";
echo "<dt style=width:30%;>Bolsa</dt>\n";
echo "<dd style=margin-left:30%;>";
echo $contrato['CanalCompra']['nombre'].' ('.$contrato['Incoterm']['nombre'].' )'.'&nbsp;';
echo "</dd>";
echo "<dt style=width:30%;>Peso total</dt>\n";
echo "<dd style=margin-left:30%;>";
echo $contrato['Contrato']['peso_comprado'].'kg&nbsp;';
echo "</dd>";
echo "<dt style=width:30%;>Peso sin fijar</dt>\n";
echo "<dd style=margin-left:30%;>";
echo $contrato['RestoContrato']['peso_restante'].'kg&nbsp;';
echo "</dd>";	
echo "</dl><br><hr style=border-width:2px><br>";	
echo $this->Form->input('observaciones');
?>
</fieldset>
<fieldset>
    <legend>Datos</legend>
    <div class='col2'>
<?php
echo $this->Form->input(
    'referencia',
    array(
		'autofocus' => 'autofocus'
    )
);
echo $this->Form->input(
    'embalaje_id',
    array(
		'after' => '(quedan ????? sin fijar)',
		'onchange' => 'pesoAsociado()'
    )
);
?>
    </div>
<?php
echo $this->Form->input(
    'lotes_operacion',
    array(
		'label'=> 'Lotes',	
		'after' => 'Quedan por fijar '.$contrato['RestoLotesContrato']['lotes_restantes'].' lotes'
    )
);
?>
<?php
echo $this->Form->input(
    'si_precio_fijo',
    array(
		'label' => 'Precio fijo ?',
		'type' => 'checkbox',
		'id' => 'siPrecioFijo',
		'onchange' => 'precioF()'
    )
);

echo $this->Form->input(
    'precio_directo_euro',
	array(
		'label' => 'Precio fijo',
		'id' => 'precioFijoEuro',
		'between' => '(€/kg)'
    )
);
?>
    <div class='linea'>
<?php
echo $this->Form->input(
    'fecha_pos_fijacion',
    array(
		'label' => 'Fecha de fijación',
		'class' => 'precioFijo',
		'dateFormat' => 'DMY',
		'minYear' => date('Y'),
		'maxYear' => date('Y')+5,
		'orderYear' => 'asc',
		'selected' => date('Y-m-1')
    )
);
?>
    </div>
    <div class='col2'>
<?php
//necesitamos un array con la cantidad asignada a cada socio
echo $this->Form->input(
    'puerto_carga_id',
    array(
		'label' => 'Puerto embarque',
		'class' => 'precioFijo',
		'default' => $puerto_carga_contrato_id,
		'empty' => array('' => ''),
		'onchange' => 'pesoAsociado()'
	)
);
echo $this->Form->input(
    'precio_fijacion',
    array(
		'label' => 'Precio fijación',	
		'class' => 'precioFijo',
		'between' => '('.$divisa.')'
    )
);
echo $this->Form->input(
    'precio_compra',
    array(
		'between' => '('.$divisa.')',
		'class' => 'precioFijo',
		'label' => 'Precio factura'
    )
);
echo $this->Form->input(
    'puerto_destino_id',
    array(
		'label' => 'Puerto destino',
		'class' => 'precioFijo',
		'default' => $puerto_destino_contrato_id,
		'empty' => array('' => ''),
		'onchange' => 'pesoAsociado()'
	)
);
echo $this->Form->input(
    'opciones',
    array(
		'label' => 'Opciones',
		'class' => 'precioFijo',
		'between' => '('.$divisa.')'
    )
);
?>
	<br><br>
    </div>
<?php
if ($contrato['Incoterm']['si_flete']) {
    echo $this->Form->input(
		'flete',
		array(
			'label' => 'Opciones',
			'class' => 'precioFijo',
			'type' => 'select',
			'options' => $fletes,
			'empty' => true,
			'between' => '($/Tm)',
			'label' => 'Flete'
		)
    );
}

if ($contrato['Incoterm']['si_seguro']) {
    echo $this->Form->input(
		'seguro',
		array(
			'label' => 'Seguro',
			'class' => 'precioFijo',
			'between' => '(%)'
		)
    );
}
?>
    <div class='col2'>
<?php
echo $this->Form->input(
    'forfait',
    array(
		'label' => 'Forfait',
		'class' => 'precioFijo',
		'between' => '(€/Tm)'
    )
);

echo $this->Form->input(
    'cambio_dolar_euro',
	array(
		'label' => 'Cambio',
		'class' => 'precioFijo',
		'between' => '($/€)'
    )
);

echo "</div>";
?>
</fieldset>
<fieldset>
    <legend>Asociados</legend>
    <table>
	<tr>
	  <th>Código</th>
	  <th>Asociado</th>
	  <th>Cantidad</th>
	  <th>Peso</th>
	</tr>
<?php
foreach ($asociados as $codigo => $asociado){
    echo "<tr>";
    echo "<td>";
    echo substr($codigo,-2);
    echo "</td>\n";
    echo "<td>".$asociado['Empresa']['nombre_corto']."</td>\n";
    echo "<td>";
    echo $this->Form->input(
	'CantidadAsociado.'.$asociado['Asociado']['id'],
	array(
	    'label' => '',
	    'class' => 'cantidad',
	    'id' => $asociado['Asociado']['id'],
	    'oninput' => 'pesoAsociado()'
	)
    );
    echo "</td>";
    echo "<td>";
    echo '<div style=width:100px; id=pesoAsociado'.$asociado['Asociado']['id'].'>'."= ??????kg".'</div>';
    echo "</td>";
    echo "</tr>";
}
?>
    </table>
<?php
echo '<div id=totalReparto>Total peso: ???kg</div>';
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Operación');
?>
</fieldset>

<script type="text/javascript">
    window.onload = pesoAsociado();
    window.onload = precioF();
</script>
