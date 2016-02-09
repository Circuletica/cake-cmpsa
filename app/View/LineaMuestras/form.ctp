<script>
function totalCriba(){
    var arr = document.getElementsByClassName('criba');
    var tot=0;
    for(var i=0;i<arr.length;i++){
	if(parseFloat(arr[i].value))
	    tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value = tot.toFixed(1);
    console.log(tot);
    if(tot == 100)
	document.getElementById('total').style.color = "black";
    if(tot != 100)
	document.getElementById('total').style.color = "red";
}
</script>

<?php
if ($action == 'add') {
    echo "<h2>Añadir Línea a la muestra <em>".$muestra['tipo_registro']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Línea de la muestra <em>".$muestra['tipo_registro']."</em></h2>\n";
}

$this->Html->addCrumb('Muestras','/muestras');
$this->Html->addCrumb('Muestra '.$muestra['registro'],'/muestras/view/'.$muestra['id']);

?>
<?php
//Pasamos la lista de 'operacion_almacenes' al javascript de la vista
echo $this->Html->script('jquery')."\n"; // Include jQuery library
if (isset($operacion_almacenes)) {
    $this->Js->set('operacionAlmacenes', $operacion_almacenes);
    echo $this->Js->writeBuffer(array('onDomReady' => false));
}

echo $this->Form->create();
?>
	<div class="col3">
<?php
echo $this->Html->tableCells(array(
    $this->Form->input('humedad'),
    $this->Form->input('tueste'),
    $this->Form->input(
	'referencia_proveedor',
	array(
	    'label' => 'Referencia Proveedor'
	)
    ),
    isset($operaciones) && $muestra['tipo']!='1' ?
    $this->Form->input(
	'operacion_id',
	array(
	    'empty' => true,
	    'label' => 'Operación',
	    'onchange' => 'operacionAlmacen()'
	)
    )
    : '',
    isset($operacion_almacenes) && $muestra['tipo']!='1' ?
    $this->Form->input(
	'almacen_transporte_id',
	array(
	    'empty' => true,
	    'label' => 'Cuenta Almacén' 
	)
    )
    : ''
)
);
?>
	</div>
	<div class="col2">
<?php
echo $this->Form->input('apreciacion_bebida', array(
    'label' => 'Bebida')
);

echo $this->Form->input('defecto');
?>
	</div>
<?php
echo $this->Form->input('observaciones');
?>
	<div class="col4">
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
    'Total : <input type="number" name="total" id="total"/>'
)
	)."\n";
?>
</div>
<?php
echo $this->Form->end('Guardar Linea de muestra');
?>
<script type="text/javascript">
window.onload = totalCriba();
window.onload = operacionAlmacen();
</script>
