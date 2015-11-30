<?php
$this->extend('/Common/index');
$this->assign('object', 'Retirada');
$this->assign('controller', 'retiradas');
$this->assign('class', 'Retirada');

$this->start('filter');
$this->end();

$this->start('main');

?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('Transporte.Operacion.referencia','Ref. Operación')?></th>
    <th><?php echo $this->Paginator->sort('Empresa.nombre_corto','Socio')?></th>
    <th><?php echo $this->Paginator->sort('Empresa.nombre_corto','Almacén')?></th>
    <th><?php echo $this->Paginator->sort('Retirada.cantidad_retirada','Bultos retirados')?></th>
    <th><?php echo $this->Paginator->sort('AlmacenTransporte.cuenta_almacen','Ref. Almacén')?></th>  
    <th><?php echo 'Detalle'?></th> 
  </tr>
<?php
	foreach($retiradas as $retirada):
?>
  <tr>
	    <td> <?php echo $retirada['Transporte']['Operacion']['referencia']?> </td>
	    <td> <?php echo $retirada['Asociado']['Empresa']['nombre_corto']?> </td>
	    <td> <?php echo $retirada['Almacen']['Empresa']['nombre_corto']?> </td>
	    <td> <?php echo $retirada['Retirada']['cantidad_retirada']?> </td>
	    <td> <?php echo $retirada['AlmacenTransporte']['cuenta_almacen']?> </td>
	    <td> <?php echo $this->Button->view('retiradas',$retirada['Retirada']['id']);?></td>
  </tr>
<?php endforeach;?>
</table>
<?php
$this->end();
?>
