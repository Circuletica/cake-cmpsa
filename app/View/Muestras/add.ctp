<div class="add">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
	.custom-combobox {
	    position: relative;
	    display: inline-block;
	}
	.custom-combobox-toggle {
	    position: absolute;
	    top: 0;
	    bottom: 0;
	    margin-left: -1px;
	    padding: 0;
	}
	.custom-combobox-input {
	    margin: 0;
	    padding: 5px 10px;
	}
    </style>

<?php
$this->Html->addCrumb('Muestras', '/muestras');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'contratosMuestra' del contrato al javascript de la vista
$this->Js->set('contratosMuestra', $contratosMuestra);
echo $this->Js->writeBuffer(array('onDomReady' => false));
?>

<?php
echo "<h2>Añadir Muestra de ".$tipos[$this->request->data['Muestra']['tipo']]."</h2>";
//si no esta la calidad en el listado, dejamos un enlace para
//agragarla
$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
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
	 <div class="col2">
<?php
echo $this->Form->input('registro');
echo $this->Form->input('contrato_id',
    array(
	'empty' => true,
	'onchange' => 'contratosMuestra()'
    )
);
//Si no es muestra de oferta, no se introduce la calidad,
//se deduce del contrato
//if ($this->request->data['Muestra']['tipo'] != 1) {
//    echo "Calidad : <var id='calidad_contrato'></var>\n";
//    echo "<p>\n";
//}else{
echo $this->Form->input(
    'calidad_id',
    array(
	'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	'id' => 'combobox'
    )
);
//}
//Si no es muestra de oferta, no se introduce el proveedor,
//se deduce del contrato
//if ($this->request->data['Muestra']['tipo'] != 1) {
//    echo 'Proveedor : <var id="proveedor_contrato"></var>';
//    echo "<p>\n";
//}else{
echo $this->Form->input(
    'proveedor_id',
    array(
	'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	'id' => 'proveedor'
    )
);
//}
if ($this->request->data['Muestra']['tipo'] != 1) {
    echo 'Transporte : <var id="transporte_contrato"></var>';
    echo "<p>\n";
}
echo $this->Form->input(
    'aprobado',
    array(
	'label' => (
	    $this->request->data['Muestra']['tipo'] == 1 ?
	    'Comprado' : 'Aprobado'
	)
    )
);
?>
	    <div class="linea">
<?php
echo $this->Form->input('fecha', array(
    'dateFormat' => 'DMY',
    'timeFormat' => null )
);
?>
	    </div>
	</div>
<?php
echo $this->Form->input('incidencia');
echo $this->Html->link('Cancelar', $this->request->referer(''), array('class' => 'botond'));  
echo $this->Form->end('Guardar Muestra');
?>
</div>

<script type="text/javascript">
window.onload = contratosMuestra();
</script>
