<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de entrega '.$muestra['Muestra']['referencia']);
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
echo $muestra['Muestra']['registro'].'&nbsp;';
echo "</dd>";
echo "  <dt>Contrato</dt>\n";
echo "<dd>";
if (isset($muestra['Contrato']['referencia'])) {
    echo $this->Html->link( $muestra['Contrato']['referencia'], array(
	'controller' => 'contratos',
	'action' => 'view',
	$muestra['Contrato']['id']));
}else{
    echo '--';
}
echo "</dd>";
echo "  <dt>Transporte</dt>\n";
echo "<dd>";
echo 'emb/entr + fecha'.'&nbsp;';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['CalidadNombre']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->Html->link($muestra['Proveedor']['nombre_corto'], array(
    'controller' => 'proveedores',
    'action' => 'view',
    $muestra['Proveedor']['id'])
);
echo "</dd>";
echo "  <dt>Fecha</dt>\n";
echo "<dd>";
echo $this->Date->format($muestra['Muestra']['fecha']);
echo "</dd>";
//echo "  <dt>Resultado</dt>\n";
//echo "<dd>";
//echo $muestra['Muestra']['aprobado'] ? 'Aprobado' : 'Rechazado'.'&nbsp;';
//echo "</dd>";
echo "  <dt>Muestra embarque</dt>\n";
echo "<dd>";
echo (isset($muestra['MuestraEmbarque']['registro']) ?
    $muestra['MuestraEmbarque']['registro'] : '--')
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
echo $this->Html->tableHeaders(array('Nº','Marca', 'Cuenta almacén', 'Número de Sacos', 'ref. operación', 'Detalle'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$i,
	$linea['AlmacenTransporte']['marca_almacen'],
	$linea['AlmacenTransporte']['cantidad_cuenta'],
	$linea['referencia_proveedor'],
	$this->Button->viewLine('linea_muestras',$linea['id'],'muestras',$linea['muestra_id'])
    )
);
//numero de la línea siguiente
$i++;
endforeach;
echo "</table>";
$this->end();
?>
