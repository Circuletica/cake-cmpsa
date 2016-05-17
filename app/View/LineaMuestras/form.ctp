
<?php
//Pasamos la lista de 'operacion_almacenes' al javascript de la vista
echo $this->Html->script('jquery')."\n"; // Include jQuery library
if (isset($operacion_almacenes)) {
    $this->Js->set('operacionAlmacenes', $operacion_almacenes);
    echo $this->Js->writeBuffer(array('onDomReady' => false));
}

echo $this->Form->create();
if ($action == 'add') {
    echo "<h2>Añadir Línea a la muestra <em>".$muestra['tipo_registro']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Línea de la muestra <em>".$muestra['tipo_registro']."</em></h2>\n";
}

$this->Html->addCrumb('Muestras de '.$muestra['tipo_nombre'],'/muestras/index/Search.tipo_id:'.$muestra['tipo_id']);
$this->Html->addCrumb('Muestra '.$muestra['tipo_registro'],'/muestras/view/'.$muestra['id']);

?>
<fieldset>
<legend>Datos</legend>
<?php

echo $this->Html->tableCells(
    array(
	$this->Form->input(
	    'humedad',
	    array('autofocus' => 'autofocus')
	),
	$this->Form->input('tueste'),
	isset($operaciones) && $muestra['tipo_id']!='1' ?
	$this->Form->input(
	    'operacion_id',
	    array(
		'empty' => true,
		'label' => 'Operación',
		'onchange' => 'operacionAlmacen()'
	    )
	)
	: '',
	$this->Form->input('tueste'),
	$this->Form->input(
	    'referencia_proveedor',
	    array(
		'label' => 'Referencia Proveedor'
	    )
	),
	isset($operaciones) && $muestra['tipo_id']!='1' ?
	$this->Form->input(
	    'operacion_id',
	    array(
		'empty' => true,
		'label' => 'Operación',
		'onchange' => 'operacionAlmacen()'
	    )
	)
	: '',
	isset($operacion_almacenes) && $muestra['tipo_id']!='1' ?
	$this->Form->input(
	    'almacen_transporte_id',
	    array(
		'empty' => true,
		'label' => 'Cuenta almacén',
		'onchange' => 'operacionAlmacen()'
	    )
	)
	: '',
	$this->Form->input('sacos'),
	$this->Form->input(
	    'si_facturado',
	    array(
		'label' => 'Facturado'
	    ) 
	),
	$this->Form->input(
	    'dato_factura',
	    array(
		'label' => 'Datos de factura'
	    )
	)
    )
);
?>
</fieldset>
<fieldset>
<br>
<?php
echo $this->Form->input('apreciacion_bebida', array(
    'label' => 'Bebida')
);

echo $this->Form->input('defecto');
echo $this->Form->input('observaciones');
?>
<hr>
</fieldset>
<fieldset>	
<legend>Criba</legend>
	<div class="col2">
<?php

echo $this->Html->tableCells(array(
    $this->Form->input('criba20', array(
	'label' => 'Criba 20',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba19', array(
	'label' => 'Criba 19',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba13p', array(
	'label' => 'Caracol 13',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba18', array(
	'label' => 'Criba 18',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba12p', array(
	'label' => 'Caracol 12',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba17', array(
	'label' => 'Criba 17',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba11p', array(
	'label' => 'Caracol 11',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba16', array(
	'label' => 'Criba 16',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba10p', array(
	'label' => 'Caracol 10',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba15', array(
	'label' => 'Criba 15',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba9p', array(
	'label' => 'Caracol 9',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba14', array(
	'label' => 'Criba 14',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba8p', array(
	'label' => 'Caracol 8',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    $this->Form->input('criba13', array(
	'label' => 'Criba 13',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    )
)

	)."\n";
echo $this->Html->tableCells(array(
    $this->Form->input('criba12', array(
	'label' => 'Criba 12',
	'class' => 'criba',
	'oninput' => 'totalCriba()')
    ),
    '<div id="total">TOTAL: </div>'
)
	)."\n";
?>
</div>
<?php
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Linea de muestra');
?>
</fieldset>
<script type="text/javascript">
window.onload = totalCriba();
window.onload = operacionAlmacen();
</script>
