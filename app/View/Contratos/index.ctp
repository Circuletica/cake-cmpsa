<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Contratos', array(
		'controller' => 'contratos',
		'action' => 'index')
	); ?>
<h2>Contratos</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
		?>
	</div>
	<div class='index'>
	<?php
	if (empty($contratos)):
		echo "No hay contratos en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		'Id',
		$this->Paginator->sort('Contrato.referencia','Referencia'),
		$this->Paginator->sort('proveedor','Proveedor'),
		$this->Paginator->sort('Incoterm.nombre','Incoterm'),
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('Contrato.peso_comprado','Peso'),
		'Diferencial',
		//'Bolsa',
		$this->Paginator->sort('Contrato.si_londres','Bolsa'),
		'Opciones',
		''));

	foreach($contratos as $contrato):
		echo $this->Html->tableCells(array(
			$contrato['Contrato']['id'],
			$contrato['Contrato']['referencia'],
			$contrato['Proveedor']['Empresa']['nombre'],
			$contrato['Incoterm']['nombre'],
			$contrato['CalidadNombre']['nombre'],
			$contrato['Contrato']['peso_comprado'],
			$contrato['Contrato']['diferencial'],
			$contrato['Contrato']['si_londres'] ? 'Londres' : 'NY',
			$contrato['Contrato']['opciones'],
			$this->Html->link('Detalles',array('action'=>'view',$contrato['Contrato']['id']), array('class' =>'boton' , ))//.' '.
	));

	endforeach;?>
	</table>
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
	<div class="btabla">
		<?php echo $this->Html->link('Añadir Contrato',array('action'=>'add')); ?>
	</div>
</div>
