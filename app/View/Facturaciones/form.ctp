<?php
$this->Html->addCrumb('Operaciones','/operaciones');

if ($action == 'add') {
    echo "<h2>Añadir Facturación a Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Facturación de Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

echo "<dl>";
echo "  <dt>Operación</dt>\n";
echo "  <dd>".$referencia.'&nbsp;'."</dd>";
echo "  <dt>Calidad</dt>\n";
echo "  <dd>".$calidad.'&nbsp;'."</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "  <dd>";
echo $this->html->link($proveedor, array(
    'controller' => 'proveedores',
    'action' => 'view',
    $proveedor_id)
);
echo "  </dd>";
echo "  <dt>Condición</dt>\n";
echo "  <dd>".$condicion.'&nbsp;'."</dd>";
echo "  <dt>Coste estimado</dt>\n";
echo "  <dd>".$coste_estimado.'€/kg&nbsp;'."</dd>";
echo "  <dt>Cambio teórico</dt>\n";
echo "  <dd>".$cambio_teorico.'$/€&nbsp;'."</dd>";
echo "  <dt>Transportes</dt>\n";
echo "  <dd>";
foreach($transportes as $transporte) {
    echo $transporte.'&nbsp;'."<br>\n";
}
echo "  </dd>";
echo "  <dt>Último despacho</dt>\n";
echo "  <dd>".$this->Date->format($ultimo_despacho).'&nbsp;'."</dd>";
echo "  <dt>Bultos despachos</dt>\n";
echo "  <dd>".$bultos_despachados.'&nbsp;'."</dd>";
echo "</dl>";
echo $this->Form->create('Facturacion');
echo "<div class='linea'>\n";
echo $this->Form->input(
    'fecha_factura',
    array(
	'label' => 'Fecha de facturación',
	'dateFormat' => 'DMY',
	'minYear' => date('Y')-1,
	'maxYear' => date('Y')+5,
	'orderYear' => 'asc',
	'autofocus' => 'autofocus'
    )
);
echo "</div>\n";
if ($action == 'add') {
    echo $this->Form->input(
	'precio_dolar_tm',
	array('value' => $coste_teorico)
    );
    echo $this->Form->input(
	'cambio_dolar_euro',
	array('value' => $cambio_teorico)
    );
} else {
    echo $this->Form->input(
	'precio_dolar_tm'
    );
    echo $this->Form->input(
	'cambio_dolar_euro'
    );
}
echo $this->Form->input('flete_pagado');
echo $this->Form->input('gastos_bancarios_pagados');
echo $this->Form->input('despacho_pagado');
echo $this->Form->input('seguro_pagado');
echo $this->Form->input('cuenta_venta_id');
echo $this->Form->input('cuenta_iva_id');
echo $this->Form->end('Guardar facturación');
?>
