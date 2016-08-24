<?php
$this->extend('/Common/index');
$this->assign('class', 'TipoIva');
$this->assign('add_button',true);

$this->start('filter');
$this->end();

$this->start('main');
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('nombre', 'Tipo')?></th>
    <th><?php echo 'Valor a día de hoy'?></th>
    <th><?php echo 'Detalle'?></th>
  </tr>
<?php foreach($tipo_ivas as $tipo_iva):?>
  <tr>
    <td> <?php echo $tipo_iva['TipoIva']['nombre']?> </td>
    <td> <?php echo $tipo_iva['ValorTipoIva']['valor'].'%'?> </td>
    <td>
<?php
echo $this->Button->view('tipo_ivas',$tipo_iva['TipoIva']['id']);
?>
    </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
