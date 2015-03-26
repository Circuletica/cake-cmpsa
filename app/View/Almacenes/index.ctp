<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Almacenes', array(
		'controller' => 'almacenes',
		'action' => 'index')
	); ?>
<h2>Almacenes</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
		?>
	</div>
	<div class='index'>
	<?php
	if (empty($empresas)):
		echo "No hay almacenes en esta lista";
	else:
	//echo "<pre>";
	//print_r($bancopruebas);
	////print_r($bancopruebas['Empresa']['nombre']);
	//echo "</pre>";

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		'Id',
		$this->Paginator->sort('Empresa.nombre','Almacén'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		''));

	foreach($empresas as $empresa):
	echo $this->Html->tableCells(array(
		$empresa['Almacen']['id'],
		$empresa['Empresa']['nombre'],
		$empresa['Empresa']['codigo_contable'],
		//substr($empresa['Empresa']['cuenta_bancaria'],4,4),
		$empresa['Empresa']['Pais']['nombre'],
		$empresa['Empresa']['telefono'],
		$this->Html->link('Detalles',array('action'=>'view',$empresa['Almacen']['id']))//.' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		//$this->Form->postLink('Borrar',array('action'=>'delete',$empresa['Empresa']['id']),array('confirm'=>'Realmente quiere borrar '.$empresa['Empresa']['nombre'].'?'))
	));

	endforeach;?>
	</table>
	<div class="btabla">
		<?php echo $this->Html->link('Añadir Almacén',array('action'=>'add')); ?>
	</div>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>

	<div class="paging">
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled')); ?>
	</div>
</div>
<?php endif; ?>

