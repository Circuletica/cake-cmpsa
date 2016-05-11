<?php
$this->extend('/Common/index');
$this->assign('object', 'Cuentas de almacén');
$this->assign('class', 'AlmacenTransporte');

$this->start('filter');
$this->end();

$this->start('main');
?>
<table class="tr3 tr4">
<?php
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('AlmacenTransporte.cuenta_almacen','Cuenta Corriente'),
		$this->Paginator->sort('Almacen.nombre_corto','Almacén'),
		$this->Paginator->sort('AlmacenTransporte.cantidad_cuenta','Cantidad'),
		$this->Paginator->sort('AlmacenTransporte.peso_bruto','Peso bruto'),
		$this->Paginator->sort('AlmacenTransporte.marca_almacen','Marca'),
		'Detalle')
	);

	foreach($almacentransportes as $almacentransporte):
		echo $this->Html->tableCells(array(
			$almacentransporte['AlmacenTransporte']['cuenta_almacen'],
			$almacentransporte['Almacen']['nombre_corto'],
			$almacentransporte['AlmacenTransporte']['cantidad_cuenta'].' bultos',
			$almacentransporte['AlmacenTransporte']['peso_bruto'].' kg',
			$almacentransporte['AlmacenTransporte']['marca_almacen'],
			$this->Button->view('almacen_transportes',$almacentransporte['AlmacenTransporte']['id'])
	));

	endforeach;
?>
</table>
<?php
$this->end();