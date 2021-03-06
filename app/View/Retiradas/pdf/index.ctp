<?php
$this->extend('/Common/pdf/indexPdf');
$this->assign('object', 'Retiradas');
$this->assign('controller', 'retiradas');
$this->assign('class', 'Retirada');
$this->start('main');
if (empty($retiradas)){
    echo "No hay retiradas en esta lista";
}else{
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('Retirada.fecha_retirada','Fecha retirada')?></th>
    <th><?php echo $this->Paginator->sort('Operacion.referecia','Ref.Operación')?></th>
    <th><?php echo $this->Paginator->sort('AlmacenTransporte.cuenta_almacen','Cuenta Almacén')?></th>
    <th><?php echo $this->Paginator->sort('AlmacenTransporte.Almacen.nombre_corto','Almacén')?></th>
    <th><?php echo $this->Paginator->sort('Asociado.nombre_corto','Asociado')?></th>
    <th><?php echo $this->Paginator->sort('Retirada.embalaje_retirado','Bultos retirados')?></th>
    <th><?php echo $this->Paginator->sort('Retirada.peso_retirado','Peso retirado (Kg)  ')?></th>
  </tr>
<?php

	foreach($retiradas as $retirada):
?>
  <tr>
	    <td> <?php echo $this->Date->format($retirada['Retirada']['fecha_retirada'])?> </td>
      <td> <?php echo $retirada['Operacion']['referencia']?> </td>
      <td> <?php echo $retirada['AlmacenTransporte']['cuenta_almacen']?> </td>
      <td> <?php echo $retirada['AlmacenTransporte']['Almacen']['nombre_corto']?> </td>
	    <td> <?php echo $retirada['Asociado']['nombre_corto']?> </td>
      <td> <?php echo $retirada['Retirada']['embalaje_retirado']?> </td>
      <td> <?php echo $retirada['Retirada']['peso_retirado']?> </td>
  </tr>
<?php endforeach;?>
</table>
<?php
}
$this->end();
?>
