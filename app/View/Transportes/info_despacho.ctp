<?php
$this->Html->addCrumb('Operaciones', array(
    'controller' => 'operaciones',
    'action' => 'index_trafico')
);
?>
<div class="printdet">
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
<?php //PARA INDEX
echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
    array(
	'action' => 'info_despacho',
	'ext' => 'pdf',
	'situacion_despacho_'.date('Ymd')
    ),
    array(
	'escape'=>false,
	'target' => '_blank',
	'title'=>'Exportar a PDF')
    );
?>
</div>
<?php
echo '<h2>Situación de líneas transporte despachadas a día '.date("d-m-Y").'</h2>';
?>
<div class='actions'>
  <?php echo $this->element('filtrodespacho');?>
</div>
<div class='index'>
    <table>
<?php    

echo $this->Html->tableHeaders(array(
    $this->Paginator->sort('Operacion.referencia','Operación'),
    $this->Paginator->sort('Transporte.linea','Línea'),
    $this->Paginator->sort('Calidad.nombre','Calidad'),
    $this->Paginator->sort('Transporte.cantidad_embalaje','Cantidad'),	
    $this->Paginator->sort('Transporte.fecha_despacho_op','Fecha despacho'),
    'Detalle'			
)
	);

foreach ($despachos as $despacho){		
    echo $this->Html->tableCells(array(
	$despacho['Operacion']['referencia'],
	$despacho['Transporte']['linea'],			
	$despacho['Calidad']['nombre'],
	$despacho['Transporte']['cantidad_embalaje'],					

	$this->Date->format($despacho['Transporte']['fecha_despacho_op']),
	$this->Html->link('<i class="fa fa-info-circle"></i>',array(
	    'action'=>'view',$despacho['Transporte']['id']), array(
		'class'=>'boton','escape' => false,'title'=>'Detalle'
	    )
	)
    )
);
}
?>
	</table>
	<?php echo $this->element('paginador');?>
</div>
