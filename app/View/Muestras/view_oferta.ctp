<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de oferta '.$muestra['Muestra']['tipo_registro']);
$this->assign('line_object', 'Línea');
$this->assign('line_add', '1');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Muestras de oferta',
    array(
	'controller' => 'muestras',
	'action' => 'index',
	'Search.tipo_id' => '1'
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
echo "  <dt>Comprado</dt>\n";
echo "<dd>";
echo ($muestra['Muestra']['aprobado'] ?
    '&#10004; (contrato: '
    .$this->Html->link(
	$muestra['Contrato']['referencia'],
	array(
	    'controller'=> 'contratos',
	    'action' => 'view',
	    $muestra['Contrato']['id']
	)
    )
    .')'
    : '&nbsp;');
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['Calidad']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->Html->link($muestra['Proveedor']['nombre_corto'], array(
    'controller' => 'proveedores',
    'action' => 'view',
    $muestra['Proveedor']['id'])
);
echo "</dd>";
echo "  <dt>Type Sample</dt>\n";
echo "<dd>";
echo ($muestra['Muestra']['si_sample'] ?
    '&#10004;'
    : '&nbsp;'
);
echo "</dd>";
echo "  <dt>Fecha</dt>\n";
echo "<dd>";
echo $this->Date->format($muestra['Muestra']['fecha']);
echo "</dd>";
echo "  <dt>Incidencia</dt>\n";
echo "<dd>";
echo nl2br(h($muestra['Muestra']['incidencia'])).'&nbsp;';
echo "</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
echo "<table>";
echo $this->Html->tableHeaders(array('Registro', 'Sacos','Ref. Proveedor', 'Detalle'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea) {
    echo $this->Html->tableCells(array(
	$muestra['Muestra']['tipo_registro'].'/'.$i,
	$linea['sacos'],
	$linea['referencia_proveedor'],
	$this->Button->view('linea_muestras',$linea['id'])
    )
);
    //numero de la línea siguiente
    $i++;
}
echo "</table>";
$this->end();
?>
