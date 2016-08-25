<?php
$this->Html->addCrumb('Operaciones','/operaciones');

if ($action == 'add') {
    echo "<h2>Añadir Facturación a Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar Facturación de Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}
echo $this->Form->create('Facturacion');
echo "<fieldset>";
echo "<legend>Info</legend>";
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
echo "</fieldset>";
echo "<fieldset>";
echo "<legend>Datos</legend>";
//la id de la facturacion siempre es la misma que la de operacion
echo $this->Form->hidden(
    'id',
    array(
        'value' => $operacion['Operacion']['id']
    )
);
if ($peso_facturacion != null) {
    echo "<div class='radiomuestra'>\n";
    echo $this->Form->radio(
        'peso_facturacion',
        $peso_facturacion,
        array(
            'legend' => false,
            //por defecto, usar peso_retirado, 1a clave del array
            'value' => ($action == 'add')?current(array_keys($peso_facturacion)):$this->request->data['Facturacion']['peso_facturacion'],
            'separator' => '-- ',
            'onclick' => 'pesoFacturacion()'
        )
    );
    echo "</div>\n";
} else {
    echo "<em>No hay ningun peso definido, el cálculo de precio puede ser erróneo</em>\n";
}
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
        'value' =>
        ($action == 'add')?
        0
        :$this->request->data['Facturacion']['gastos_bancarios_pagados'],
        'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'flete_pagado',
    array(
        'label' => 'Flete',
        'value' => ($action == 'add')?0:$this->request->data['Facturacion']['flete_pagado'],
        'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'despacho_pagado',
    array(
        'label' => 'Despacho',
        'value' => ($action == 'add')?0:$this->request->data['Facturacion']['despacho_pagado'],
        'oninput' => 'pesoFacturacion()'
    )
);
echo $this->Form->input(
    'seguro_pagado',
    array(
        'label' => 'Seguro',
        'value' => ($action == 'add')?0:$this->request->data['Facturacion']['seguro_pagado'],
        'oninput' => 'pesoFacturacion()'
    )
);
echo "</fieldset>";
echo "<fieldset>";
echo '<div id=totalGastos>'."Total gastos: ???€".'</div>';
echo '<div id=totalOperacion>'."Precio real operacion: ???€/kg".'</div>';
echo $this->Form->input('cuenta_venta_id');
echo $this->Form->input('cuenta_iva_venta_id');
echo $this->Form->input(
    'cuenta_comision_id',
    array(
        'options' => $cuentaVentas
    )
);
echo $this->Form->input(
    'cuenta_iva_comision_id',
    array(
        'options' => $cuentaIvaVentas
    )
);
echo $this->element('cancelarform');
echo $this->Form->end('Guardar facturación');
?>
</fieldset>
<script type="text/javascript">
window.onload = pesoFacturacion();
</script>
