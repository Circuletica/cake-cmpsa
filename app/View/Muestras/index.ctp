<div class="printdet">
<?php
echo $this->element('imprimirI');
?>
</div>
<h2><?php echo $title;?></h2>
<?php
if(isset($this->request->data['Search']['tipo_id'])){
	$this->Html->addCrumb($title, '/muestras/index/Search.tipo_id:'.$this->request->data['Search']['tipo_id']);
} else {
	$this->Html->addCrumb($title, '/muestras/index');
}
//$siglas_tipos = array(
//    1 => 'OF',
//    2 => 'EB',
//    3 => 'EN'
//);

?>

<div class="actions">
  <?php echo $this->element('filtromuestra');?>
</div>
<div class='index'>
  <table>
  <tr>
	<th><?php echo $this->Paginator->sort('registro', 'Registro')?></th>
	<th><?php echo $this->Paginator->sort('fecha')?></th>
	<th><?php echo $this->Paginator->sort('Calidad.nombre', 'Calidad')?></th>
	<th><?php echo $this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor')?></th>
	<th><?php echo 'Operaciones'?></th>
	<th><?php echo $this->Paginator->sort('Contrato.referencia', 'Contrato')?></th>
	<th><?php echo 'Detalle'?></th>
  </tr>
<?php foreach($muestras as $muestra):
$operaciones = '';
if (isset($muestra['Contrato']['OperacionCompra'])) {
	foreach($muestra['Contrato']['OperacionCompra'] as $operacion) {
		$operaciones .= $operacion['referencia'].' ';
	}
}
?>
  <tr>
	<td>
	  <?php echo $muestra['Muestra']['tipo_registro']?>
	</td>
	<td>
	<?php echo $this->Date->format($muestra['Muestra']['fecha']); ?>
	</td>
	<td>
	  <?php echo $muestra['Calidad']['nombre']; ?>
	</td>
	<td>
	  <?php echo $muestra['Proveedor']['nombre_corto']; ?>
	</td>
	<td>
	  <?php echo $operaciones; ?>
	</td>
	<td>
	  <?php echo $muestra['Contrato']['referencia']; ?>
	</td>
	<td>
<?php echo $this->Button->view('muestras',$muestra['Muestra']['id']);
?>
	</td>
  </tr>
  <?php endforeach;?>
  </table>

  <div class="btabla">
<?php
if(isset($this->request->data['Search']['tipo_id'])){
	echo $this->Html->link(
		'<i class="fa fa-plus"></i> Añadir Muestra',
		array(
			'action'=>'add',
			'tipo_id'=>$this->request->data['Search']['tipo_id']
		),array(
			'class'=>'botond','escape'=>false, 'title'=>'Añadir Muestra'));
} else {
	echo $this->Html->link(
		'<i class="fa fa-plus"></i> Añadir Muestra',
		array('action'=>'add'),array('class'=>'botond','escape'=>false, 'title'=>'Añadir Muestra'));
}
?>
  </div>
<?php echo $this->element('paginador');?>
</div>
