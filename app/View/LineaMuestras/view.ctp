<?php
// Usamos plantilla clásica de vistas View/Common/view.ctp
$this->extend('/Common/view');
$this->assign('object', 'Línea de la muestra '.$linea['Muestra']['tipo_registro']);
$this->assign('id',$linea['LineaMuestra']['id']);
$this->assign('class','LineaMuestra');
$this->assign('controller','linea_muestras');
//$this->assign('from_controller','muestras'); Se comenta porque da error a la hora de ver los botones de borrar.
$this->assign('from_id',$linea['Muestra']['id']);

$this->Html->addCrumb('Muestras de '.$linea['Muestra']['tipo_nombre'], array(
    'controller'=>'muestras',
    'action'=>'index',
    'Search.tipo_id' => $linea['Muestra']['tipo_id']
));
$this->Html->addCrumb('Muestra '.$linea['Muestra']['tipo_registro'], array(
    'controller'=>'muestras',
    'action'=>'view',
    $linea['Muestra']['id']
));


$this->start('filter');
echo $this->element('filtromuestra');
echo '<br>';
echo $this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i> Previsualizar informe'),
    array(
        'action' => 'info_calidad',
        $id,
        'ext' => 'pdf',
        ), 
    array(
        'escape'=>false,'target' => '_blank','title'=>'Informe calidad previo'));

echo  $this->Html->link('<i class="fa fa-envelope fa-lg aria-hidden="true"></i> Envío informe',
   array(
    //'from_controller' => 'linea_muestras',
    'action' =>'info_envio',
    'from_id'=>$linea['LineaMuestra']['id']
   ),
   array(
   'escape'=>false,
   'title'=>'Envío informe de calidad',
   )
 );
$this->end();

$this->start('main');
echo "<dl>\n";
if ($linea['Muestra']['tipo_id'] != 1) {
    echo "  <dt>Operación</dt><dd>".$linea['Operacion']['referencia']."&nbsp;</dd>\n";
    echo "  <dt>Cuenta Almacen</dt><dd>".$linea['AlmacenTransporte']['cuenta_almacen']."&nbsp;</dd>\n";
    echo "  <dt>Marca</dt><dd>".$linea['AlmacenTransporte']['marca_almacen']."&nbsp;</dd>\n";
}
echo "  <dt>Ref. Proveedor</dt><dd>".$linea['LineaMuestra']['referencia_proveedor']."&nbsp;</dd>\n";
echo "  <dt>Sacos</dt><dd>".$linea['LineaMuestra']['sacos'].
    " ".(isset($linea['Operacion']['Embalaje'])?
    $linea['Operacion']['Embalaje']['nombre']:'')."&nbsp;</dd>\n";
if ($linea['Muestra']['tipo_id'] == 3) {
    echo "  <dt>Facturado</dt><dd>".
	($linea['LineaMuestra']['si_facturado'] ? '&#10004; ('.$linea['LineaMuestra']['dato_factura'].')' :'&nbsp;')
	."</dd>\n";
}
echo "  <dt>Humedad</dt><dd>".$linea['LineaMuestra']['humedad']."&nbsp;</dd>\n";
echo "  <dt>Defectos</dt><dd>".nl2br(h($linea['LineaMuestra']['defecto']))."&nbsp;</dd>\n";
echo "  <dt>Tueste</dt><dd>".$linea['LineaMuestra']['tueste']."&nbsp;</dd>\n";
echo "  <dt>Bebida</dt><dd>".nl2br(h($linea['LineaMuestra']['apreciacion_bebida']))."&nbsp;</dd>\n";
echo "  <dt>Observaciones</dt><dd>".nl2br(h($linea['LineaMuestra']['observaciones']))."&nbsp;</dd>\n";
//Tabla de criba medida y ponderada (con los caracoles)
//Antes de todo, necesitamos saber que criba corresponde al fondo.
for ($i=12; (!$linea['LineaMuestra']['criba'.$i] || $linea['LineaMuestra']['criba'.$i] == 0) && $i <= 19; $i++){
    $fondo = $i;
}
$fondo++;
$this->end();

