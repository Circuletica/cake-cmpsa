<?php
 $line=$operaciones[0]['Operacion'];
 $this->CSV->addRow(array_keys($line));
 foreach ($operaciones as $operacion)
 {
      $line = $operacion['Operacion'];
       $this->CSV->addRow($line);
 }
 $filename='operaciones';
 echo  $this->CSV->render($filename);
?>