<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Proveedores', '/proveedores');
	echo "<h2>Proveedores</h2>";
	echo "<div class='actions'>\n";
	echo $this->Html->link('Añadir Proveedor',array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'proveedores',
		'from_action' => 'index'	
		));
	echo "\n";
	echo "</div>\n";
	echo "<div class='index'>\n";
	if (empty($proveedores)):
		echo "No hay proveedores en esta lista";
	else:
	echo "<pre>";
	//print_r($bancopruebas);
	////print_r($bancopruebas['Empresa']['nombre']);
	echo "</pre>";

	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		'Id',
		$this->Paginator->sort('Empresa.nombre','Proveedor'),
		$this->Paginator->sort('Empresa.codigo_contable','Código contable'),
		'País',
		'Teléfono',
		''));

	foreach($proveedores as $proveedor):
	echo $this->Html->tableCells(array(
		$proveedor['Proveedor']['id'],
		$proveedor['Empresa']['nombre'],
		$proveedor['Empresa']['codigo_contable'],
		//substr($proveedor['Empresa']['cuenta_bancaria'],4,4),
		$proveedor['Empresa']['Pais']['nombre'],
		$proveedor['Empresa']['telefono'],
		$this->Html->link('Detalles',array('action'=>'view',$proveedor['Proveedor']['id'])).' '.
		//$this->Html->link('Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id'])).' '.
		$this->Form->postLink('Borrar',array('action'=>'delete',$proveedor['Empresa']['id']),array('confirm'=>'Realmente quiere borrar '.$proveedor['Empresa']['nombre'].'?'))
	));

	endforeach;
	echo"</table>\n";
	echo "<p>\n";
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
);
?>
</p>
<div class="paging">
	<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));?>
	<?php echo $this->Paginator->numbers(array('separator' => ''));?>
	<?php echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
</div><?php endif; ?>

