<?php 
	$this->Html->addCrumb('Operación '.$transporte['Operacion']['referencia'], array(
	'controller'=>'operaciones',
	'action'=>'view_trafico',
	$transporte['Operacion']['id']
	));
	$this->Html->addCrumb('Línea Transporte ', array(
	'controller' => 'transportes',
	'action' => 'add')
	);
?><div class="acciones">
	<div class="printdet">
	<ul><li>
		<?php 
		echo $this->element('imprimirV');
		?>	
		
	</li>
	<li>
			<?php
		echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',
			array(
			'action'=>'edit',
			$transporte['Transporte']['id']
			),
			array('title'=>'Modificar Transporte',
				'escape'=>false))

		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',
			array(
			'action'=>'delete',
			$transporte['Transporte']['id'],
			'from_controller' => 'transportes',
			'from_id' => $transporte['Operacion']['id']
			),		
			array(
			'escape'=>false, 'title'=> 'Borrar Transporte',
			'confirm'=>'¿Realmente quiere borrar la línea con BL/Matrícula '.$transporte['Transporte']['matricula'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>
<h2>Línea de Transporte: Operación <?php echo $transporte['Operacion']['referencia'] ?></h2>

<div class="actions">
	<?php
	echo $this->element('filtrooperacion');
	?>
</div>

	<div class='view'>
	<dl><?php
		echo "  <dt>Operación</dt>\n";
			echo "<dd>";
			echo $this->Html->link($transporte['Operacion']['referencia'], array(
			'controller' => 'operaciones',
			'action' => 'view_trafico',
			$transporte['Operacion']['id'])
			);
			echo "</dd>";
		echo "  <dt>Contrato</dt>\n";
			echo "<dd>";
			echo $this->Html->link($transporte['Operacion']['Contrato']['referencia'], array(
			'controller' => 'contratos',
			'action' => 'view',
			$transporte['Operacion']['Contrato']['id'])
			);
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
			echo $this->Html->link($transporte['Naviera']['nombre'], array(
				'controller' => 'navieras',
				'action' => 'view',
				$transporte['Naviera']['id'])
			);
		echo "</dd>";
		echo "  <dt>Agente de aduanas</dt>\n";
		echo "<dd>";
		if ($transporte['Transporte']['agente_id'] !=NULL):
			echo $this->Html->link($transporte['Agente']['nombre'], array(
				'controller' => 'agentes',
				'action' => 'view',
				$transporte['Agente']['id'])
			);
					else:
			echo "Sin asignar";
		endif;
		echo "</dd>";
		echo "  <dt>Tipo embalaje</dt>\n";
		echo "<dd>";
			echo $embalaje.'&nbsp;';
		echo "</dd>";				
		echo "  <dt>CBultos línea</dt>\n";
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
		//mysql almacena la fecha en formato ymd
		$fecha = $transporte['Transporte']['fecha_llegada'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_llegada= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_llegada.'&nbsp;';
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
		$fecha = $transporte['Transporte']['fecha_entradamerc'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_entradamerc= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_entradamerc.'&nbsp;';
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

?>	</dl>
	<br>
	<h3>Seguro</h3>
	<dl><?php
		echo "  <dt>Aseguradora</dt>\n";
		echo "<dd>";
		if ($transporte['Transporte']['aseguradora_id']!=NULL):
			echo $this->Html->link($transporte['Aseguradora']['nombre_corto'], array(
			'controller' => 'aseguradoras',
			'action' => 'view',
			$transporte['Aseguradora']['id'])
		);
			else:
				echo "Sin asegurar";
		endif;
		echo "</dd>";
		echo "  <dt>Fecha del seguro</dt>\n";
		echo "<dd>";
		if ($transporte['Transporte']['fecha_seguro'] !=NULL):
			$fecha = $transporte['Transporte']['fecha_seguro'];
				$dia = substr($fecha,8,2);
				$mes = substr($fecha,5,2);
				$anyo = substr($fecha,0,4);
				$fecha_seguro= $dia.'-'.$mes.'-'.$anyo;
			echo $fecha_seguro.'&nbsp;';
			echo "</dd>";
			//echo date("d-m-Y", strtotime("$fecha"));
			echo "</dd>";
			echo "  <dt>Vencimiento del seguro</dt>\n";
			echo "<dd>";
			$fecha_vencimiento_seg = date("d-m-Y", strtotime("$fecha_llegada +1 month"));
			$transporte['Transporte']['fecha_vencimiento_seg'] = $fecha_vencimiento_seg; //Asigno una fecha + 1 mes
			echo $fecha_vencimiento_seg.'&nbsp;' ;
			echo "</dd>";
			echo "  <dt>Coste del seguro</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['coste_seguro'].' €&nbsp;';
			echo "</dd>";
		if ($transporte['Transporte']['suplemento_seguro'] !=NULL):
			echo "  <dt>Suplemento</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['suplemento_seguro'].' €&nbsp;';
			echo "</dd>";
		endif;
		if ($transporte['Transporte']['peso_factura'] !=NULL):
			echo "  <dt>Peso facturado</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['peso_factura'].' Kg&nbsp;';
			echo "</dd>";
		endif;
		if ($transporte['Transporte']['peso_neto'] !=NULL):
			echo "  <dt>Peso neto</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['peso_neto'].' Kg&nbsp;';
			echo "</dd>";
		endif;
		if ($transporte['Transporte']['averia'] !=NULL):
			echo "  <dt>Avería</dt>\n";
			echo "<dd>";
			echo $transporte['Transporte']['averia'].' Kg&nbsp;';
			echo "</dd>";
		endif;

			else:
			echo "Sin asegurar";
		endif;
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
	?>		
</dl>
	<div class="detallado">

	<h3>Almacenes</h3>

	<table>
<?php
	echo $this->Html->tableHeaders(array('Cuenta Corriente','Nombre', 'Cantidad', 'Peso bruto', 'Marca','Detalle'));
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
			$linea['marca_almacen'],
			$this->Button->editLine(
				'almacentransportes',
				$linea['id'],'transportes',
				$transporte['Transporte']['id']
				)
			.' '.$this->Button->deleteLine(
				'almacen_transportes',
				$linea['id'],
				'transportes',
				$transporte['Transporte']['id'],
				'la ref. almacén '.$linea['cuenta_almacen']
				)
			)
		);
	endforeach;?>
	</table>

	<?php
	echo "<h4>Bultos almacenados: ".$almacenado;
			if ($almacenado != $transporte['Transporte']['cantidad_embalaje']){
			echo '<div class="btabla">';
				echo $this->Button->addLine('almacen_transportes','transportes',$transporte['Transporte']['id'],'ref. almacén');
			echo '</div>';
			}else{
				echo " - Todos los bultos han sido almacenados</h4>";
			}
?>
	</div>
	</div>
	
</div>
