<h2>Línea de Transporte Nº <?php echo $num?></h2>

<div class='view'>
	<dl><?php
		echo "  <dt>Operación</dt>\n";
			echo "<dd>";
			echo $transporte['Operacion']['referencia'];
			echo "</dd>";
		echo "  <dt>Contrato</dt>\n";
			echo "<dd>";
			echo $transporte['Operacion']['Contrato']['referencia'];
			echo "</dd>";
		echo "  <dt>Nombre del transporte</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['nombre_vehiculo'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>BL/Matrícula</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['matricula'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Puerto de Embarque</dt>\n";
		echo "<dd>";
			echo  $transporte['PuertoCarga']['nombre'].'&nbsp;';
		echo "</dd>";
			echo "  <dt>Puerto de Destino</dt>\n";
		echo "<dd>";
			echo  $transporte['PuertoDestino']['nombre'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Naviera</dt>\n";
		echo "<dd>";
		if ($transporte['Transporte']['naviera_id'] !=NULL){
			echo $transporte['Naviera']['nombre'];
		}else{
			echo "Sin asignar";
		}
		echo "</dd>";
		echo "  <dt>Agente de aduanas</dt>\n";
		echo "<dd>";
		if ($transporte['Transporte']['agente_id'] !=NULL){
			echo $transporte['Agente']['nombre'];
		}else{
			echo "Sin asignar";
		}
		echo "</dd>";
		echo "  <dt>Tipo embalaje</dt>\n";
		echo "<dd>";
			echo $embalaje.'&nbsp;';
		echo "</dd>";				
		echo "  <dt>Bultos línea</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['cantidad_embalaje'].'&nbsp;';
		echo "</dd>";
		echo "  <dt>Observaciones</dt>\n";
		echo "<dd>";
			echo $transporte['Transporte']['observaciones'].'&nbsp;';?>
		</dd>
	<br>
	<h3>Fechas</h3>
	<?php
		echo "  <dt>Carga mercancía</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_carga'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_carga= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_carga.'&nbsp;';
		echo "</dd>";
		echo "  <dt>Fecha de llegada</dt>\n";
		echo "<dd>";
if ($transporte['Transporte']['fecha_llegada'] !=NULL){
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_llegada'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_llegada= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_llegada.'&nbsp;';
}else{
	echo 'Sin asignar';
}
		echo "</dd>";
		echo "  <dt>Pago</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_pago'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_pago= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_pago.'&nbsp;';
		echo "</dd>";
		echo "  <dt>Envío documentación</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_enviodoc'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_enviodoc= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_enviodoc.'&nbsp;';
		echo "</dd>";
		echo "  <dt>Entrada mercancía</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		/*$fecha = $transporte['Transporte']['fecha_entradamerc'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_entradamerc= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_entradamerc.'&nbsp;';*/
		if ($transporte['Transporte']['fecha_llegada'] !=NULL && $transporte['Operacion']['Contrato']['Incoterm']['nombre'] =='CIF'){
			$fecha_entrada_mercancia = date("d-m-Y", strtotime("$fecha_llegada +15 days"));
			$transporte['Transporte']['fecha_entradamerc'] = $fecha_entrada_mercancia; //Asigno una fecha + 1 mes
			echo "<span style=color:#43c35;>$fecha_entrada_mercancia</span>";
		}elseif($transporte['Operacion']['Contrato']['Incoterm']['nombre']=='CIF'){
			echo "La fecha de llegada sin asignar";
		}else{
			echo $this->Date->format($transporte['Transporte']['fecha_entradamerc']).'&nbsp;';
		}
		echo "</dd>";
		echo "  <dt>Despacho operación</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_despacho_op'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_despacho_op= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_despacho_op.'&nbsp;';
		echo "</dd>";
	if ($transporte['Operacion']['Contrato']['Incoterm']['nombre'] !='FOB'){
		echo "  <dt>Límite de retirada</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_limite_retirada'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_limite_retirada= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_limite_retirada.'&nbsp;';
		echo "</dd>";
		echo "  <dt>Reclamación factura</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_reclamacion_factura'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_reclamacion_factura= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_reclamacion_factura.'&nbsp;';
		echo "</dd>";
	}
	?>	
	</dl>
	<br>
	<?php
if ($transporte['Operacion']['Contrato']['Incoterm']['nombre'] =='FOB'){
	?>
	<h3>Seguro</h3>
	<dl><?php
		echo "  <dt>Aseguradora</dt>\n";
		echo "<dd>";
			if ($transporte['Transporte']['aseguradora_id']!=NULL){
				echo $transporte['Aseguradora']['nombre_corto'];
			}else{
					echo "Sin asegurar";
			}
		echo "</dd>";
		echo "  <dt>Fecha del seguro</dt>\n";
		echo "<dd>";
	if ($transporte['Transporte']['fecha_entradamerc'] !=NULL){
			$fecha = $transporte['Transporte']['fecha_seguro'];
				$dia = substr($fecha,8,2);
				$mes = substr($fecha,5,2);
				$anyo = substr($fecha,0,4);
				$fecha_seguro= $dia.'-'.$mes.'-'.$anyo;
			echo $fecha_seguro.'&nbsp;';
			echo "</dd>";

	}else{
		echo "La fecha de la carga de la mercancía sin asignar";
	}
			echo "  <dt>Vencimiento del seguro</dt>\n";
			echo "<dd>";
			if ($transporte['Transporte']['fecha_llegada'] !=NULL){
					$fecha_vencimiento_seg = date("d-m-Y", strtotime("$fecha_llegada +1 month"));
					$transporte['Transporte']['fecha_vencimiento_seg'] = $fecha_vencimiento_seg; //Asigno una fecha + 1 mes
					echo $fecha_vencimiento_seg.'&nbsp;' ;
			}else{
				echo "La fecha de llegada sin asignar";
			}
	if (!empty($transporte['Transporte']['fecha_llegada'])){
			echo "</dd>";
			echo "  <dt>Coste del seguro </dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['coste_seguro'].' €&nbsp;';
			echo "</dd>";

		if ($transporte['Transporte']['suplemento_seguro'] !=NULL){
			echo "  <dt>Suplemento</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['suplemento_seguro'].' €&nbsp;';
			echo "</dd>";
		}
		if ($transporte['Transporte']['peso_factura'] !=NULL){
			echo "  <dt>Peso facturado</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['peso_factura'].' Kg&nbsp;';
			echo "</dd>";
		}
		if ($transporte['Transporte']['peso_neto'] !=NULL){
			echo "  <dt>Peso neto</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['peso_neto'].' Kg&nbsp;';
			echo "</dd>";
		}
		if ($transporte['Transporte']['averia'] !=NULL){
			echo "  <dt>Avería</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['averia'].' Kg&nbsp;';
			echo "</dd>";
		}
	
		echo "  <dt>Fecha de reclamación</dt>\n";
		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_reclamacion'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_reclamacion= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_reclamacion.'&nbsp;';
		echo "</dd>";
	} 
}
	?>		
</dl>
	<div class="detallado">
	<br>
	<h3>Almacenes</h3>

	<table>
<?php
	echo $this->Html->tableHeaders(array('Cuenta Corriente','Nombre', 'Cantidad', 'Peso bruto', 'Marca'));
	foreach($transporte['AlmacenTransporte'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['cuenta_almacen'],
			$linea['Almacen']['nombre_corto'],
			array(
				$linea['cantidad_cuenta'],
				array('style' => 'text-align:right'
					)
				),
			array(
				$linea['peso_bruto'],
				array('style' => 'text-align:right'
					)
				),
			$linea['marca_almacen']
			)
		);
	endforeach;?>
	</table>

	<?php
	echo "<h4>Almacenados: ".$almacenado.' / Restan: '.$restan;
			if ($almacenado < $transporte['Transporte']['cantidad_embalaje']){
			}else{
				echo " - "."<span style=color:#c43c35;>Todos los bultos han sido almacenados</span></h4>";
			}
?>
	</div>
	</div>
	
</div>