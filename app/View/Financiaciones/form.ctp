<?php
$this->Html->addCrumb('Operaciones','/operaciones');

if ($action == 'add') {
    echo "<h2>Añadir Financiación a Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Financiación de Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

echo "<dl>";
echo "  <dt>Operación</dt>\n";
echo "  <dd>".$referencia.'&nbsp;'."</dd>";
echo "  <dt>Calidad</dt>\n";
echo "  <dd>".$calidad.'&nbsp;'."</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->html->link($proveedor, array(
    'controller' => 'proveedores',
    'action' => 'view',
    $proveedor_id)
);
echo "</dd>";
echo "  <dt>Condición</dt>\n";
echo "<dd>".$condicion.'&nbsp;'."</dd>";
echo "</dl>";
echo $this->Form->create('Financiacion');
echo $this->Form->hidden(
    'id',
    array(
	'value' => $operacion['Operacion']['id']
    )
);
echo "<div class='linea'>\n";
echo $this->Form->input(
    'fecha_vencimiento',
    array(
	'label' => 'Fecha de vencimiento',
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+5,
	'orderYear' => 'asc',
	'autofocus' => 'autofocus'
    )
);
echo "</div>\n";
//solo si es una financiacion nueva, asignamos valores por defecto
//si es un edit, hay que respetar los valores existentes
if ($action == 'add') {
    echo $this->Form->input('banco_id', array( 'value' => 3));
    echo $this->Form->input('tipo_iva_id', array( 'value' => 3));
    echo $this->Form->input('tipo_iva_comision_id', array( 'value' => 4));
    echo $this->Form->input('precio_euro_kilo', array('value' => $precio_euro_kilo));
} else {
    echo $this->Form->input('banco_id');
    echo $this->Form->input('tipo_iva_id');
    echo $this->Form->input('tipo_iva_comision_id');
    echo $this->Form->input('precio_euro_kilo');
}
  echo $this->element('cancelarform');
echo $this->Form->end('Guardar Financiación');
