<?php
$this->extend('/Common/view');
$this->assign('object', $referencia);
$this->assign('line_object', 'comisión asociado');
$this->assign('id',$asociado['Empresa']['id']);
$this->assign('class','AsociadoComision');
$this->assign('controller','asociados');
$this->assign('line_controller','asociado_comisiones');

$this->start('filter');
//echo $this->element('filtroflete');
echo 'Filtro comisiones';
$this->end();
$this->start('main');
echo "<dl>";
echo "  <dt>Asociado:</dt>\n";
echo "  <dd>".$asociado['Empresa']['nombre']."&nbsp;</dd>";
echo "  <dt>Código contable:</dt>\n";
echo "  <dd>".$asociado['Empresa']['codigo_contable'].'&nbsp;'."</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
//la tabla con el historial de comisiones
echo "<table>";
echo $this->Html->tableHeaders(array(
    'válido desde','válido hasta','comisión',''));
foreach ($comisiones as $comision):
    $fecha_inicio = $this->Date->format($comision['fecha_inicio']);
    $fecha_fin = $this->Date->format($comision['fecha_fin']);
    echo $this->Html->tableCells(array(
	$fecha_inicio,
	$fecha_fin,
	$comision['Comision']['valor'],
	$this->Button->editLine('asociado_comisiones',$comision['id'],'asociado_comisiones',$comision['asociado_id'])
    ));
endforeach;
echo "</table>";
$this->end();
?>
