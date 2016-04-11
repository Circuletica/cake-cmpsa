<?php
$this->extend('/Common/index');
$this->assign('object', 'Retiradas');
$this->assign('controller', 'retiradas');
$this->assign('class', 'Retirada');

$this->start('filter');
$this->end();

$this->start('main');
if (empty($retiradas)){
    echo "No hay retiradas en esta lista";
}else{
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('Retirada.fecha_retirada','Fecha retirada')?></th>
    <th><?php echo $this->Paginator->sort('Operacion.referencia','Ref.Operación')?></th>
    <th><?php echo $this->Paginator->sort('AlmacenTransporte.cuenta_almacen','Cuenta Almacén')?></th>
    <th><?php echo $this->Paginator->sort('Almacen.nombre_corto','Almacén')?></th>
    <th><?php echo $this->Paginator->sort('Asociado.nombre_corto','Asociado')?></th>  
    <th><?php echo $this->Paginator->sort('Retirada.embalaje_retirado','Bultos retirados')?></th>
    <th><?php echo $this->Paginator->sort('Retirada.peso_retirado','Peso retirado (Kg)  ')?></th>
    <th><?php echo 'Detalle'?></th> 
  </tr>
<?php

	foreach($retiradas as $retirada):
?>
  <tr>
	    <td> <?php echo $this->Date->format($retirada['Retirada']['fecha_retirada'])?> </td>
      <td> <?php echo $retirada['Operacion']['referencia']?> </td>
      <td> <?php echo $retirada['AlmacenTransporte']['cuenta_almacen']?> </td>
      <td> <?php echo $retirada['Almacen']['nombre_corto']?> </td>
	    <td> <?php echo $retirada['Asociado']['nombre_corto']?> </td>
      <td> <?php echo $retirada['Retirada']['embalaje_retirado']?> </td>
      <td> <?php echo $retirada['Retirada']['peso_retirado']?> </td>    
	    <td> <?php echo $this->Button->viewCrossed('asociado','retiradas','asociado_id', $retirada['Retirada']['asociado_id'],'operaciones',$retirada['Retirada']['operacion_id']);?></td>
  </tr>
<?php endforeach;?>
</table>
<?php
}
$this->end();
?>
