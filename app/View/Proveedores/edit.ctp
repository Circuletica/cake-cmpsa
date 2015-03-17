<h2>Modificar Proveedor</h2>
<?php
 $this->Html->addCrumb('Proveedores', array(
	'controller'=>'proveedores',
	'action'=>'index'
	));
	$this->Html->addCrumb($proveedor['Empresa']['nombre'], array(
	'controller'=>'proveedores',
	'action'=>'view',
	$proveedor['Empresa']['id']
));

//$this->Html->addCrumb('Modificar Proveedor', 'proveedores/edit');
echo $this->Form->create('Proveedor', array('action' => 'edit'));
echo $this->Form->input('Empresa.nombre');
echo $this->Form->input('Empresa.direccion');
echo $this->Form->input('Empresa.cp');
echo $this->Form->input('Empresa.municipio');
//echo $this->Form->select('Empresa.pais_id', $paises,
//	array('label' => 'País'
//	)
//);
echo $this->Form->input('Empresa.pais_id');
echo $this->Form->input('Empresa.telefono');
echo $this->Form->input('Empresa.cif');
echo $this->Form->input('Empresa.codigo_contable');
echo $this->Form->input('Empresa.cuenta_bancaria');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->end('Guardar proveedor');
