<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Almacenes', array(
		'controller' => 'almacenes',
		'action' => 'index')
	); ?>
	<div class="printdet">
<ul><li>
	<?php 
	echo $this->element('imprimirI');
	?>
	</li>
	<li>
	<?php
	echo $this->element('desplegabledatos');
	?>
	</li>
</ul>
</div>
<h2>Almacenes</h2>
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
		$this->Paginator->sort('Empresa.nombre_corto','Almacén'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		'Acciones'));

	foreach($empresas as $empresa):
	echo $this->Html->tableCells(array(
		$empresa['Empresa']['nombre_corto'],
		$empresa['Empresa']['codigo_contable'],
		//substr($empresa['Empresa']['cuenta_bancaria'],4,4),
		$empresa['Empresa']['Pais']['nombre'],
		$empresa['Empresa']['telefono'],
		$this->Html->link('<i class="fa fa-info-circle"></i> Detalles',array('action'=>'view',$empresa['Almacen']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'))//.' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		//$this->Form->postLink('Borrar',array('action'=>'delete',$empresa['Empresa']['id']),array('confirm'=>'Realmente quiere borrar '.$empresa['Empresa']['nombre'].'?'))
	));

	endforeach;?>
	</table>
	<div class="btabla">
		<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Almacén',array('action'=>'add'),array('escape' => false)); ?>
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

<?php endif; ?>

