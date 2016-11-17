<h2>Operación <?php echo $operacion['OperacionCompra']['referencia']?></h2>
<div class='view'>
<?php
echo "<dl>";
echo "  <dt>Contrato</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['referencia'];
echo "</dd>";
echo "  <dt>".$tipo_fecha_transporte."</dt>\n";
echo "  <dd>".$fecha_transporte."</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['Calidad']['nombre'].'&nbsp;';
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['Proveedor']['nombre_corto'];
echo "</dd>";
echo "  <dt>Incoterms</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['Incoterm']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Peso:</dt>\n";
echo "  <dd>".$operacion['PesoOperacion']['peso'].'kg&nbsp;'."</dd>";
echo "  <dt>Embalaje:</dt>\n";
echo "  <dd>".
$operacion['PesoOperacion']['cantidad_embalaje'].' x '.
$embalaje['Embalaje']['nombre'].
' ('.$operacion['PesoOperacion']['peso'].'kg)&nbsp;'."
</dd>";
echo "  <dt>Precio $/Tm total:</dt>\n";
echo "  <dd>".$operacion['PrecioTotalOperacion']['precio_divisa_tonelada'].'$/Tm&nbsp;'."</dd>";
if ($operacion['Contrato']['Incoterm']['si_flete']) {
    echo "  <dt>Flete:</dt>\n";
    echo "  <dd>".$operacion['OperacionCompra']['flete'].'$/Tm&nbsp;'."</dd>";
}
echo "  <dt>Observaciones</dt>\n";
echo "  <dd>".$operacion['OperacionCompra']['observaciones'].'&nbsp;'."</dd>";
echo "</dl>";
?>
<!--Se hace un index de la Linea de contratos-->

<!--Se listan los asociados que forman parte de la operación-->
<br><br>
<h3>Líneas de transporte</h3>
<table>
<?php
echo $this->Html->tableHeaders(array('Nº Línea','Nombre Transporte', 'BL/Matrícula',
	    'Fecha Carga','Bultos','Asegurado'));
//hay que numerar las líneas
$i = 1;
foreach($operacion['Transporte'] as $linea) {
    echo $this->Html->tableCells(array(
		$i,
		$linea['nombre_vehiculo'],
		$linea['matricula'],
		//Nos da el formato DD-MM-YYYY
		$this->Date->format($linea['fecha_carga']),
		$linea['cantidad_embalaje'],
		$this->Date->format($linea['fecha_seguro'])
		));
    //numero de la línea siguiente
    $i++;
}
?>
</table>
<?php
if($transportado < $operacion['PesoOperacion']['cantidad_embalaje']){
    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan;

}elseif($transportado > $operacion['PesoOperacion']['cantidad_embalaje']){
    echo "<h4>Transportados: ".$transportado.' / <span style=color:#c43c35;>Restan: '.$restan."   ¡ATENCIÓN! La cantidad de Bultos son mayores a los establecidos en contrato</span></h4>";
}else{
    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan." - "."<span style=color:#c43c35;>Todos los bultos han sido transportados</span></h4>";
}

?>
<br><br>		<!--Se listan los asociados que forman parte de la operación-->

<div class="detallado">
<h3>Resumen retiradas</h3>
<table>
<?php
//Se calcula la cantidad total de bultos retirados

echo $this->Html->tableHeaders(array('Asociado','Sacos','Peso solicitado (Kg)', 'Sacos retirados','Peso retirado (Kg)', 'Pendiente (sacos)'));

foreach ($lineas_retirada as $linea_retirada) {
    echo $this->Html->tableCells(array(
		$linea_retirada['Nombre'],
		array(
		    $linea_retirada['Cantidad'],
		    array( 'style' => 'text-align:right')
		    ),
		array(
		    $linea_retirada['Peso'],
		    array( 'style' => 'text-align:right')
		    ),
		array(
		    $linea_retirada['Cantidad_retirado'],
		    array( 'style' => 'text-align:right')
		    ),
		array(
		    $linea_retirada['Peso_retirado'],
		    array( 'style' => 'text-align:right')
		    ),
		array(
		    $linea_retirada['Pendiente'],
		    array( 'style' => 'text-align:right')
		    )
		    ));
}
echo $this->html->tablecells(array(
    array(
	array(
	'TOTALES',
	array( 'style' => 'font-weight: bold; text-align:center')
	),
	array(
	    $total_sacos,
	    array(
		'style' => 'font-weight: bold; text-align:right',
		'bgcolor' => '#5FCF80'
	    )
	),
	array(
	    $total_peso,
	    array(
		'style' => 'font-weight: bold; text-align:right',
		'bgcolor' => '#5FCF80'
	    )
	),
	array(
	    $total_sacos_retirados,
	    array(
		'style' => 'font-weight: bold; text-align:right',
		'bgcolor' => '#5FCF80'
	    )
	),
	array(
	    $total_peso_retirado,
	    array(
		'style' => 'font-weight: bold; text-align:right',
		'bgcolor' => '#5FCF80'
	    )
	),
	array(
	    $total_pendiente,
	    array(
		'style' => 'font-weight: bold; text-align:right',
		'bgcolor' => '#5FCF80'
	    )
	),
	array(
	    '<i class="fa fa-arrow-left fa-lg"></i>',
	    array(
		'style' => 'text-align:center',
		'escape' => false
	    )
	 )
    )
));
?>
</table>
<?php
    if ($cuenta_almacen['cuenta_almacen'] != NULL ){

    }else{
	echo "<h4><span style=color:#c43c35;>Aún no se ha almacenado nada para poder retirar.</span></h4>";
    }
?>
</div>
</div>
</div>
</div>
