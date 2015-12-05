<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('id',$muestra['Muestra']['id']);
$this->assign('class','Muestra');
$this->assign('controller','muestras');
$this->assign('line_controller','linea_muestras');
$this->assign('object', 'Muestra de '.$tipo.' '.$muestra['Muestra']['referencia']);
$this->assign('line_object', 'Línea');
$this->start('filtro');
echo $this->element('filtromuestra');
$this->end();
$this->start('main');
echo "<dl>";
echo "  <dt>Referencia</dt>\n";
echo "<dd>";
echo $muestra['Muestra']['referencia'].'&nbsp;';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $muestra['CalidadNombre']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->Html->link($muestra['Proveedor']['Empresa']['nombre_corto'], array(
    'controller' => 'proveedores',
    'action' => 'view',
    $muestra['Proveedor']['id'])
);
echo "</dd>";
echo "  <dt>Operación</dt>\n";
echo "<dd>";
if (isset($muestra['Operacion']['referencia'])):
    echo $this->Html->link( $muestra['Operacion']['referencia'], array(
	'controller' => 'operaciones',
	'action' => 'view',
	$muestra['Operacion']['id']));
else:
    echo '--';
endif;

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
if ($muestra['Muestra']['tipo']==1){ //muestras de oferta
echo $this->Html->tableHeaders(array('Nº','Marca', 'Número de Sacos',
    'Ref. Proveedor', 'Ref Almacén', 'Detalle'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$i,
	$linea['AlmacenTransporte']['marca_almacen'],
	$linea['AlmacenTransporte']['cantidad_cuenta'],
	$linea['referencia_proveedor'],
	$linea['AlmacenTransporte']['marca_almacen'],
	$this->Button->viewLine('linea_muestras',$linea['id'],'muestras',$linea['muestra_id'])
    )
);
//numero de la línea siguiente
$i++;
endforeach;
} elseif ($muestra['Muestra']['tipo']==2){ //muestras de embarque
echo $this->Html->tableHeaders(array('Nº','Marca', 'Número de Sacos',
    'Ref. Proveedor', 'Ref Almacén', 'Detalle'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$i,
	$linea['AlmacenTransporte']['marca_almacen'],
	$linea['AlmacenTransporte']['cantidad_cuenta'],
	$linea['referencia_proveedor'],
	$linea['AlmacenTransporte']['marca_almacen'],
	$this->Button->viewLine('linea_muestras',$linea['id'],'muestras',$linea['muestra_id'])
    )
);
//numero de la línea siguiente
$i++;
endforeach;
} elseif ($muestra['Muestra']['tipo']==2){ //muestras de entrega
echo $this->Html->tableHeaders(array('Nº','Marca', 'Número de Sacos',
    'Ref. Proveedor', 'Ref Almacén', 'Detalle'));
//mostramos todas las catas de esta muestra
//hay que numerar las líneas
$i = 1;
foreach($muestra['LineaMuestra'] as $linea):
    echo $this->Html->tableCells(array(
	$i,
	$linea['AlmacenTransporte']['marca_almacen'],
	$linea['AlmacenTransporte']['cantidad_cuenta'],
	$linea['referencia_proveedor'],
	$linea['AlmacenTransporte']['marca_almacen'],
	$this->Button->viewLine('linea_muestras',$linea['id'],'muestras',$linea['muestra_id'])
    )
);
//numero de la línea siguiente
$i++;
endforeach;
}
echo "</table>";
$this->end();
?>

