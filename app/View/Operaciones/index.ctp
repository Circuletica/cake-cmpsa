<?php
$this->extend('/Common/index');
$this->assign('object', 'Operaciones');
$this->assign('controller', 'operaciones');
$this->assign('class', 'Operacion');
$this->assign('add_button', 'no');


$this->start('filter');
		echo $this->element('filtrooperacion'); //Elemento del Filtro de operaciones
		if ($action == 'index_trafico') {  //Departamento de tráfico
			echo '<br>';
		 	echo  $this->Html->link('<i class="fa fa-chevron-right fa-lg"></i> Info embarques',
		 		array(
		 			'action' =>'info_embarque',
		 			'controller' => 'transportes'
		 			),
		 		array(
		 			'escape'=>false,
		 			'title'=>'Informe de situación'
		 			)
		 		);
		  	echo  $this->Html->link('<i class="fa fa-chevron-right fa-lg"></i> Info despachos',
		  		array(
		  			'action' =>'info_despacho',
		  			'controller' => 'transportes'
		  			),
		  		array(
		  			'escape'=>false,
		  			'title'=>'Informe de despachos'
		  			)
		  		);
		  	echo  $this->Html->link('<i class="fa fa-chevron-right fa-lg"></i> Info suplemento sin recl.',
		  		array(
		  			'action' =>'situacion',
		  			'controller' => 'transportes'
		  			),
		  		array(
		  			'escape'=>false,
		  			'title'=>'Informe de operaciones con suplemento sin reclamación'
		  			)
		  		);
		  	echo $this->Html->link('<i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Descargar a CSV',
		  		array(
		  			'controller'=>'operaciones',
		  			'action'=>'export'
		  			),
		  		array(
		  			'target'=>'_blank',
		  			'escape'=>false,
		  			'title'=>'Descargar la información a un archivo CSV'
		  			)
		  		); 
		}
$this->end();

$this->start('main');
	if (empty($operaciones)){
		echo "No hay operaciones en esta lista";
	}else{
	  	if ($action == 'index') {  //Departamento de compras
			echo "<table>\n";
			echo $this->Html->tableHeaders(array(
				$this->Paginator->sort('Operacion.referencia','Ref.Operación'),
				$this->Paginator->sort('Contrato.referencia','Ref.Contrato'),
				$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
				$this->Paginator->sort('Calidad.nombre','Calidad'),
				$this->Paginator->sort('PesoOperacion.peso','Peso'),
				$this->Paginator->sort('Operacion.lotes_operacion','Lotes'),
				'Detalle')
			);
			foreach($operaciones as $operacion){
				echo $this->Html->tableCells(array(
					$operacion['Operacion']['referencia'],
					$operacion['Contrato']['referencia'],
					$operacion['Proveedor']['nombre_corto'],
					$operacion['Calidad']['nombre'],
					$operacion['PesoOperacion']['peso'].'kg',
					$operacion['Operacion']['lotes_operacion'],
					$this->Button->view('operaciones',$operacion['Operacion']['id']
						)
					)
				);
			}
			echo "</table>\n";

		}elseif($action == 'index_trafico'){
		?>
		<table class="tc3 tr6">
			<tr>
		    <th><?php echo $this->Paginator->sort('Operacion.referencia', 'Ref. Operación')?></th>
		    <th><?php echo $this->Paginator->sort('Contrato.referencia', 'Ref. Contrato')?></th>
		    <th><?php echo $this->Paginator->sort('Contrato.fecha_transporte','Embarque/ Entrega')?></th>
		    <th><?php echo $this->Paginator->sort('Calidad.nombre', 'Calidad')?></th>
		    <th><?php echo $this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor');?></th>
		    <th><?php echo $this->Paginator->sort('PesoOperacion.cantidad_embalaje', 'Bultos')?></th>
		    <th><?php echo 'Detalle'?></th>
	  		</tr>
			  <?php
			  foreach($operaciones as $operacion):
				  if (isset($operacion['Contrato']['si_entrega'])) {
					  $entrega  = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
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
			  endforeach;
			  ?>
 		</table>
 		<?php
		}
	}
$this->end();
?> 
