<?php
$this->extend('/Common/index_reports');
$this->assign('object', 'Transportes');
if ($action == 'index'){
  $this->assign('title', 'Informe de despachos a día '.date("d-m-Y"));
}elseif($action == 'suplemento'){
  $this->assign('title', 'Informe sobre operaciones con suplemento sin fecha de reclamación');
}elseif ($action == 'reclamacion_factura') {
   $this->assign('title', 'Informe sobre operaciones sin fecha de reclamación - Factura final');
}elseif ($action == 'prorrogas_pendientes') {
  $this->assign('title', 'Informe de prórrogas pendientes');
}
$this->assign('controller', 'transportes');
$this->assign('class', 'Transporte');
$this->assign('add_button', 0);
$this->Html->addCrumb('Línea de Transportes', array(
    'controller' => 'transportes',
    'action' => 'index'
    )
);
//INDEX ES INFORME DE DESPACHOS

$this->start('filter');
if ($action == 'index'){
  echo $this->element('filtrotransporte'); //Elemento del filtro despacho
}
  echo $this->element('informes_trafico'); //Elemento de informes de tráfico
$this->end();
$this->start('main');
  if (empty($transportes)){
    echo "No hay transportes en esta lista";
  }else{
      if ($action == 'index') { //INDEX ES INFORME DE DESPACHOS
      echo "<table class='tc2 tc4 tc5'>\n";
      echo $this->Html->tableHeaders(array(
        $this->Paginator->sort('Operacion.referencia','Ref. Operación'),
        $this->Paginator->sort('Transporte.linea','Nº línea'),
        $this->Paginator->sort('Calidad.nombre', 'Calidad'),
        $this->Paginator->sort('Transporte.cantidad_embalaje', 'Sacos'),
        $this->Paginator->sort('Transporte.fecha_despacho_op', 'Fecha despacho'),
        'Detalle'
        )
      );
      foreach($transportes as $transporte){
        echo $this->Html->tableCells(array(
            $transporte['Operacion']['referencia'],
            $transporte['Transporte']['linea'],
            $transporte['Calidad']['nombre'],
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
      echo "</table>\n";

      }elseif($action == 'suplemento'){ //INFORME OPERACIONES CON SUPLEMENTO SIN FECHA DE RECLAMACIÓN
        echo "<table class='tc2 tc4 tc5'>\n";
        echo $this->Html->tableHeaders(array(
          $this->Paginator->sort('Operacion.referencia','Ref. Operación'),
          $this->Paginator->sort('Transporte.linea','Nº línea'),
          $this->Paginator->sort('Calidad.nombre', 'Calidad'),
          $this->Paginator->sort('Transporte.cantidad_embalaje', 'Sacos'),
          $this->Paginator->sort('Transporte.suplemento_seguro', 'Suplemento'),
          'Detalle'
          )
        );
        foreach($transportes as $transporte){
          echo $this->Html->tableCells(array(
              $transporte['Operacion']['referencia'],
              $transporte['Transporte']['linea'],
              $transporte['Calidad']['nombre'],
              $transporte['Transporte']['cantidad_embalaje'],
              $transporte['Transporte']['suplemento_seguro'],
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
        echo "</table>\n";
      }elseif($action == 'reclamacion_factura'){
        echo "<table class='tc2 tc4 tc5 tc6'>\n";
        echo $this->Html->tableHeaders(array(
          $this->Paginator->sort('Operacion.referencia','Ref. Operación'),
          $this->Paginator->sort('Transporte.linea','Nº línea'),
          $this->Paginator->sort('Calidad.nombre', 'Calidad'),
          $this->Paginator->sort('Transporte.cantidad_embalaje', 'Sacos'),
          $this->Paginator->sort('Proveedor.nombre_corto', 'Proveedor'),
          $this->Paginator->sort('Transporte.fecha_limite_retirada', 'Fecha límite retirada'),
          $this->Paginator->sort('Incoterm.nombre', 'Incoterms'),
          'Detalle'
          )
        );
        foreach($transportes as $transporte){
          if ($transporte['Incoterm']['nombre'] == 'CIF' or $transporte['Incoterm']['nombre'] == 'IN STORE DESPACHADO' or $transporte['Incoterm']['nombre'] == 'IN STORE'){
            echo $this->Html->tableCells(array(
                $transporte['Operacion']['referencia'],
                $transporte['Transporte']['linea'],
                $transporte['Calidad']['nombre'],
                $transporte['Transporte']['cantidad_embalaje'],
                $transporte['Proveedor']['nombre_corto'],
                $this->Date->format($transporte['Transporte']['fecha_limite_retirada']),
                $transporte['Incoterm']['nombre'],
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
        }
        echo "</table>\n";

      }elseif($action == 'prorrogas_pendientes'){
               echo "<table class='tc2 tc4 tc5 '>\n";
        echo $this->Html->tableHeaders(array(
          $this->Paginator->sort('Operacion.referencia','Ref. Operación'),
          $this->Paginator->sort('Transporte.linea','Nº línea'),
          $this->Paginator->sort('Calidad.nombre', 'Calidad'),
          $this->Paginator->sort('Transporte.fecha_llegada', 'Vencimiento'),
          $this->Paginator->sort('Asociado.nombre_corto', 'Asociado'),
          $this->Paginator->sort('Transporte.cantidad_embalaje', 'Sacos'),
          $this->Paginator->sort('Transporte.suplemento_seguro', 'Suplemento'),
          $this->Paginator->sort('Transporte.matricula', 'Matrícula'),
          'Detalle'
          )
        );
        foreach($transportes as $transporte){
          echo $this->Html->tableCells(array(
              $transporte['Operacion']['referencia'],
              $transporte['Transporte']['linea'],
              $transporte['Calidad']['nombre'],
               $this->Date->format($transporte['Transporte']['fecha_llegada']),
              $transporte['Asociado']['nombre_corto'],
              $transporte['Transporte']['cantidad_embalaje'],
              $transporte['Transporte']['suplemento_seguro'],
              $transporte['Transporte']['matricula'],
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
        echo "</table>\n";
      }
  }
$this->end();
?>

