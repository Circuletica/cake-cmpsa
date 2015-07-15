<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Proveedores', '/proveedores');?>
<div class="printdet">
	<ul>
		<li>
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
<h2>Proveedores</h2>
<?php 
if (empty($proveedores)):
	echo "No hay proveedores en esta lista";
else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		//'Id',
		$this->Paginator->sort('Empresa.nombre_corto','Proveedor'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		'Acciones'));

	foreach($proveedores as $proveedor):
		echo $this->Html->tableCells(array(
			//$proveedor['Proveedor']['id'],
			$proveedor['Empresa']['nombre_corto'],
			$proveedor['Empresa']['codigo_contable'],
			//substr($proveedor['Empresa']['cuenta_bancaria'],4,4),
			$proveedor['Empresa']['Pais']['nombre'],
			$proveedor['Empresa']['telefono'],
			$this->Html->link('<i class="fa fa-info-circle"></i> Detalles',array('action'=>'view',$proveedor['Proveedor']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalles'))//.' '.
			//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
			//$this->Form->postLink('Borrar',array('action'=>'delete',$proveedor['Empresa']['id']),array('confirm'=>'Realmente quiere borrar '.$proveedor['Empresa']['nombre'].'?'))
		));
	endforeach;
?>
	</table>
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-plus"></i> Añadir Proveedor',array(
			'controller' => 'proveedores',
			'action' => 'add',
			'from_controller' => 'proveedores',
			'from_action' => 'index'	
			),array('escape' => false, 'title'=>'Añadir Proveedor'));
			?>
	</div>
	<?php echo $this->Paginator->counter(
		array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>
	<div class="paging">
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
		<?php echo $this->Paginator->numbers(array('separator' => ''));?>
		<?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
	</div>
<?php endif; ?>

