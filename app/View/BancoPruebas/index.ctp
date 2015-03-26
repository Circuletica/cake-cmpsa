<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', '/banco_pruebas');?>
<h2>Bancos</h2>

	<div class="actions">
<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
	
?>
	</div>
	<div class='index'>
<?php
	if (empty($bancopruebas)):
		echo "No hay bancos en esta lista";
	else:
	//echo "<pre>";
	//print_r($bancopruebas);
	////print_r($bancopruebas['Empresa']['nombre']);
	//echo "</pre>";

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		'Id',
		$this->Paginator->sort('Empresa.nombre','Banco'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'Agencia',
		'Teléfono',
		''));

	foreach($bancopruebas as $bancoprueba):
	echo $this->Html->tableCells(array(
		$bancoprueba['BancoPrueba']['id'],
		$bancoprueba['Empresa']['nombre'],
		$bancoprueba['Empresa']['codigo_contable'],
		substr($bancoprueba['BancoPrueba']['cuenta_cliente_1'],4,4),
		$bancoprueba['Empresa']['telefono'],
		$this->Html->link('Detalles',array('action'=>'view',$bancoprueba['BancoPrueba']['id']))//.' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		//$this->Form->postLink('Borrar',array('action'=>'delete',$bancoprueba['BancoPrueba']['id']),array('confirm'=>'Realmente quiere borrar '.$bancoprueba['Empresa']['nombre'].'?'))
	));

	endforeach;?>
	</table>
	<div class="btabla">
			<?php echo $this->Html->link('Añadir Banco',array('action'=>'add')); ?>
	</div>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
?>
		
		<div class="paging">
			<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
			<?php echo $this->Paginator->numbers(array('separator' => ''));?>
			<?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
		</div>

</div>

<?php endif; ?>

