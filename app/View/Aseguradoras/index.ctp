<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Aseguradoras', array(
		'controller' => 'aseguradoras',
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
<h2>Aseguradoras</h2>
	<?php
	if (empty($empresas)):
		echo "No hay aseguradoras en esta lista";
	else:
	//echo "<pre>";
	//print_r($bancopruebas);
	////print_r($bancopruebas['Empresa']['nombre']);
	//echo "</pre>";

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Empresa.nombre_corto','Aseguradora'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		'Acciones'));

	foreach($empresas as $empresa):
	echo $this->Html->tableCells(array(
		$empresa['Empresa']['nombre_corto'],
		$empresa['Empresa']['codigo_contable'],
		//substr($empresa['Empresa']['cuenta_bancaria'],4,4),
		$empresa['Pais']['nombre'],
		$empresa['Empresa']['telefono'],
		$this->Html->link('<i class="fa fa-info-circle"></i> Detalles',array('action'=>'view',$empresa['Aseguradora']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'))//.' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		//$this->Form->postLink('Borrar',array('action'=>'delete',$empresa['Empresa']['id']),array('confirm'=>'Realmente quiere borrar '.$empresa['Empresa']['nombre'].'?'))
	));

	endforeach;?>
	</table>
	<div class="btabla">
		<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Aseguradora',array('action'=>'add'),array('escape' => false)); ?>
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

