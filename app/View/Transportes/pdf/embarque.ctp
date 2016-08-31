<?php
	echo '<h2>Situación de embarques sin despachar</h2>';
?>
<div class='ancho_completo'>
  <table class="tr3 tc4 tc5 tc6 tc7">
<?php

	echo $this->Html->tableHeaders(array(
		'Ref.Operación',
		'Proveedor',
		'Cantidad',
		'Emb./Ent.',
		'Pto.Destino',
		'Fecha carga',
		'Fecha llegada',
		'Llegada prevista',
		'Observaciones'
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
		    $this->Date->format($transporte['Transporte']['fecha_prevista']),
		    $transporte['Transporte']['observaciones']

		));
		}
?>
	</table>
</div>
