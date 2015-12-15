<div class="add">
<?php
$this->Html->addCrumb('Muestras', '/muestras');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'contratosMuestra' del contrato al javascript de la vista
$this->Js->set('contratosMuestra', $contratosMuestra);
$this->Js->set('muestrasEmbarque', $muestrasEmbarque);
echo $this->Js->writeBuffer(array('onDomReady' => false));
?>

<?php
echo "<h2>Añadir Muestra de ".$tipos[$this->request->data['Muestra']['tipo']]."</h2>";
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
//agragarlo
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
echo $this->Form->input('registro');
echo $this->Form->input(
    'aprobado',
    array(
	'label' => (
	    $this->request->data['Muestra']['tipo'] == 1 ?
	    'Comprado' : 'Aprobado'
	),
	'onchange' => ($this->request->data['Muestra']['tipo'] == 1 ? 'muestraOferta()':'')
    )
);
if ($this->request->data['Muestra']['tipo'] == 3) {
    echo $this->Form->input(
	'muestra_embarque_id',
	array(
	    'empty' => true
	)
    );
}
echo $this->Form->input('contrato_id',
    array(
	'empty' => true,
	'disabled' => $this->request->data['Muestra']['tipo'] == 1,
	'onchange' => 'contratosMuestra()'
    )
);
echo $this->Form->input(
    'calidad_id',
    array(
	'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	'id' => 'combobox',
	//si no es oferta, solo se introduce la referencia de contrato
	'disabled' => $this->request->data['Muestra']['tipo'] != 1
    )
);
echo $this->Form->input(
    'proveedor_id',
    array(
	'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	'id' => 'proveedor',
	//si no es oferta, solo se introduce la referencia de contrato
	'disabled' => $this->request->data['Muestra']['tipo'] != 1
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
</script>
