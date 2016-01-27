<div class="add">
<?php
$this->Html->addCrumb('Muestras', '/muestras');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'contratosMuestra' del contrato al javascript de la vista
$this->Js->set('contratosMuestra', $contratosMuestra);
$this->Js->set('contratosEmbarque', $contratosEmbarque);
echo $this->Js->writeBuffer(array('onDomReady' => false));
?>

<?php
if ($action == 'add') {
    echo "<h2>Añadir Muestra de ".$tipo_nombre."</h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Muestra de ".$tipo_nombre."</h2>\n";
}

$siglas_tipos = array(
    1 => 'OF',
    2 => 'EB',
    3 => 'EN'
);

//si no esta la calidad en el listado, dejamos un enlace para
//agragarla
$enlace_anyadir_calidad = $this->Html->link (
    'Añadir Calidad',
    array(
	'controller' => 'calidades',
	'action' => 'add',
	'from_controller' => 'muestras',
	'from_action' => 'add',
    )
);
//si no esta el proveedor en el listado, dejamos un enlace para
//agregarlo
$enlace_anyadir_proveedor = $this->Html->link (
    'Añadir Proveedor',
    array(
	'controller' => 'proveedores',
	'action' => 'add',
	'from_controller' => 'muestras',
	'from_action' => 'add',
    )
);
echo $this->Form->create('Muestra');
?>
<fieldset>
<?php
echo $this->Form->hidden(
    'tipo',
    array(
	'value' => $tipo
    )
);
if ($action == 'add') {
    echo $this->Form->input(
	'registro',
	array(
	    'autofocus' => 'autofocus',
	    'between' => $siglas_tipos[$tipo].'-',
	    'value' => $nuevo_registro
	)
    );
} else {
    echo $this->Form->input(
	'registro',
	array(
	    'autofocus' => 'autofocus',
	    'between' => $siglas_tipos[$tipo].'-',
	)
    );
}
echo $this->Form->input(
    'aprobado',
    array(
	'label' => (
	    $tipo == 1 ?
	    'Comprado' : 'Aprobado'
	),
	//si es una muestra de oferta y esta comprado, podemos indicar el contrato
	//correspondiente
	'onchange' => ($tipo == 1 ? 'muestraOferta()':'')
    )
);
echo $this->Form->input('contrato_id',
    array(
	'empty' => true,
	'disabled' => ($tipo == 1),
	'onchange' => 'contratosMuestra()'
    )
);
if ($tipo == 3) {
    echo $this->Form->input(
	'muestra_embarque_id',
	array(
	    'empty' => true,
	    //'onchange' => 'muestraEntrega()',
	    //'disabled' => 1,
	    //'id' => 'embarque'
	)
    );
}
echo $this->Form->input(
    'calidad_id',
    array(
	'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	//'id' => 'combobox',
	//si no es oferta, solo se introduce la referencia de contrato
	'disabled' => $tipo != 1
    )
);
echo $this->Form->input(
    'proveedor_id',
    array(
	'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	//'id' => 'proveedor',
	//si no es oferta, solo se introduce la referencia de contrato
	'disabled' => $tipo != 1
    )
);
echo 'Transporte : <var id="transporte_contrato"></var>';
echo "<p>\n";
?>
</fieldset>
<fieldset>
	    <div class="linea">
<?php
echo $this->Form->input('fecha', array(
    'dateFormat' => 'DMY',
    'timeFormat' => null )
);
?>
	    </div>

<?php
echo $this->Form->input('incidencia');
echo $this->Html->link('Cancelar', $this->request->referer(''), array('class' => 'botond'));  
echo $this->Form->end('Guardar Muestra');
?>
</div>
</fieldset>

<script type="text/javascript">
window.onload = contratosMuestra();
<?php 
if ($tipo == 1) 
    echo 'window.onload = muestraOferta();';
?>
</script>
