<?php
$this->extend('/Common/index');
$this->assign('object', 'Financiación');
$this->assign('class', 'Financiacion');

$this->start('filter');
$this->end();

$this->start('main');
echo "<table>\n";
echo $this->Html->tableHeaders(array(
	$this->Paginator->sort('Operacion.referencia','Operación'),
	$this->Paginator->sort('Banco.nombre_corto','Banco'),
	$this->Paginator->sort('Financiacion.fecha_vencimiento','F. Vencimiento'),
	'Detalle'
));
foreach($financiaciones as $financiacion) {
	//mysql almacena la fecha en formato ymd
	$fecha = $financiacion['Financiacion']['fecha_vencimiento'];
	//sacamos el nombre del mes en castellano
	setlocale(LC_TIME, "es_ES.UTF-8");
	$mes = strftime("%B", strtotime($fecha));
	$anyo = substr($fecha,0,4);
	$fecha_vencimiento = $mes.' '.$anyo;
	echo $this->Html->tableCells(array(
		$financiacion['Operacion']['referencia'],
		$financiacion['Banco']['nombre_corto'],
		$fecha_vencimiento,
		$this->Button->view('financiaciones',$financiacion['Financiacion']['id'])
	));
}
echo "</table>\n";
$this->end();
?>
