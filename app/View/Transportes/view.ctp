<?php
$this->Html->addCrumb('Operación '.$transporte['OperacionLogistica']['referencia'], array(
    'controller'=>'operaciones',
    'action'=>'view_trafico',
    $transporte['OperacionLogistica']['id']
));
$this->Html->addCrumb('Línea de Transporte', array(
    'controller' => 'transportes',
    'action' => 'view',
    $transporte['Transporte']['id']
)
	);
?><div class="acciones">
	<div class="printdet">
	<ul><li>

 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
<?php // PARA VIEW
echo ' '.$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
	'action' => 'view',
	$id,
	'ext' => 'pdf',
    ),
    array(
	'escape'=>false,'target' => '_blank','title'=>'Exportar a PDF')).' '.
	$this->Html->link('<i class="fa fa-envelope-o fa-lg"></i>', 'mailto:',array('escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'));
?>

	</li>
	<li>
<?php
//Contempar si hay retirada ya o no de esto.
echo //!empty($transporte['AlmacenTransporte'])?
	//''
	//'<i class="fa fa-hand-paper-o" aria-hidden="true" fa-lg ></i> Hay cuentas de almacén'
	//:
	$this->Button->edit('transportes', $id)
	.' '.
	$this->Button->delete('transportes',$transporte['Transporte']['id'],'la línea con BL/Matrícula '.$transporte['Transporte']['matricula']);
?>
	</li>
	</ul>
	</div>
</div>
<h2>Línea de Transporte Nº <?php echo $transporte['Transporte']['linea'] ?></h2>

<div class="actions">
<?php
//echo $this->element('filtrooperacion');
//echo '<br>';
echo $this->Html->link(('<i class="fa fa-lock fa-lg"></i> Asegurar línea'),array(
	'action' => 'asegurar',
	$id,
	'ext' => 'pdf',
	date('Ymd').'seguro_linea_'.$transporte['Transporte']['linea']
	), array(
	'escape'=>false,
	'target' => '_blank',
	'title'=>'Asegurar línea peso'
	)
	);
echo $this->Html->link(('<i class="fa fa-exclamation-circle fa-lg"></i> Reclamación seguro'),
	array(
		'action' => 'reclamacion',
		$id,
		'ext' => 'pdf',
	),
	array(
		'escape'=>false,
		'target' => '_blank',
		'title'=>'Reclamación peso'
		)
	);
echo $this->Html->link(('<i class="fa fa-exclamation-circle fa-lg"></i> Solicitud prorroga'),
	array(
	    'action' => 'prorroga',
	    $id,
	    'ext' => 'pdf'
	    ),
	array(
	    'escape'=>false,
	    'target' => '_blank',
	    'title'=>'Solicitud prorroga'
	    )
	);
echo "<br><hr>";
echo $this->Html->link(
    '<i class="fa fa-plus"></i> Añadir retirada en almacén',array(
        'controller' => 'retiradas',
        'action' => 'add',
        'almacen_transporte_id'=>$transporte['Transporte']['id'],
        'from_controller' => 'operaciones',
        'from_id' => $transporte['Transporte']['operacion_logistica_id']
        ),
    array(
        'class' => 'botond',
        'title' => 'Añadir retirada en cuenta de almacén',
        'escape' => false
        )
    );
/*
//Control para las cuentas de almacén, si no hay, no puede haber distribución
echo empty($transporte['AlmacenTransporte'])?
	''
	:
	$this->Html->link(('<i class="fa fa-users" aria-hidden="true" fa-lg></i>
    Distribución asociados'),array(
	'action' => 'view',
	$id,
	'controller' => 'almacen_transportes',
    ), array(
	'escape'=>false,
	//'target' => '_blank',
	'title'=>'Distribución asociados por cuenta almacén'
    )
);*/
?>	</div>

	<div class='view'>
	<dl><?php
