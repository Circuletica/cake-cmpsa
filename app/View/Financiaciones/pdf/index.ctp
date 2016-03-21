<?php
$this->extend('/Common/pdf/indexPdf');
$this->assign('object', 'Financiación');
$this->assign('class', 'Financiacion');


$this->start('main');
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('Operacion.referencia','Operación')?></th>
    <th><?php echo $this->Paginator->sort('Banco.nombre_corto','Banco')?></th>
    <th><?php echo $this->Paginator->sort('Financiacion.fecha_vencimiento','F. Vencimiento')?></th>
  </tr>
<?php
foreach($financiaciones as $financiacion):
    //mysql almacena la fecha en formato ymd
    $fecha = $financiacion['Financiacion']['fecha_vencimiento'];
//sacamos el nombre del mes en castellano
setlocale(LC_TIME, "es_ES.UTF-8");
$mes = strftime("%B", strtotime($fecha));
$anyo = substr($fecha,0,4);
$fecha_vencimiento = $mes.' '.$anyo;
?>
  <tr>
    <td> <?php echo $financiacion['Operacion']['referencia']?> </td>
    <td> <?php echo $financiacion['Banco']['nombre_corto']?> </td>
    <td> <?php echo $fecha_vencimiento?> </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
