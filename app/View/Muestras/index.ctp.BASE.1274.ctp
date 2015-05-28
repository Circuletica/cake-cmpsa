<h2>Listado de muestras</h2>
<?php 
	$this->Html->addCrumb('Muestras', '/muestras');
	echo "<div class='actions'>\n";
	echo $this->Html->link('Añadir Muestra',array('action'=>'add'));
	echo "\n";
	echo "</div>\n";
	echo "<div class='index'>\n";
?>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('id')?></th>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha')?></th>
    <th><?php echo $this->Paginator->sort('Calidad.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('aprobado')?></th>
  </tr>
<?php foreach($muestras as $muestra):?>
  <tr>
    <td>
      <?php echo $muestra['Muestra']['id']?>
    </td>
    <td>
      <?php echo $muestra['Muestra']['referencia']?>
    </td>
    <td>
      <?php
	//no queremos la hora
	//mysql almacena la fecha en formato YMD
	$fecha = $muestra['Muestra']['fecha'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	echo $dia.'-'.$mes.'-'.$anyo;
     ?>
    </td>
    <td>
      <?php 
	//concatenamos la calidad de la muestra
      echo $muestra['Calidad']['descafeinado'] ? 'Descafeinado ' : ''
      	.$muestra['Calidad']['Pais']['nombre'].
      	' '.$muestra['Calidad']['descripcion'];
	?>
    </td>
    <td>
      <?php //if ($muestra['Muestra']['aprobado'] == true) {
	//      echo 'aprobado';}
	//	      else {
	//		      echo 'rechazado';}
		echo $muestra['Muestra']['aprobado'] ? 'Aprobado' : 'Rechazado';
	?>
    </td>
    <td>
	<?php echo 
		$this->Html->link('Detalles',array('action'=>'view',$muestra['Muestra']['id'])).' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$muestra['Muestra']['id']))
		$this->Form->postLink('Borrar',array('action'=>'delete',$muestra['Muestra']['id']),array('confirm'=>'Realmente quiere borrar '.$muestra['Muestra']['referencia'].'?'))
	?>
    </td>
  </tr>
<?php endforeach;?>
</table>
<p>
<?php echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
);?>
</p>
<div class="paging">
	<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
	<?php echo $this->Paginator->numbers(array('separator' => ''));?>
	<?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
</div>