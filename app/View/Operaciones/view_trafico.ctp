<?php $this->Html->addCrumb('Operaciones', array(
    'controller'=>'operaciones',
    'action'=>'index_trafico'
));
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
    'controller'=>'operaciones',
    'action'=>'view_trafico',
    $operacion['Operacion']['id']
));
echo $this->Flash->render();
?>
<div class="acciones">
    <div class="printdet">
    <ul><li>
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
<?php // PARA VIEW
echo ' '.$this->Html->link(
    ('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
	'action' => 'view_trafico',$id,'ext' => 'pdf',
    ), 
    array(
	'escape'=>false,'target' => '_blank','title'=>'Exportar a PDF')).' '.
	$this->Html->link(
	    '<i class="fa fa-envelope-o fa-lg"></i>',
	    'mailto:',
	    array(
		'escape'=>false,
		'target' => '_blank',
		'title'=>'Enviar e-mail'
	    )
	);
?>
	</li></ul>
    </div>
</div>
    <h2>Operación <?php echo $operacion['Operacion']['referencia']//.' / Contrato'.$contrato['Contrato']['referencia'] ?></h2>
<div class="actions">
<?php
echo $this->element('filtrooperacion');
?>
</div>

<div class='view'>
<?php
echo "<dl>";
echo "  <dt>Operación</dt>\n";
echo "<dd>";
echo $operacion['Operacion']['referencia'].'&nbsp;';
echo "</dd>";
echo "  <dt>Contrato</dt>\n";
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
echo "  <dt>Calidad</dt>\n";
echo "<dd>";
echo $operacion['Contrato']['Calidad']['nombre'].'&nbsp;';
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
?>
	<!--Se hace un index de la Linea de contratos-->

	<!--Se listan los asociados que forman parte de la operación-->
<div class="detallado">
	<h3>Líneas de transporte</h3>
	<table>
<?php
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
?>	</table>
<?php		
echo '<div class="btabla">';
echo $this->Button->addLine('transportes','operaciones',$operacion['Operacion']['id'],'transporte');
echo '</div>';
if($transportado < $operacion['PesoOperacion']['cantidad_embalaje']){
    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan;
}elseif($transportado > $operacion['PesoOperacion']['cantidad_embalaje']){
    echo "<h4>Transportados: ".$transportado.' / <span style=color:#c43c35;>Restan: '.$restan."   ¡ATENCIÓN! La cantidad de Bultos son mayores a los establecidos en contrato</span></h4>";
}else{ 
    echo "<h4>Transportados: ".$transportado.' / Restan: '.$restan." - "."<span style=color:#c43c35;>Todos los bultos han sido registrados</span></h4>";
}

?>
    </div>
	<br><br>		<!--Se listan los asociados que forman parte de la operación-->

	<div class="detallado">
	<h3>Resumen retiradas</h3>
	<table>
<?php
//Se calcula la cantidad total de bultos retirados

echo $this->Html->tableHeaders(array('Asociado','Sacos','Peso solicitado (Kg)', 'Sacos retirados','Peso retirado (Kg)', 'Pendiente (sacos)','Detalle'));

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
if ($cuenta_almacen['cuenta_almacen'] != NULL ){
    echo '<div class="btabla">';
    echo $this->Button->addLine('retiradas','operaciones',$operacion['Operacion']['id'],'retirada');
    echo '</div>';
}else{
    echo "<h4><span style=color:#c43c35;>Aún no se ha almacenado nada para poder retirar.</span></h4>";
}

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
    </div>
</div>

