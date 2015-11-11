<?php
$this->extend('/Common/view');
$this->assign('object', 'Operación '.$referencia);
$this->assign('line_object', 'Reparto asociados');
$this->assign('id',$operacion['Operacion']['id']);
$this->assign('class','Operacion');
$this->assign('controller','operaciones');
$this->assign('line_controller','asociado_operaciones');
$this->start('filter');
//echo $this->element('filtrooperacion');
echo $this->Html->link('Generar financiación', array(
    'controller' => 'operaciones',
    'action' => 'generarFinanciacion',
    $operacion['Operacion']['id']
    )
); 
$this->end();
$this->start('main');
echo "<dl>";
echo "  <dt>Referencia Contrato:</dt>\n";
echo "<dd>";
echo $this->html->link($operacion['Contrato']['referencia'], array(
    'controller' => 'contratos',
    'action' => 'view',
    $operacion['Contrato']['id'])
);
echo "  </dd>";
echo "  <dt>Proveedor:</dt>\n";
echo "<dd>";
echo $this->html->link($operacion['Contrato']['Proveedor']['Empresa']['nombre_corto'], array(
    'controller' => 'proveedores',
    'action' => 'view',
    $operacion['Contrato']['Proveedor']['id'])
);
echo "  </dd>";
echo "  <dt>Peso:</dt>\n";
echo "  <dd>".$operacion['PesoOperacion']['peso'].'kg&nbsp;'."</dd>";
echo "  <dt>Embalaje:</dt>\n";
echo "  <dd>".
    $operacion['PesoOperacion']['cantidad_embalaje'].' x '.
    $embalaje['Embalaje']['nombre'].
    ' ('.$operacion['PesoOperacion']['peso'].'kg)&nbsp;'."</dd>";
echo "  <dt>Lotes:</dt>\n";
echo "  <dd>".$operacion['Operacion']['lotes_operacion'].'&nbsp;'."</dd>";
echo "  <dt>Puerto de Embarque:</dt>\n";
echo "  <dd>".$operacion['PuertoCarga']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Puerto de Destino:</dt>\n";
echo "  <dd>".$operacion['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
//mysql almacena la fecha en formato ymd
echo "  <dt>Fecha fijación:</dt>\n";
echo "  <dd>".$this->Date->format($fecha_fijacion).'&nbsp;'."</dd>";
echo "  <dt>Precio fijación:</dt>\n";
echo "  <dd>".$operacion['Operacion']['precio_fijacion']
    .$divisa
    .'&nbsp;'."</dd>";
echo "  <dt>Diferencial:</dt>\n";
echo "  <dd>".$operacion['Contrato']['diferencial'].$divisa.'&nbsp;'."</dd>";
if ($operacion['Operacion']['opciones'] != 0){
    echo "  <dt>Opciones:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['opciones'].$divisa.'&nbsp;'."</dd>";
}
echo "  <dt>Precio $/Tm:</dt>\n";
echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_dolar_tonelada'].'$/Tm&nbsp;'."</dd>";
if ($operacion['Contrato']['Incoterm']['si_flete']) {
    echo "  <dt>Flete:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['flete'].'$/Tm&nbsp;'."</dd>";
}
echo "  <dt>Cambio dolar/euro:</dt>\n";
echo "  <dd>".$operacion['Operacion']['cambio_dolar_euro'].'&nbsp;'."</dd>";
echo "  <dt>Precio €/Tm:</dt>\n";
echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_tonelada'].'€/Tm&nbsp;'."</dd>";
if ($operacion['Contrato']['Incoterm']['si_seguro']) {
    echo "  <dt>Seguro:</dt>\n";
    echo "  <dd>".$operacion['Operacion']['seguro'].'%'
	.' ('.$operacion['PrecioTotalOperacion']['seguro_euro_tonelada'].'€/Tm)'
	.'&nbsp;'."</dd>";
}
echo "  <dt>Forfait:</dt>\n";
echo "  <dd>".$operacion['Operacion']['forfait'].'€/Tm&nbsp;'."</dd>";
echo "  <dt>Precio €/kg estimado:</dt>\n";
echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_euro_kilo_total'].'€/kg&nbsp;'."</dd>";
echo "  <dt>Observaciones:</dt>\n";
echo "  <dd>".$operacion['Operacion']['observaciones'].'&nbsp;'."</dd>";
echo "</dl>";
$this->end();
$this->start('lines');
//la tabla con el reparto de sacos para los asociados
echo "<table>\n";
echo $this->Html->tableHeaders($columnas_reparto);
foreach ($lineas_reparto as $codigo => $linea_reparto):
    echo $this->Html->tableCells(array(
	$codigo,
	$linea_reparto['Nombre'],
	$linea_reparto['Cantidad'],
	$linea_reparto['Peso'],
    )
);
endforeach;
echo "</table>\n";
$this->end();
?>
		</div>
</div>