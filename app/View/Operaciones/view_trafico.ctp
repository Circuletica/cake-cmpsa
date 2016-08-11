
<?php
$this->extend('/Common/view');
$this->assign('object', 'Operación '.$operacion['Operacion']['referencia']);
$this->assign('line_object', 'Líneas de transporte');
$this->assign('line2_object', 'Resumen retiradas en base a la operación');
$this->assign('id',$operacion['Operacion']['id']);
$this->assign('class','Operacion');
$this->assign('controller','operaciones');
$this->assign('line_controller','transportes');
$this->assign('line2_controller','retiradas');
$this->assign('button_edit_delete',0);
$this->assign('line_add',0);
$this->assign('line2_add',0);

$this->start('breadcrumb');
$this->Html->addCrumb(
    'Operaciones',
    array(
	'controller' => 'operaciones',
	'action' => 'index_trafico'
    )
);
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
    'controller'=>'operaciones',
    'action'=>'view_trafico',
    $operacion['Operacion']['id']
));
$this->end();

$this->start('filter');
	echo  $this->Html->link(
	    '<i class="fa fa-envelope fa-lg aria-hidden="true"></i> Envío distribución',
	    array(
		'action' =>'envio_asociados',
		$id
	    ),
	    array(
		'escape'=>false,
		'title'=>'Envío distribución asociados',
	    )
	);

$this->end();

$this->start('main');
echo "<dl>";
echo "  <dt>Ref. operación</dt>\n";
echo "<dd>";
echo $operacion['Operacion']['referencia'].'&nbsp;';
echo "</dd>";
echo "  <dt>Ref. contrato</dt>\n";
echo "<dd>";
echo $this->html->link(
    $operacion['Contrato']['referencia'],
    array(
	'controller' => 'contratos',
	'action' => 'view',
	$operacion['Operacion']['contrato_id'])
    );
echo "</dd>";
echo "  <dt>".$tipo_fecha_transporte."</dt>\n";
echo "  <dd>".$fecha_transporte."</dd>";
echo "  <dt>Muestra embarque aprobada</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['si_muestra_emb_aprob']?'&#10004;':'&nbsp;';
echo "</dd>";
echo "  <dt>Muestra entrada aprobada</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['si_muestra_entr_aprob'] ?'&#10004;':'&nbsp';
echo "</dd>";
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['Calidad']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->html->link(
    $operacion['Contrato']['Proveedor']['nombre_corto'],
    array(
	'controller' => 'proveedores',
	'action' => 'view',
	$operacion['Contrato']['Proveedor']['id']
    )
);
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
    echo "  <dt>Precio ".$operacion['PrecioTotalOperacion']['divisa']."/Tm:</dt>\n";
echo "  <dd>".
    $operacion['PrecioTotalOperacion']['precio_divisa_tonelada'].
    $operacion['PrecioTotalOperacion']['divisa'].
    '/Tm&nbsp;'.
    "</dd>";
if ($operacion['Contrato']['Incoterm']['si_flete']) {
    echo "  <dt>Flete:</dt>\n";
    echo "  <dd>".
	$operacion['Operacion']['flete'].
	'$/Tm&nbsp;'."</dd>";
}
echo "  <dt>Observaciones</dt>\n";
echo "  <dd>".$operacion['Operacion']['observaciones'].'&nbsp;'."</dd>";
echo "</dl>";
$this->end();

$this->start('lines');
	echo '<table class="tc1 tc6 tc7">';
	echo $this->Html->tableHeaders(array('Nº Línea','Nombre Transporte', 'BL/Matrícula',
	    'Fecha Carga','Bultos','Asegurado','Detalle'));
	//hay que numerar las líneas
	$i = 1;
	foreach($operacion['Transporte'] as $linea) {
	    echo $this->Html->tableCells(array(
		$linea['linea'],
		$linea['nombre_vehiculo'],
		$linea['matricula'],
		//Nos da el formato DD-MM-YYYY
		$this->Date->format($linea['fecha_carga']),
		$linea['cantidad_embalaje'],
		$this->Date->format($linea['fecha_seguro']),
		$this->Button->view('transportes',$linea['id'])
	    ));
	    //numero de la línea siguiente
	    //	$i++;
	}
	echo "</table>\n";
	echo "<div class='btabla'>\n";
	echo $this->Button->addLine('transportes','operaciones',$operacion['Operacion']['id'],'transporte');
	echo '</div>';
	if($transportado < $operacion['PesoOperacion']['cantidad_embalaje']){
	    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan;
	}elseif($transportado > $operacion['PesoOperacion']['cantidad_embalaje']){
	    echo "<h4>Transportados: ".$transportado.' / <span style=color:#c43c35;>Restan: '.$restan."   ¡ATENCIÓN! La cantidad de Bultos son mayores a los establecidos en contrato</span></h4>";
	}else{
	    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan." - "."<span style=color:#c43c35;>Todos los bultos han sido registrados</span></h4>";
	}
$this->end();

$this->start('lines2');
echo "<table>\n";
//Se calcula la cantidad total de bultos retirados

