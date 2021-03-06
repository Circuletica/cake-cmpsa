<?php
$this->extend('/Common/index');
$this->assign('object', 'Operaciones');
$this->assign('controller', 'operaciones');
$this->assign('class', 'Operacion');
$this->assign('add_button', 0);

$this->start('filter');
echo "<h3>Búsqueda</h3>\n";
echo $this->element('filtrooperacion'); //Elemento del Filtro de operaciones
if ($action == 'index_trafico') {  //Departamento de tráfico
	echo $this->element('informes_trafico'); //Elemento de informes de tráfico
	/* echo $this->Html->link('<i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Descargar a CSV',
	   array(
	   'controller'=>'operaciones',
	   'action'=>'export'
	   ),
	   array(
	   'target'=>'_blank',
	   'escape'=>false,
	   'title'=>'Descargar la información a un archivo CSV'
	   )
	   );*/
}
$this->end();

$this->start('main');
if (empty($operaciones)){
	echo "No hay operaciones en esta lista";
} else {
	if ($action == 'index') {  //Departamento de compras
		echo "<table class='tr5 tr6'>\n";
		echo $this->Html->tableHeaders(array(
					$this->Paginator->sort('Operacion.referencia','Ref.Operación'),
					$this->Paginator->sort('Contrato.referencia','Ref.Contrato'),
					$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
					$this->Paginator->sort('Calidad.nombre','Calidad'),
					$this->Paginator->sort('PesoOperacion.peso','Peso (kg)'),
					$this->Paginator->sort('Operacion.lotes_operacion','Lotes'),
					'Detalle')
				);
		foreach($operaciones as $operacion){
			echo $this->Html->tableCells(array(
						$operacion['Operacion']['referencia'],
						$operacion['Contrato']['referencia'],
						$operacion['Proveedor']['nombre_corto'],
						$operacion['Calidad']['nombre'],
						$operacion['PesoOperacion']['peso'],
						$operacion['Operacion']['lotes_operacion'],
						$this->Button->view('operaciones',$operacion['Operacion']['id']
							)
						)
					);
		}

	}elseif($action == 'index_trafico'){
		echo "<table class='tc3 tr6'>\n";
		echo $this->Html->tableHeaders(array(
					$this->Paginator->sort('Operacion.referencia','Ref.Operación'),
					$this->Paginator->sort('Contrato.referencia','Ref.Contrato'),
					$this->Paginator->sort('Contrato.fecha_transporte','Embarque/ Entrega'),
					$this->Paginator->sort('Calidad.nombre','Calidad'),
					$this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor'),
					$this->Paginator->sort('PesoOperacion.cantidad_embalaje', 'Bultos'),
					'Detalle')
				);
		foreach($operaciones as $operacion) {
			if (isset($operacion['Contrato']['si_entrega'])) {
				$entrega = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				$entrega = ' ('.$entrega.')';
						} else { $entrega ='';}

						echo $this->Html->tableCells(array(
								$operacion['Operacion']['referencia'],
								$operacion['Contrato']['referencia'],
								$this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,
								$operacion['Calidad']['nombre'],
								$operacion['Proveedor']['nombre_corto'],
								$operacion['PesoOperacion']['cantidad_embalaje'],
								//No se puede usar el ButtonHelper. Enlace distinto.
								$this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view_trafico',$operacion['Operacion']['id']), array('class'=>'boton','escape' => false,'title'=>'Detalle'))
								));
						}
						}
						echo "</table>\n";
						}
						$this->end();
						?>
