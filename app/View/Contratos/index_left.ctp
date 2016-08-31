<?php
$this->Html->addCrumb('Contratos', array(
	'controller' => 'contratos',
	'action' => 'index')
);

$this->extend('/Common/index');
$this->assign('object', 'Contratos con peso pendiente');
$this->assign('class', 'Contrato');
$this->assign('add_button', 0);

$this->start('main');
if (empty($contratos)) {
	echo "No hay contratos en esta lista";
} else {
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Contrato.referencia','Referencia'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('Incoterm.nombre','Incoterm'),
		$this->Paginator->sort('Contrato.calidad','Calidad'),
		$this->Paginator->sort('Contrato.posicion_bolsa','Posición'),
		$this->Paginator->sort('RestoContrato.peso_restante','Pendiente')
	));
	foreach($contratos as $contrato) {
		//mysql almacena la fecha en formato ymd
		$fecha = $contrato['Contrato']['posicion_bolsa'];
		//sacamos el nombre del mes en castellano
		$mes = strftime("%B", strtotime($fecha));
		$anyo = substr($fecha,0,4);
		$posicion_bolsa = $mes.' '.$anyo;
		echo $this->Html->tableCells(array(
			$contrato['Contrato']['referencia'],
			$contrato['Proveedor']['nombre_corto'],
			$contrato['Incoterm']['nombre'],
			$contrato['Contrato']['calidad'],
			$posicion_bolsa,
			$contrato['RestoContrato']['peso_restante'],
			$this->Button->view('contratos',$contrato['Contrato']['id'])
		));
	}
	echo "</table>\n";
}
$this->end();
?>
