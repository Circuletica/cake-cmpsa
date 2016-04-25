<?php;
// Usamos plantilla clásica de vistas View/Common/pdf/viewPdf.ctp
$this->extend('/Common/pdf/viewPdf');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de entrega '.$muestra['Muestra']['tipo_registro']);
$this->assign('line_object', 'Línea');
$this->assign('line_add', '1');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Muestras de entrega',
    array(
	'controller' => 'muestras',
	'action' => 'index',
	'Search.tipo_id' => '3'
    )
);
$this->end();

$this->start('filtro');
echo $this->element('filtromuestra');
$this->end();
$this->start('main');
echo "<dl>";
echo "  <dt>Registro</dt>\n";
echo "<dd>";
echo $muestra['Muestra']['tipo_registro'].'&nbsp';
echo "</dd>";
echo "  <dt>Contrato</dt>\n";
echo "<dd>";
if (isset($muestra['Contrato']['referencia'])) {
    echo $muestra['Contrato']['referencia'].'&nbsp';
}else{
    echo '--&nbsp;';
}
echo "</dd>";
echo "  <dt>Transporte</dt>\n";
echo "<dd>";
echo $muestra['Contrato']['transporte'].'&nbsp;';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['Calidad']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $muestra['Proveedor']['nombre_corto'];
echo "</dd>";
echo "  <dt>Fecha</dt>\n";
echo "<dd>";
echo $this->Date->format($muestra['Muestra']['fecha']);
echo "</dd>";
echo "  <dt>Muestra embarque</dt>\n";
echo "<dd>";
echo (isset($muestra['MuestraEmbarque']['tipo_registro']) ?
    $muestra['MuestraEmbarque']['tipo_registro'] : '--')
    .'&nbsp;';
echo "</dd>";
echo "  <dt>Incidencia</dt>\n";
echo "<dd>";
echo nl2br(h($muestra['Muestra']['incidencia'])).'&nbsp;';
echo "</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
echo "<table>";
echo $this->Html->tableHeaders(array('Registro','Marca', 'Cuenta almacén', 'Sacos', 'Operación'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$muestra['Muestra']['tipo_registro'].'/'.$i,
	(isset($linea['AlmacenTransporte']['marca_almacen']) ?
		$linea['AlmacenTransporte']['marca_almacen'] : ''
	),
	(isset($linea['AlmacenTransporte']['cuenta_almacen']) ?
		$linea['AlmacenTransporte']['cuenta_almacen'] : ''
	),
	(isset($linea['AlmacenTransporte']['cantidad_cuenta']) ?
		$linea['AlmacenTransporte']['cantidad_cuenta'] : ''
	),
	(isset($linea['Operacion']['referencia']) ?
		$linea['Operacion']['referencia'] : ''
	),
    )
);
//numero de la línea siguiente
$i++;
endforeach;
echo "</table>";
$this->end();
?>
