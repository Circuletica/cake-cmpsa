<?php
 $line=$transportes[0]['Transporte'];
 $this->CSV->addRow(array_keys($line));
 foreach ($transportes['Transporte'] as $transporte)
 {
      $line = $transporte;
       $this->CSV->addRow($line);
       if(!empty($transporte['Operacion']){
       	$this->CSV->addRow($transporte['Operacion']['referencia']);
       }
 }
 $filename='transportes';
 echo  $this->CSV->render($filename);
?>