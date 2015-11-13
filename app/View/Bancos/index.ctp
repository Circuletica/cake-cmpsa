<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', '/bancos');?>
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
<h2>Bancos</h2>
<?php
	if (empty($bancos)):
		echo "No hay bancos en esta lista";
	else:
?>
	<table><?php
		echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Empresa.nombre_corto','Banco'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'Agencia',
		'Teléfono',
		'Acciones'));
	foreach($bancos as $banco):
	echo $this->Html->tableCells(array(
		$banco['Empresa']['nombre_corto'],
		$banco['Empresa']['codigo_contable'],
		substr($banco['Banco']['cuenta_cliente_1'],4,4),
		$banco['Empresa']['telefono'],
		$this->Html->link('<i class="fa fa-info-circle"></i> Detalles', array('action'=>'view',$banco['Banco']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'))
	));
	endforeach;?>
	</table>
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Banco',array('action'=>'add'), array('title'=>'Añadir Banco','escape' => false)); ?>
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
