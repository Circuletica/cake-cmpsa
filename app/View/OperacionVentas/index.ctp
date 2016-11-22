<?php
$this->extend('/Common/index');
$this->assign('object', 'Operacion (venta)');
$this->assign('controller', 'operacion_ventas');
$this->assign('class', 'OperacionVenta');
$this->assign('add_button', 0);

$this->start('filter');
echo "<h3>Búsqueda</h3>\n";
echo $this->element('filtrooperacionventa'); //Elemento del Filtro de operaciones
if ($action == 'index_trafico') {  //Departamento de tráfico

}
$this->end();

$this->start('main');
if (empty($operaciones)){
	echo "No hay operaciones en esta lista";
} else {
	if ($action == 'index') {  //Departamento de compras
		echo "<table class='tr5 tr6'>\n";
		echo $this->Html->tableHeaders(array(
					$this->Paginator->sort('OperacionVenta.referencia','Ref.Operación'),
					$this->Paginator->sort('Calidad.nombre','Calidad'),
					$this->Paginator->sort('PesoOperacionVenta.peso','Peso total(kg)'),
					$this->Paginator->sort('OperacionVenta.precio_directo_euro','Precio €/kg directo'),
					'Detalle')
				);
		foreach($operaciones as $operacion){
			echo $this->Html->tableCells(array(
						$operacion['OperacionVenta']['referencia'],
						$operacion['OperacionCompra']['Contrato']['Calidad']['nombre'],
						'pendiente',
						//$operacion['PesoOperacionVenta']['peso'],
						$operacion['OperacionVenta']['precio_directo_euro'],
						$this->Button->view('operacion_ventas',$operacion['OperacionVenta']['id']
							)
						)
					);
		}
	}elseif($action == 'index_trafico'){
		echo "<table class='tc3 tr6'>\n";
		echo $this->Html->tableHeaders(array(
					$this->Paginator->sort('OperacionVenta.referencia','Ref.Operación'),
				//	$this->Paginator->sort('Contrato.referencia','Ref.Contrato'),
				//	$this->Paginator->sort('Contrato.fecha_transporte','Embarque/ Entrega'),
					$this->Paginator->sort('Calidad.nombre','Calidad'),
					$this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor'),
					$this->Paginator->sort('PesoOperacionVenta.cantidad_embalaje', 'Bultos'),
					'Detalle')
				);
		foreach($operaciones as $operacion) {
			if (isset($operacion['Contrato']['si_entrega'])) {
				$entrega = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				$entrega = ' ('.$entrega.')';
						} else { $entrega ='';}

						echo $this->Html->tableCells(array(
								$operacion['OperacionVenta']['referencia'],
								$operacion['Contrato']['referencia'],
								$this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,
								$operacion['Calidad']['nombre'],
								$operacion['Proveedor']['nombre_corto'],
								$operacion['PesoOperacion']['cantidad_embalaje'],
								//No se puede usar el ButtonHelper. Enlace distinto.
								$this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view_trafico',$operacion['OperacionVenta']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalle'))
								));
						}
						}
						echo "</table>\n";
						}
						?>
<div class="btabla">
	<?php echo $this->Button->add('operacion_ventas','Operación venta');
echo $this->Html->link('Start form >', array('action' => 'msf_setup'));?>
</div>
<?php
$this->end();
?>
