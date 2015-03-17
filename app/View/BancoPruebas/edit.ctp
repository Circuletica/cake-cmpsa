<h2>Modificar Banco</h2>
<?php
$this->Html->addCrumb('Modificar Banco', 'banco_pruebas/edit');
echo $this->Form->create('BancoPrueba', array('action' => 'edit'));
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
echo $this->Form->input('BancoPrueba.bic');
echo $this->Form->input('BancoPrueba.cuenta_cliente_1');
//echo $this->Form->input('BancoPrueba.cuenta_cliente_2');
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->end('Guardar banco');
