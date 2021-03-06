<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', '/banco_pruebas');?>

<div class="printdet">
<?php
echo $this->element('imprimirI')
?>
</div>
<h2>Bancos</h2>
<?php
	if (empty($bancopruebas)):
		echo "No hay bancos en esta lista";
	else:
		//echo "<pre>";
		//print_r($bancopruebas);
		////print_r($bancopruebas['Empresa']['nombre']);
		//echo "</pre>";
?>
<table><?php
		echo $this->Html->tableHeaders(array(
			'Id',
			$this->Paginator->sort('Empresa.nombre','Banco'),
			$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
			'Agencia',
			'Teléfono',
			'Acciones'));

foreach($bancopruebas as $bancoprueba):
	echo $this->Html->tableCells(array(
		$bancoprueba['BancoPrueba']['id'],
		$bancoprueba['Empresa']['nombre'],
		$bancoprueba['Empresa']['codigo_contable'],
		substr($bancoprueba['BancoPrueba']['cuenta_cliente_1'],4,4),
		$bancoprueba['Empresa']['telefono'],
		$this->Html->link('<i class="fa fa-info-circle"></i> Detalles', array('action'=>'view',$bancoprueba['BancoPrueba']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'))//.' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		//$this->Form->postLink('Borrar',array('action'=>'delete',$bancoprueba['BancoPrueba']['id']),array('confirm'=>'Realmente quiere borrar '.$bancoprueba['Empresa']['nombre'].'?'))
	));

endforeach;?>
	</table>
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Banco',array('action'=>'add'), array('escape' => false)); ?>
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

<?php endif; ?>
