<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Agentes', array(
		'controller' => 'agentes',
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
<h2>Agentes</h2>
	<?php
	if (empty($empresas)):
		echo "No hay agentes en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		//'Id',
		$this->Paginator->sort('Empresa.nombre_corto','Agente'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		''));

	foreach($empresas as $empresa):
	echo $this->Html->tableCells(array(
		//$empresa['Agente']['id'],
		$empresa['Empresa']['nombre_corto'],
		$empresa['Empresa']['codigo_contable'],
		//substr($empresa['Empresa']['cuenta_bancaria'],4,4),
		$empresa['Empresa']['Pais']['nombre'],
		$empresa['Empresa']['telefono'],
		$this->Html->link('<i class="fa fa-info-circle"></i> Detalles',array('action'=>'view',$empresa['Agente']['id']), array('class' =>'boton','escape' => false,'title'=>'Detalles'))//.' '.
	));

	endforeach;?>
	</table>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
	<div class="btabla">
		<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Agente',array('action'=>'add'), array('title'=>'Añadir Agente','escape' => false)); ?>
	</div>
	<div class="paging">
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled')); ?>
	</div>
	<?php endif; ?>

