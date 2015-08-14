<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Operaciones', array(
		'controller' => 'operaciones',
		'action' => 'index')
	); ?>
<h2>Operacions</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
		?>
	</div>
	<div class='index'>
	<?php
	if (empty($operaciones)):
		echo "No hay operaciones en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Operacion.referencia','Referencia'),
		$this->Paginator->sort('Contrato.referencia','Contrato'),
		$this->Paginator->sort('Contrato.Proveedor.Empresa.nombre_corto','Proveedor'),
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('PesoOperacion.peso','Peso'),
		$this->Paginator->sort('Operacion.lotes_operacion','Lotes'),
		'')
	);

	foreach($operaciones as $operacion):
		echo $this->Html->tableCells(array(
			$operacion['Operacion']['referencia'],
			$operacion['Contrato']['referencia'],
			$operacion['Contrato']['Proveedor']['Empresa']['nombre_corto'],
			$operacion['Contrato']['CalidadNombre']['nombre'],
			$operacion['PesoOperacion']['peso'].'kg',
			$operacion['Operacion']['lotes_operacion'],
			$this->Html->link('Detalles',array('action'=>'view',$operacion['Operacion']['id']), array('class' =>'boton' , ))
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
		<?php echo $this->Html->link('Añadir Operacion',array('action'=>'add')); ?>
	</div>
</div>
