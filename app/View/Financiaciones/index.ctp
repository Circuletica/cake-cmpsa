<?php
$this->extend('/Common/index');
$this->assign('object', 'Financiación');
$this->assign('controller', 'financiaciones');
$this->assign('class', 'Financiacion');

$this->start('filter');
$this->end();

$this->start('main');
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('Operacion.referencia','Operación')?></th>
    <th><?php echo $this->Paginator->sort('Empresa.nombre_corto','Banco')?></th>
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
    <td> <?php echo $financiacion['Empresa']['nombre_corto']?> </td>
    <td> <?php echo $fecha_vencimiento?> </td>
    <td>
<?php
	echo $this->Button->view('financiaciones',$financiacion['Financiacion']['id']);
?>
    </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
