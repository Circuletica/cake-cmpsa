<?php
// Usamos plantilla clásica de vistas View/Common/pdf/viewPdf.ctp
$this->extend('/Common/pdf/viewPdf');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de oferta '.$muestra['Muestra']['tipo_registro']);
$this->assign('line_object', 'Línea');
$this->assign('line_add', '1');

$this->start('main');
echo "<dl>";
echo "  <dt>Registro</dt>\n";
echo "<dd>";
echo $muestra['Muestra']['tipo_registro'].'&nbsp;';
echo "</dd>";
echo "  <dt>Comprado</dt>\n";
echo "<dd>";
echo ($muestra['Muestra']['aprobado'] ?
    'Sí ('
    .$this->Html->link(
	$muestra['Contrato']['referencia'],
	array(
	    'controller'=> 'contratos',
	    'action' => 'view',
	    $muestra['Contrato']['id']
	)
    )
    .')'
    : 'No');
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['CalidadNombre']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $muestra['Proveedor']['nombre_corto'];
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
echo $this->Html->tableHeaders(array('', 'Sacos','Ref. Proveedor'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$muestra['Muestra']['tipo_registro'].'/'.$i,
	$linea['sacos'],
	//(!empty($linea['AlmacenTransporte']))? $linea['AlmacenTransporte']['cantidad_cuenta'] : '',
	$linea['referencia_proveedor']
    )
);
//numero de la línea siguiente
$i++;
endforeach;
echo "</table>";
$this->end();
?>
