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
echo "  <dt>Precio estimado</dt>\n";
echo "  <dd>".$coste_estimado.'€/kg&nbsp;'."</dd>";
echo "  <dt>Cambio teórico</dt>\n";
echo "  <dd>".$cambio_teorico.'$/€&nbsp;'."</dd>";
echo "  <dt>Transportes</dt>\n";
echo "  <dd>";
if(isset($transportes))
foreach($transportes as $transporte) {
    echo $transporte.'&nbsp;'."<br>\n";
}
echo "  &nbsp;</dd>";
echo "  <dt>Último despacho</dt>\n";
echo "  <dd>".$this->Date->format($ultimo_despacho).'&nbsp;'."</dd>";
echo "  <dt>Bultos despachos</dt>\n";
echo "  <dd>".$bultos_despachados.'&nbsp;'."</dd>";
echo "</dl>";
echo $this->Form->create('Facturacion');
//la id de la facturacion siempre es la misma que la de operacion
echo $this->Form->hidden(
    'id',
    array(
	'value' => $operacion['Operacion']['id']
    )
);
echo "<div class='radiomuestra'>\n";
echo $this->Form->radio(
    'peso_facturacion',
    $peso_facturacion,
    array(
	'legend' => false,
	//'legend' => 'Peso factura',
	//por defecto, usar peso_retirado, 1a clave del array
	'value' => ($action == 'add')?current(array_keys($peso_facturacion)):$this->request->data['Facturacion']['peso_facturacion'],
	'separator' => '-- ',
	'onclick' => 'pesoFacturacion()'
    )
);
echo "</div>\n";
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
echo $this->Form->input(
    'precio_dolar_tm',
    array(
	'label' => 'Precio $/Tm',
	'value' => ($action == 'add')?$coste_teorico:$this->request->data['Facturacion']['precio_dolar_tm'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'cambio_dolar_euro',
    array(
	'label' => 'Cambio $/€',
	'value' => ($action == 'add')?$cambio_teorico:$this->request->data['Facturacion']['cambio_dolar_euro'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo '<div id=totalCafe>'."Total café: ???€".'</div>';
echo $this->Form->input(
    'gastos_bancarios_pagados',
    array(
	'label' => 'Gastos bancarios',
	'value' => ($action == 'add')?0:$this->request->data['Facturacion']['gastos_bancarios_pagados'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'flete_pagado',
    array(
	'label' => 'Flete',
	//'value' => 0,
	'value' => ($action == 'add')?0:$this->request->data['Facturacion']['flete_pagado'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'despacho_pagado',
    array(
	'label' => 'Despacho',
	//'value' => 0,
	'value' => ($action == 'add')?0:$this->request->data['Facturacion']['despacho_pagado'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'seguro_pagado',
    array(
	'label' => 'Seguro',
	//'value' => 0,
	'value' => ($action == 'add')?0:$this->request->data['Facturacion']['seguro_pagado'],
	'oninput' => 'pesoFacturacion()'
    )
);
echo '<div id=totalGastos>'."Total gastos: ???€".'</div>';
echo '<div id=totalOperacion>'."Precio real operacion: ???€/kg".'</div>';
echo $this->Form->input('cuenta_venta_id');
echo $this->Form->input('cuenta_iva_id');
echo $this->Form->input('cuenta_comision_id');
  echo $this->element('cancelarform');
echo $this->Form->end('Guardar facturación');
?>
<script type="text/javascript">
window.onload = pesoFacturacion();
</script>
