<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
      'action' => 'situacion',
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
<div class='ancho_completo'>
    <table>
<?php    

	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('Contrato.referencia','Operación'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('PesoOperacion.cantidad_embalaje','Cantidad'),
		$this->Paginator->sort('Embarque/Entrega'),
		$this->Paginator->sort('Pto.Destino'),		
		$this->Paginator->sort('Fecha carga'),		
		$this->Paginator->sort('Fecha llegada'),
		$this->Paginator->sort('Nombre vehículo'),
		$this->Paginator->sort('Llegada prevista'),
		'Detalle'			
		)
	);

		foreach ($transportes as $clave=>$transporte){
				if (isset($transporte['Operacion']['Contrato']['si_entrega'])) {
				  $entrega  = $transporte['Operacion']['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				  $entrega = ' ('.$entrega.')';
				}else{ 
				  	$entrega ='';
				}
		echo $this->Html->tableCells(array(
			$transporte['Operacion']['Contrato']['CalidadNombre']['nombre'],			
			$transporte['Operacion']['referencia'],
			$transporte['Operacion']['Contrato']['Proveedor']['nombre_corto'],
			$transporte['Operacion']['PesoOperacion']['cantidad_embalaje'],		
		//	$transporte['Operacion']['PesoOperacion']['peso'].'kg',			
		    $this->Date->format($transporte['Operacion']['Contrato']['fecha_transporte']).$entrega,	
		    $transporte['PuertoDestino']['nombre'],
		    $transporte['Transporte']['fecha_carga'],
		    $transporte['Transporte']['fecha_llegada'],
		    $transporte['Transporte']['nombre_vehiculo'],
		    $transporte['Transporte']['fecha_prevista'],
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