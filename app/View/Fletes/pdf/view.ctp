<?php

$this->extend('/Common/view');
$this->assign('object', 'Flete '.$referencia);
$this->assign('id',$flete['Flete']['id']);
$this->assign('class','Flete');
$this->assign('controller','fletes');
$this->assign('line_controller','precio_fletes');
$this->assign('line_object', 'precio');
$this->assign('line_add', 'si');
//$this->assign('breadcrumb', 'si');

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Fletes',
    array(
	'controller' => 'fletes',
	'action' => 'index',
    )
);
$this->end();

$this->start('filter');
//echo $this->element('filtroflete');
echo 'Filtro flete';
$this->end();
$this->start('main');
echo "<dl>";
echo "  <dt>Naviera:</dt>\n";
echo "  <dd>".$flete['Naviera']['nombre_corto']."&nbsp;</dd>";
echo "  <dt>Puerto de Carga:</dt>\n";
echo "  <dd>".$flete['PuertoCarga']['nombre']
    .' ('.$flete['PuertoCarga']['Pais']['nombre'].')'
    .'&nbsp;'."</dd>";
echo "  <dt>Puerto de Destino:</dt>\n";
echo "  <dd>".$flete['PuertoDestino']['nombre']."&nbsp;</dd>";
echo "  <dt>Tipo embalajes:</dt>\n";
echo "  <dd>".$flete['Embalaje']['nombre']."&nbsp;</dd>";
echo "  <dt>Peso contenedor:</dt>\n";
echo "  <dd>".$flete['Flete']['peso_contenedor_tm']."Tm&nbsp;</dd>";
echo "  <dt>Contrato naviera:</dt>\n";
echo "  <dd>".$flete['Flete']['contrato']."&nbsp;</dd>";
echo "</dl>";
$this->end();
$this->start('lines');
//la tabla con los costes de flete
echo "<table>";
echo $this->Html->tableHeaders(array(
    'válido desde','válido hasta','coste contenedor','coste $/Tm', ''));
foreach ($costes as $coste):
    $fecha_inicio = $this->Date->format($coste['PrecioFleteTonelada']['fecha_inicio']);
    $fecha_fin = $this->Date->format($coste['PrecioFleteTonelada']['fecha_fin']);
    echo $this->Html->tableCells(array(
	$fecha_inicio,
	$fecha_fin,
	$coste['PrecioFleteTonelada']['coste_contenedor_dolar'],
	$coste['PrecioFleteTonelada']['precio_dolar'],
	$this->Button->editLine('precio_fletes',$coste['PrecioFleteTonelada']['id'],'fletes',$coste['PrecioFleteTonelada']['flete_id'])
	.$this->Button->deleteLine('precio_fletes',$coste['PrecioFleteTonelada']['id'],'fletes',$coste['PrecioFleteTonelada']['flete_id'],'coste '.$coste['PrecioFleteTonelada']['id'])
	    )
	);
endforeach;
echo "</table>";
$this->end();
?>
