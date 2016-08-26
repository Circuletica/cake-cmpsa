<?php
//$this->extend('/Common/pdf/indexPdf');
$this->assign('object', 'Transportes');
$this->assign('controller', 'transportes');
$this->assign('class', 'Transporte');

  $this->Html->addCrumb('Línea de Transportes', array(
    'controller' => 'transportes',
    'action' => $action)
  );

//echo "<h2>Línea de Transportes". $title."</h2>";
$this->start('main');
  if (empty($transportes)){
    echo "No hay transportes en esta lista";
  }else{
      if ($action == 'index') {  //Informe de despachos
      echo "<table class='tc2 tc4 tc5'>\n";
      echo $this->Html->tableHeaders(array(
       'Ref. Operación',
       'Nº línea',
       'Calidad',
       'Sacos',
       'Fecha despacho'
       )
      );
      foreach($transportes as $transporte){
        echo $this->Html->tableCells(array(
            $transporte['Operacion']['referencia'],
            $transporte['Transporte']['linea'],
            $transporte['Operacion']['Contrato']['Calidad']['nombre'],
            $transporte['Transporte']['cantidad_embalaje'],
            $this->Date->format($transporte['Transporte']['fecha_despacho_op'])
            )
        );
      }
      echo "</table>\n";
      }
  }
$this->end();

