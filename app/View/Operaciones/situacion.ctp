<?php
foreach ($operaciones as $operacion){
	foreach($transporte as $clave => $transporte){
		$situacion = $transporte['Transporte'];
		/*if($situacion['operacion_id']== $operacion['Operacion']['id']){
			$fecha_carga = $situacion['fecha_carga']; 
			$fecha_llegada = $situacion['fecha_llegada'];     
			$nombre_vehiculo = $situacion['nombre_vehiculo'];
			$fecha_prevista = $situacion['fecha_prevista'];			
		}*/
		$situacion_embarques[] = array(
			'Calidad'=> $operacion['CalidadNombre']['nombre'],
			'Operacion' => $operacion['Operacion']['referencia'],
			'Proveedor' => $operacion['Proveedor']['nombre_corto']
			)
	}
	ksort($situacion_embarques);
	$this->set(compact('situacion_embarques'));

}