<?php
	echo '<h2>Situación de embarques sin despachar HAY QUE SOLUCIONARLO</h2>';
?>
<div class='ancho_completo'>
    <table>
<?php

	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Calidad.nombre','Calidad'),
		$this->Paginator->sort('Contrato.referencia','Ref. Contrato'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('PesoOperacion.cantidad_embalaje','Cantidad'),
		$this->Paginator->sort('Contrato.fecha_transporte','Embarque/Entrega'),
		$this->Paginator->sort('PuertoDestino.nombre','Pto.Destino'),
		$this->Paginator->sort('fecha_carga','Fecha carga'),
		$this->Paginator->sort('fecha_llegada','Fecha llegada'),
		$this->Paginator->sort('vehiculo','Nombre vehículo'),
		$this->Paginator->sort('fecha_prevista','Llegada prevista')
		)
	);

		foreach ($transportes as $clave=>$transporte){
				if (isset($transporte['OperacionCompra']['Contrato']['si_entrega'])) {
				  $entrega  = $transporte['OperacionCompra']['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				  $entrega = ' ('.$entrega.')';
				}else{
				  	$entrega ='';
				}
		echo $this->Html->tableCells(array(
			$transporte['OperacionCompra']['Contrato']['Calidad']['nombre'],
			$transporte['OperacionCompra']['referencia'],
			$transporte[['Contrato']['Proveedor']['nombre_corto'],
			$transporte['OperacionCompra']['PesoOperacion']['cantidad_embalaje'],
		//	$transporte['OperacionCompra']['PesoOperacion']['peso'].'kg',
		    $this->Date->format($transporte['OperacionCompra']['Contrato']['fecha_transporte']).$entrega,
		    $transporte['PuertoDestino']['nombre'],
		    $this->Date->format($transporte['Transporte']['fecha_carga']),
		    $this->Date->format($transporte['Transporte']['fecha_llegada']),
		    $transporte['Transporte']['nombre_vehiculo'],
		    $this->Date->format($transporte['Transporte']['fecha_prevista']    			)
      			)
		);
		}
?>
	</table>
</div>
