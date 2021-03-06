<?php
// Usamos plantilla clásica de vistas View/Common/pdf/viewPdf.ctp
$this->extend('/Common/pdf/viewPdf');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de embarque '.$muestra['Muestra']['tipo_registro']);
$this->assign('line_object', 'Línea');
$this->assign('line_add', '1');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Muestras de embarque',
    array(
	'controller' => 'muestras',
	'action' => 'index',
	'Search.tipo_id' => '2'
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
echo $muestra['Muestra']['tipo_registro'].'&nbsp;';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['Calidad']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $muestra['Proveedor']['nombre_corto'];
echo "</dd>";
echo "  <dt>Contrato</dt>\n";
echo "<dd>";
if (isset($muestra['Contrato'])) {
    echo $muestra['Contrato']['referencia'];
}else{
    echo '--';
}
echo "</dd>";
echo "  <dt>Fecha</dt>\n";
echo "<dd>";
echo $this->Date->format($muestra['Muestra']['fecha']);
echo "</dd>";
echo "  <dt>Resultado</dt>\n";
echo "<dd>";
echo $muestra['Muestra']['aprobado'] ? 'Aprobado' : 'Rechazado'.'&nbsp;';
echo "</dd>";
echo "  <dt>Incidencia</dt>\n";
echo "<dd>";
echo nl2br(h($muestra['Muestra']['incidencia'])).'&nbsp;';
echo "</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
echo "<table>";
echo $this->Html->tableHeaders(array('Registro', 'Operación', 'Sacos'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$muestra['Muestra']['tipo_registro'].'/'.$i,
	'ref. operacion',
	'cantidad_sacos'
    )
);
//numero de la línea siguiente
$i++;
endforeach;
echo "</table>";
$this->end();
?>
