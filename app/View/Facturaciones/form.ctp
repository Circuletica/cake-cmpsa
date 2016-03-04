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
echo "<dd>";
echo $this->html->link($proveedor, array(
    'controller' => 'proveedores',
    'action' => 'view',
    $proveedor_id)
);
echo "</dd>";
echo "  <dt>Condición</dt>\n";
echo "<dd>".$condicion.'&nbsp;'."</dd>";
echo "  <dt>Coste teórico</dt>\n";
echo "<dd>".$coste_teorico.'&nbsp;'."</dd>";
echo "  <dt>Cambio teórico</dt>\n";
echo "<dd>".$cambio_teorico.'&nbsp;'."</dd>";
echo "</dl>";