echo $this->Html->tableHeaders(array(
    'Asociado','Sacos','Peso solicitado (Kg)', 'Sacos retirados','Peso retirado (Kg)', 'Pendiente (sacos)','Detalle'
));

foreach ($lineas_retirada as $linea_retirada):
    echo $this->Html->tableCells(array(
	$linea_retirada['Nombre'],
	array(
	    $linea_retirada['Cantidad'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Peso'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Cantidad_retirado'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Peso_retirado'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Pendiente'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	$this->Html->link(
	    '<i class="fa fa-info-circle"></i> ',array(
		'controller' => 'retiradas',
		'action' => 'view_asociado',
		'asociado_id'=>$linea_retirada['asociado_id'],
		'from_controller' => 'operaciones',
		'from_id' => $operacion['Operacion']['id']
	    ),
	    array(
		'class' => 'boton',
		'title' => 'Detalle asociado',
		'escape' => false
	    )
	)
    )

);
endforeach;
    echo $this->html->tablecells(array(
	array(
	    array(
		'TOTALES',
		array(
		    'style' => 'font-weight: bold; text-align:center'
		)
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
	))
    );
?></table>
<?php
    if(is_array($cuenta_almacen)){
        echo '<div class="btabla">';
        echo $this->Button->addLine('retiradas','operaciones',$operacion['Operacion']['id'],'retirada');
        echo '</div>';
    }else{
        echo "<h4><span style=color:#c43c35;>Aún no se ha almacenado nada para poder retirar.</span></h4>";
    }

//NUEVA VISUALIZACIÓN PERO CONTROLANDO LA CANTIDAD DE SACOS QUE HAY ALMACENADOS PARA LOS ASOCIADOS.
echo '<h3>Resumen retiradas en base a las cuentas de almacén</h3>';
echo "<table>\n";
//Se calcula la cantidad total de bultos retirados

echo $this->Html->tableHeaders(array(
    'Asociado','Sacos','Peso (Kg)', 'Sacos retirados','Peso retirado (Kg)', 'Pendiente (sacos)','Detalle'
));

foreach ($lineas_retirada as $linea_retirada):
    echo $this->Html->tableCells(array(
	$linea_retirada['Nombre'],
	array(
	    $linea_retirada['Cantidad'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Peso'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Cantidad_retirado'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Peso_retirado'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	array(
	    $linea_retirada['Pendiente'],
	    array(
		'style' => 'text-align:right'
	    )
	),
	$this->Html->link(
	    '<i class="fa fa-info-circle"></i> ',array(
		'controller' => 'retiradas',
		'action' => 'view_asociado',
		'asociado_id'=>$linea_retirada['asociado_id'],
		'from_controller' => 'operaciones',
		'from_id' => $operacion['Operacion']['id']
	    ),
	    array(
		'class' => 'boton',
		'title' => 'Detalle asociado',
		'escape' => false
	    )
	)
    )

);
endforeach;
    echo $this->html->tablecells(array(
	array(
	    array(
		'TOTALES',
		array(
		    'style' => 'font-weight: bold; text-align:center'
		)
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
	))
    );
?></table>
<?php
/*if ($cuenta_almacen['cuenta_almacen'] != NULL ){
    echo '<div class="btabla">';
    echo $this->Button->addLine('retiradas','operaciones',$operacion['Operacion']['id'],'retirada');
    echo '</div>';
}else{
    echo "<h4><span style=color:#c43c35;>Aún no se ha almacenado nada para poder retirar.</span></h4>";
}*/

		/*	if($asociados_error !=0){
			echo "<h4><span style=color:#c43c35;>Hay retiradas que no se encuentra en la operación asignada, por favor, corriga el error eliminando las retiradas o agregando el asociado a la operación correspondientes</span></h4>";

			?>

			<div class="detallado">
			<br>
			<h2>Asociados que han retirado que no se encuentran en la operación</h2>

			<table>
			<?php
					echo $this->Html->tableHeaders(array('Asociado','Embalaje retirado','Peso retirado (Kg)', 'Fecha retirada','Detalle'));

					foreach ($operacion_retiradas as $operacion_retirada):
						echo $this->Html->tableCells(array(
							$operacion_retirada['Asociado']['nombre_corto'],
							array(
								$operacion_retirada['Retirada']['embalaje_retirado'],
								array(
									'style' => 'text-align:right'
								)
							),
							array(
								$operacion_retirada['Retirada']['peso_retirado'],
								array(
									'style' => 'text-align:right'
								)
							),
							array(
								$this->Date->format($operacion_retirada['Retirada']['fecha_retirada']),
								array(
									'style' => 'text-align:right'
								)
							),

								$this->Html->link(
									'<i class="fa fa-info-circle"></i> ',array(
										'controller' => 'retiradas',
										'action' => 'view_asociado',
										'asociado_id'=>$operacion_retirada['Retirada']['asociado_id'],
										'from_controller' => 'operaciones',
										'from_id' => $operacion['Operacion']['id']
										),
									array(
										'class' => 'boton',
										'title' => 'Detalle asociado',
										'escape' => false
										)
									)
								)

						);
					endforeach;
					?>
			</table>
			<?php
		}*/
?>
	    </div>
	</div>
	<?php
	$this->end();
	?>
    </div>
</div>