$this->start('lines');
echo "<table style=width:45%;margin-left:25%>\n";
echo $this->Html->tableHeaders(array('Criba', 'Medida original', 'Medida ponderada'));
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba20'] || $linea['CribaPonderada']['criba20']) {
    echo $this->Html->tableCells(array(
	$fondo == 20 ? 'Fondo' : 'Criba 20',
	+$linea['LineaMuestra']['criba20'],
	+$linea['CribaPonderada']['criba20']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba19'] || $linea['CribaPonderada']['criba19']) {
    echo $this->Html->tableCells(array(
	$fondo == 19 ? 'Fondo' : 'Criba 19',
	+$linea['LineaMuestra']['criba19'],
	+$linea['CribaPonderada']['criba19']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba13p'] && $linea['LineaMuestra']['criba13p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 13', +$linea['LineaMuestra']['criba13p'], '&nbsp;'));
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba18'] && $linea['LineaMuestra']['criba18'] != 0) || ($linea['CribaPonderada']['criba18'] && $linea['CribaPonderada']['criba18'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 18 ? 'Fondo' : 'Criba 18',
	+$linea['LineaMuestra']['criba18'],
	+$linea['CribaPonderada']['criba18']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba12p'] && $linea['LineaMuestra']['criba12p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 12', +$linea['LineaMuestra']['criba12p'], '&nbsp;'));
}
if (($linea['LineaMuestra']['criba17'] && $linea['LineaMuestra']['criba17'] != 0) || ($linea['CribaPonderada']['criba17'] && $linea['CribaPonderada']['criba17'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 17 ? 'Fondo' : 'Criba 17',
	+$linea['LineaMuestra']['criba17'],
	+$linea['CribaPonderada']['criba17'])
    );
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba11p'] && $linea['LineaMuestra']['criba11p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 11', +$linea['LineaMuestra']['criba11p'], '&nbsp;'));
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba16'] && $linea['LineaMuestra']['criba16'] != 0) || ($linea['CribaPonderada']['criba16'] && $linea['CribaPonderada']['criba16'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 16 ? 'Fondo' : 'Criba 16',
	+$linea['LineaMuestra']['criba16'],
	+$linea['CribaPonderada']['criba16']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba10p'] && $linea['LineaMuestra']['criba10p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 10', +$linea['LineaMuestra']['criba10p'], '&nbsp;'));
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba15'] && $linea['LineaMuestra']['criba15'] != 0) || ($linea['CribaPonderada']['criba15'] && $linea['CribaPonderada']['criba15'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 15 ? 'Fondo' : 'Criba 15',
	+$linea['LineaMuestra']['criba15'],
	+$linea['CribaPonderada']['criba15']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba9p'] && $linea['LineaMuestra']['criba9p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 9', +$linea['LineaMuestra']['criba9p'], '&nbsp;'));
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba14'] && $linea['LineaMuestra']['criba14'] != 0) || ($linea['CribaPonderada']['criba14'] && $linea['CribaPonderada']['criba14'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 14 ? 'Fondo' : 'Criba 14',
	+$linea['LineaMuestra']['criba14'],
	+$linea['CribaPonderada']['criba14']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba8p'] && $linea['LineaMuestra']['criba8p'] != 0) {
    echo $this->Html->tableCells(array('Caracol 8', +$linea['LineaMuestra']['criba8p'], '&nbsp;'));
}
//Mostrar la línea si la criba original o la criba ponderada no es NULL o 0
if (($linea['LineaMuestra']['criba13'] && $linea['LineaMuestra']['criba13'] != 0) || ($linea['CribaPonderada']['criba13'] && $linea['CribaPonderada']['criba13'] != 0)) {
    echo $this->Html->tableCells(array(
	$fondo == 13 ? 'Fondo' : 'Criba 13',
	+$linea['LineaMuestra']['criba13'],
	+$linea['CribaPonderada']['criba13']));
}
//solo mostramos la línea si tiene algún valor
if ($linea['LineaMuestra']['criba12'] || $linea['CribaPonderada']['criba12']) {
    echo $this->Html->tableCells(array(
	$fondo == 12 ? 'Fondo' : 'Criba 12',
	+$linea['LineaMuestra']['criba12'],
	+$linea['CribaPonderada']['criba12']));
}
echo $this->Html->tableCells(array(
    array(
    array(
        'TOTAL',
        array(
        'style' => 'font-weight:bold;text-align:center'
        )
        ),
        array(
            $suma_linea."%",array(
                'class' => 'total'
                )
            ),
        array(
            $suma_ponderada."%",array(
                'class' => 'total'
                )
            )
        )
        )
);
echo $this->Html->tableCells(array(
    array(
        array(
            'CRIBA MEDIA',
            array(
                'style' => 'font-weight: bold; text-align:center'
                )
            ),
        $linea['CribaPonderada']['criba_media']
        )
    )
);
echo "</table>\n";
$this->end()
?>