echo "  <dt>Operación</dt>\n";
echo "<dd>";
echo $this->Html->link($transporte['OperacionLogistica']['referencia'], array(
    'controller' => 'operaciones',
    'action' => 'view_trafico',
    $transporte['OperacionLogistica']['id'])
).'&nbsp;';
echo "</dd>";
echo "  <dt>Contrato</dt>\n";
echo "<dd>";
echo $this->Html->link($transporte['OperacionLogistica']['Contrato']['referencia'], array(
    'controller' => 'contratos',
    'action' => 'view',
    $transporte['OperacionLogistica']['Contrato']['id'])
);
echo "</dd>";
echo "  <dt>Nombre del transporte</dt>\n";
echo "<dd>";
echo $transporte['Transporte']['nombre_vehiculo'].'&nbsp;';
echo "</dd>";
if($transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre'] !='IN STORE DESPACHADO' && $transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre'] !='IN STORE'){
	echo "<dt>BL/Matrícula</dt>\n";
	echo "<dd>";
	echo $transporte['Transporte']['matricula'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Puerto de Embarque</dt>\n";
	echo "<dd>";
	echo  $transporte['PuertoCarga']['nombre'].'&nbsp;';
	echo "</dd>";
}
echo "  <dt>Puerto de Destino</dt>\n";
echo "<dd>";
echo  $transporte['PuertoDestino']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Naviera</dt>\n";
echo "<dd>";
if ($transporte['Transporte']['naviera_id'] !=NULL){
    echo $this->Html->link($transporte['Naviera']['nombre'], array(
	'controller' => 'navieras',
	'action' => 'view',
	$transporte['Naviera']['id'])
    );
}else{
    echo "Sin asignar";
}
echo "</dd>";
echo "  <dt>Agente de aduanas</dt>\n";
echo "<dd>";
if ($transporte['Transporte']['agente_id'] !=NULL){
    echo $this->Html->link($transporte['Agente']['nombre'], array(
	'controller' => 'agentes',
	'action' => 'view',
	$transporte['Agente']['id'])
    );
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
echo "  <dt>Fecha prevista llegada</dt>\n";
echo "<dd>";
//mysql almacena la fecha en formato ymd
$fecha = $transporte['Transporte']['fecha_prevista'];
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$anyo = substr($fecha,0,4);
$fecha_prevista= $dia.'-'.$mes.'-'.$anyo;
echo $fecha_prevista.'&nbsp;';
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
if ($transporte['Transporte']['fecha_llegada'] !=NULL && $transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre'] =='CIF'){
    $fecha_entrada_mercancia = date("d-m-Y", strtotime("$fecha_llegada +15 days"));
    $transporte['Transporte']['fecha_entradamerc'] = $fecha_entrada_mercancia; //Asigno una fecha + 1 mes
    echo "<span style=color:#43c35;>$fecha_entrada_mercancia</span>";
}elseif($transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre']=='CIF'){
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

if ($transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre'] !='FOB'){
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
if ($transporte['OperacionLogistica']['Contrato']['Incoterm']['nombre'] =='FOB'){
?>
	<h3>Seguro</h3>
	<dl><?php
    echo "  <dt>Aseguradora</dt>\n";
    echo "<dd>";
    if ($transporte['Transporte']['aseguradora_id']!=NULL){
	echo $this->Html->link($transporte['Aseguradora']['nombre_corto'], array(
	    'controller' => 'aseguradoras',
	    'action' => 'view',
	    $transporte['Aseguradora']['id'])
	);
    }else{
	echo "Sin asegurar";
    }
    echo "</dd>";
    echo "  <dt>Fecha del seguro</dt>\n";
    echo "<dd>";
    if ($transporte['Transporte']['fecha_carga'] !=NULL){
	$fecha = $transporte['Transporte']['fecha_seguro'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	$fecha_seguro= $dia.'-'.$mes.'-'.$anyo;
	echo $fecha_seguro.'&nbsp;';
	echo "</dd>";

    }else{
	echo "La fecha de la carga de la mercancía sin asignar";
	echo "</dd>";
    }
    echo "  <dt>Vencimiento del seguro</dt>\n";
    echo "<dd>";
    if ($transporte['Transporte']['fecha_llegada'] !=NULL){
	$fecha_vencimiento_seg = date("d-m-Y", strtotime("$fecha_llegada +1 month"));
	$transporte['Transporte']['fecha_vencimiento_seg'] = $fecha_vencimiento_seg; //Asigno una fecha + 1 mes
	echo $fecha_vencimiento_seg.'&nbsp;';
	echo "</dd>";
    }else{
	echo "La fecha de llegada sin asignar";
	echo "</dd>";
    }
    if (!empty($transporte['Transporte']['fecha_llegada'])){
	if ($transporte['Transporte']['suplemento_seguro'] !=NULL){
	    echo "  <dt>Suplemento</dt>\n";
	    echo "<dd>";
	    echo $transporte['Transporte']['suplemento_seguro'].'&nbsp;';
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
	echo '<br><h3>Reclamación</h3>';
	if ($transporte['Transporte']['peritacion'] !=NULL){
	    echo "  <dt>Peritación</dt>\n";
	    echo "<dd>";
	    echo $transporte['Transporte']['peritacion'].' €';
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

	<h3>Almacenes</h3>

	<table>
<?php
echo $this->Html->tableHeaders(array('Cuenta Corriente','Nombre', 'Cantidad', 'Peso bruto', 'Marca','Detalle'));
foreach($transporte['AlmacenTransporte'] as $linea) {
    echo $this->Html->tableCells(array(
	$linea['cuenta_almacen'],
	$linea['Almacen']['nombre_corto'],
	array(
	    $linea['cantidad_cuenta'],
	    array('style' => 'text-align:right')
	),
	array(
	    $linea['peso_bruto'],
	    array('style' => 'text-align:right')
	),
	$linea['marca_almacen'],
	$this->Button->view('almacen_transportes',$linea['id'])
    ));
}
?>
	</table>

<?php
echo "<h4>Almacenados: ".$almacenado.' / Restan: '.$restan;
if ($almacenado < $transporte['Transporte']['cantidad_embalaje']){
    echo '<div class="btabla">';
    echo $this->Button->addLine('almacen_transportes','transportes',$transporte['Transporte']['id'],'ref. almacén');
    echo '</div>';
}else{
    echo " - "."<span style=color:#c43c35;>Todos los bultos han sido almacenados</span></h4>";
}
?>
    </div>
</div>
