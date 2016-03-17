<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
      'action' => 'index_trafico',
      'ext' => 'pdf'),
    array(
      'escape'=>false,
      'target' => '_blank',
      'title'=>'Exportar a PDF')).' '.
  $this->Html->link(('<i class="fa fa-area-chart"></i>'),
  array(
    'action' =>'situacion_trafico',
    'situacion',
    'ext' => 'pdf'),
  array(
    'escape'=>false,
    'target' => '_blank',
    'title'=>'Informe de situación'
    )
  );


?>
</div>
<?php
	echo '<h2>Situación de Embarques a día '.date("d-m-Y").'</h2>';
?>
<div class='ancho_completo'>
    <table>
<?php    

	echo $this->Html->tableHeaders(array(
		'Calidad',
		'Operación',
		'Proveedor',
		'T.M.',
		'Embarque/Entrega',
		'Pto.Destino',		
		'Fecha carga',		
		'Fecha llegada',
		'Barco',
		'Llegada prevista',
		'Detalle'			
		)
	);

	/*foreach($situacion_embarques as $situacion_embarque){
		echo $this->Html->tableCells(array(
				$situacion_embarque['Calidad'],
				$situacion_embarque['Operacion'],
				$situacion_embarque['Proveedor'],
				$situacion_embarque['T.M.'],
				$situacion_embarque['Embarque'],
				$situacion_embarque['Pto.Destino'],		
				$situacion_embarque['Fecha carga'],		
				$situacion_embarque['Fecha llegada'],
				$situacion_embarque['Vehiculo'],
				$situacion_embarque['Llegada prevista'],
				'Detalle'	
			)
		);
	}*/

	/*	foreach ($operaciones as $operacion){
				if (isset($operacion['Contrato']['si_entrega'])) {
				  $entrega  = $operacion['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				  $entrega = ' ('.$entrega.')';
				}else{ 
				  	$entrega ='';
				}
				if(!empty($operacion['Transporte'])){
					$fecha_carga = 'Sin asignar';
					$fecha_llegada = 'hola';
					$nombre_vehiculo ='Sin asignar';
					$fecha_prevista ='Sin asignar';
					foreach ($operacion['Transporte'] as $clave => $transporte){
					//	debug($transporte['operacion_id']);
					//	debug($transporte['nombre_vehiculo']);						
						if($transporte['nombre_vehiculo'] != $nombre_vehiculo){
						$fecha_carga = $transporte['fecha_carga']; 
						$fecha_llegada = $transporte['fecha_llegada'];     
						$nombre_vehiculo = $transporte['nombre_vehiculo'];
						$fecha_prevista = $transporte['fecha_prevista'];
							if(empty($fecha_llegada)){
								$fecha_llegada = 'Sin asignar';
							}
						}
					}
				}
		echo $this->Html->tableCells(array(
			$operacion['CalidadNombre']['nombre'],			
			$operacion['Operacion']['referencia'],
			$operacion['Proveedor']['nombre_corto'],
			$operacion['PesoOperacion']['peso'].'kg',			
		    $this->Date->format($operacion['Contrato']['fecha_transporte']).$entrega,	
		    $operacion['PuertoDestino']['nombre'],
			$operacion['Transporte'][0]['fecha_carga'],
			$fecha_llegada,
			$nombre_vehiculo,
			$fecha_prevista,
      		$this->Html->link('<i class="fa fa-info-circle"></i>',array(
      			'action'=>'view_trafico',$operacion['Operacion']['id']), array(
      			'class'=>'boton','escape' => false,'title'=>'Detalle'
      			)
      			)		
		));
		}*/
?>
	</table>
</div>