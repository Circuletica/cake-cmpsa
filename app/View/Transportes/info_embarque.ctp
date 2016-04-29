<?php
  $this->Html->addCrumb('Operaciones', array(
    'controller' => 'operaciones',
    'action' => 'index_trafico')
  );
?>
<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
      'action' => 'info_embarque',
      'ext' => 'pdf'),
    array(
      'escape'=>false,
      'target' => '_blank',
      'title'=>'Exportar a PDF')
  );
?>
</div>
<?php
	echo '<h2>Situación de embarques a día '.date("d-m-Y").' sin despachar</h2>';
?>
<!--<div class="actions">
  <?php echo $this->element('filtrooperacion');?>
  <!--h3>Filtro de transporte</h3-->
<!--</div>-->
<div class='ancho_completo'>
    <table>
<?php    

	echo $this->Html->tableHeaders(array(

		//$this->Paginator->sort('Calidad.nombre','Calidad'),
		$this->Paginator->sort('Operacion.referencia','Ref. Operación'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('PesoOperacion.cantidad_embalaje','Cantidad'),
		$this->Paginator->sort('Contrato.fecha_transporte','Embarque / Entrega'),
		$this->Paginator->sort('PuertoDestino.nombre','Pto. Destino'),		
		$this->Paginator->sort('Transporte.fecha_carga','Fecha carga'),		
		$this->Paginator->sort('Transporte.fecha_llegada','Fecha llegada'),
		//$this->Paginator->sort('Transporte.nombre_vehiculo','Nombre vehículo'),
		//$this->Paginator->sort('Transporte.fecha_prevista','Llegada prevista'),
		$this->Paginator->sort('Transporte.observaciones','Observaciones'),
		'Detalle'			
		)
	);

	foreach ($transportes as $clave=>$transporte){
			if (isset($transporte['Contrato']['si_entrega'])) {
			  $entrega  = $transporte['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
			  $entrega = ' ('.$entrega.')';
			}else{ 
			  	$entrega ='';
			}

		echo $this->Html->tableCells(array(

			//$transporte['CalidadNombre']['nombre'],			

			$transporte['Operacion']['referencia'],
			$transporte['Proveedor']['nombre_corto'],
			$transporte['PesoOperacion']['cantidad_embalaje'],		
		//	$transporte['Operacion']['PesoOperacion']['peso'].'kg',			
		    $this->Date->format($transporte['Contrato']['fecha_transporte']).$entrega,	
		    $transporte['PuertoDestino']['nombre'],
		    $this->Date->format($transporte['Transporte']['fecha_carga']),
		    $this->Date->format($transporte['Transporte']['fecha_llegada']),
		  //  $transporte['Transporte']['nombre_vehiculo'],
		   // $this->Date->format($transporte['Transporte']['fecha_prevista']),
		    $transporte['Transporte']['observaciones'], 
      		$this->Html->link('<i class="fa fa-info-circle"></i>',array(
      			'action'=>'view',$transporte['Transporte']['id']), array(
      			'class'=>'boton','escape' => false,'title'=>'Detalle'
      			)
      			)		
		));
		}
?>
	</table>
</div>
<?php echo $this->element('paginador');?>

