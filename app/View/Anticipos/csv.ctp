<?php
$this->CSV->addRow(array(
     0 => '',
     1 => '',
     2 => 'ASIEN.',
     3 => 'FECHA',
     4 => 'DOCUMENTO',
     5 => 'SUBCUENTA',
     6 => 'CONTRAPARTI.',
     7 => 'DPT.PROYECT',
     8 => '',
     9 => 'P/C',
     10 => "C O N C E P T O",
     11 => 'DEBE',
     12 => 'HABER',
     13 => "DATOS DE IVA",
     14 => '',
     15 => '',
     16 => '',
     17 => '',
     18 => '',
     19 => 'SEGMENTO'
));
foreach ($anticipos as $key => $anticipo) {
     $this->CSV->addRow(array(
          '',
          '',
          $key+1,
          $anticipo['Anticipo']['fecha_conta'],
          $anticipo['Operacion']['referencia'],
          $anticipo['Banco']['codigo_contable'],
          $anticipo['Asociado']['codigo_contable'],
          '.',
          '',
          '',
          'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
          $anticipo['Anticipo']['importe'],
          '',
          '',
          '',
          '',
          '',
          '',
          '',
          '.'
     ));
     $this->CSV->addRow(array(
          '',
          '',
          $key+1,
          $anticipo['Anticipo']['fecha_conta'],
          $anticipo['Operacion']['referencia'],
          $anticipo['Asociado']['codigo_contable'],
          $anticipo['Banco']['codigo_contable'],
          '.',
          '',
          '',
          'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
          '',
          $anticipo['Anticipo']['importe'],
          '',
          '',
          '',
          '',
          '',
          '',
          '.'
     ));
}
$delimiter = ';';
$filename='anticipos';
echo $this->CSV->render($filename);
?>
