<h2>Modificar Proveedor</h2>
<?php
 $this->Html->addCrumb('Almacenes', array(
	'controller'=>'almacenes',
	'action'=>'index'
	));
	$this->Html->addCrumb($empresa['Empresa']['nombre'], array(
	'controller'=>'almacenes',
	'action'=>'view',
	$empresa['Empresa']['id']
));

//$this->Html->addCrumb('Modificar Proveedor', 'proveedores/edit');
echo $this->Form->create('Almacen', array('action' => 'edit'));
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
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->end('Guardar almacén');
