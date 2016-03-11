<?php
$this->extend('/Common/pdf/indexPdf');
$this->assign('class', 'TipoIva');
//$this->assign('object', 'Tipo de IVA');

$this->start('main');
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('nombre', 'Tipo')?></th>
    <th><?php echo 'Valor a día de hoy'?></th>
  </tr>
<?php foreach($tipo_ivas as $tipo_iva):?>
  <tr>
    <td> <?php echo $tipo_iva['TipoIva']['nombre']?> </td>
    <td> <?php echo $tipo_iva['ValorTipoIva']['valor'].'%'?> </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
