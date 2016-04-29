<?php
  $this->Html->addCrumb('Línea de Transportes', array(
    'controller' => 'transportes',
    'action' => 'index')
  );
?>

<div class="printdet">
  <?php 
  echo $this->element('imprimirI');
  ?>
</div>
<h2>Línea de Transportes<?php //echo $title;?></h2>
<div class="actions">
  <?php echo $this->element('filtrooperacion');?>
  <!--h3>Filtro de transporte</h3-->
</div>
<div class='index'>
<table>
  <?php echo $this->Html->tableHeaders(array(
    $this->Paginator->sort('Operacion.referencia','Referencia'),
    $this->Paginator->sort('Transporte.linea','Nº línea'),
    $this->Paginator->sort('Calidad.nombre', 'Calidad'),
    $this->Paginator->sort('Transporte.cantidad_embalaje', 'Cantidad bultos'),
    $this->Paginator->sort('Transporte.fecha_despacho_op', 'Fecha despacho'),
    'Detalle'
    )
  );
 foreach($transportes as $transporte){
  echo $this->Html->tableCells(array(
    $transporte['Operacion']['referencia'],
    $transporte['Transporte']['linea'],
    $transporte['Operacion']['Contrato']['Calidad']['nombre'],
    $transporte['Transporte']['cantidad_embalaje'],
    $this->Date->format($transporte['Transporte']['fecha_despacho_op']),
    $this->Html->link('<i class="fa fa-info-circle"></i>',array(
            'action'=>'view',
            $transporte['Transporte']['id']),
            array(
            'class'=>'boton',
            'escape' => false,
            'title'=>'Detalle'
            )
            )
    )
  );
 }
?>
</table>
</div>
