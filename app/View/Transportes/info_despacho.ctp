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
      'action' => 'info_embarque',
      'ext' => 'pdf'),
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
  <?php echo $this->element('filtrooperacion'); ?>
</div>
<div class='index'>
    <table>
<?php    

	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Operacion.referencia','Ref. Operación'),
		$this->Paginator->sort('Transporte.linea','Línea'),
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('Transporte.cantidad_embalaje','Cantidad'),	
		$this->Paginator->sort('Transporte.fecha_despacho_op','Fecha despacho'),
		'Detalle'			
		)
	);

		foreach ($transportes as $clave=>$transporte){
				if (isset($transporte['Operacion']['Contrato']['si_entrega'])) {
				  $entrega  = $transporte['Operacion']['Contrato']['si_entrega'] ? 'Entrega' : 'Embarque';
				  $entrega = ' ('.$entrega.')';
				}else{ 
				  	$entrega ='';
				}
		echo $this->Html->tableCells(array(
			$transporte['Operacion']['referencia'],
			$transporte['Transporte']['linea'],			
			$transporte['Operacion']['Contrato']['CalidadNombre']['nombre'],
			$transporte['Transporte']['cantidad_embalaje'],					
		    $this->Date->format($transporte['Transporte']['fecha_despacho_op']),
      		$this->Html->link('<i class="fa fa-info-circle"></i>',array(
      			'action'=>'view',$transporte['Transporte']['id']), array(
      			'class'=>'boton','escape' => false,'title'=>'Detalle'
      			)
      			)		
		));
		}
?>
	</table>
</div>