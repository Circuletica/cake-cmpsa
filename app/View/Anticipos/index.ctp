<?php
$this->extend('/Common/index');
$this->assign('class', 'Anticipo');
$this->assign('add_button', 1);

$this->start('filter');
$this->end();

$this->start('main');
echo "<table>\n";
echo $this->Html->tableHeaders(array(
    $this->Paginator->sort('Anticipo.fecha_conta','Fecha'),
    $this->Paginator->sort('Operacion.referencia','Operación'),
    $this->Paginator->sort('Asociado.nombre_corto','Asociado'),
    $this->Paginator->sort('Banco.nombre_corto','Banco'),
    $this->Paginator->sort('Anticipo.importe','Importe'),
    'Detalle'
));
foreach($anticipos as $anticipo) {
    echo $this->Html->tableCells(array(
	$this->Date->format($anticipo['Anticipo']['fecha_conta']),
	$anticipo['Operacion']['referencia'],
	$anticipo['Asociado']['nombre_corto'],
	$anticipo['Banco']['nombre_corto'],
	$anticipo['Anticipo']['importe'],
	$this->Button->view('anticipos',$anticipo['Anticipo']['id'])
    ));
}
echo "</table>\n";
$this->end();
?>
