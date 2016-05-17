<?php //$this->Html->getCrumbs(' > ');?>
<?php

	$this->Html->addCrumb('Operaciones', array(
		'controller' => 'operaciones',
		'action' => 'index')
	); ?>
<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
      'action' => 'index_pdf',
      'ext' => 'pdf'),
    array(
      'escape'=>false,
      'target' => '_blank',
      'title'=>'Exportar a PDF'
      )
    );
 ?>
</div>
<h2>Operaciones</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos ?>
		<?php	echo $this->element('filtrooperacion'); //Elemento del Filtro de operaciones?>
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
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('Calidad.nombre','Calidad'),
		$this->Paginator->sort('PesoOperacion.peso','Peso'),
		$this->Paginator->sort('Operacion.lotes_operacion','Lotes'),
		'Detalle')
	);

	foreach($operaciones as $operacion):
		echo $this->Html->tableCells(array(
			$operacion['Operacion']['referencia'],
			$operacion['Contrato']['referencia'],
			$operacion['Proveedor']['nombre_corto'],
			$operacion['Calidad']['nombre'],
			$operacion['PesoOperacion']['peso'].'kg',
			$operacion['Operacion']['lotes_operacion'],
			$this->Button->view('operaciones',$operacion['Operacion']['id'])
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
</div>
