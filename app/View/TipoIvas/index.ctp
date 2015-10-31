<?php
$this->extend('/Common/index');
$this->assign('object', 'Tipo de IVA');
$this->assign('controller', 'tipo_ivas');
$this->assign('class', 'TipoIva');

$this->start('filter');
$this->end();

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
    <td>
<?php
	//echo $this->Button->edit('tipo_ivas',$tipo_iva['TipoIva']['id'])
	//.' '.$this->Button->delete('tipo_ivas',$tipo_iva['TipoIva']['id'],$tipo_iva['TipoIva']['nombre']);
	echo $this->Button->view('tipo_ivas',$tipo_iva['TipoIva']['id']);
?>
    </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
