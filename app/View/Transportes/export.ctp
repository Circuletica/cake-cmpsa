<?php
 $line=$transportes[0]['Transporte'];
 $this->CSV->addRow(array_keys($line));
 foreach ($transportes['Transporte'] as $transporte)
 {
      $line = $transporte;
       $this->CSV->addRow($line);
       if(!empty($transporte['OperacionCompra']){
       	$this->CSV->addRow($transporte['OperacionCompra']['referencia']);
       }
 }
 $filename='transportes';
 echo  $this->CSV->render($filename);
?>
