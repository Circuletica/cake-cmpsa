<?php
$this->CSV->addRow(array(''));
foreach ($anticipos as $key => $anticipo) {
	//	$this->CSV->addRow(array(
	//		'',
	//		'',
	//		$key+1,
	//		$anticipo['Anticipo']['fecha_conta'],
	//		$anticipo['Operacion']['referencia'],
	//		$anticipo['Banco']['codigo_contable'],
	//		$anticipo['Asociado']['codigo_contable'],
	//		'.',
	//		'',
	//		'',
	//		'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
	//		$anticipo['Anticipo']['importe'],
	//		'',
	//		'',
	//		'',
	//		'',
	//		'',
	//		'',
	//		'',
	//		'.'
	//	));
	$this->CSV->addRow(array(
		//'2',
		$key+1,
		//'20170811',
		date_format(date_create($anticipo['Anticipo']['fecha_conta']),'Ymd'),
		//'57200005',
		$anticipo['Banco']['codigo_contable'],
		//'43401019',
		$anticipo['Asociado']['codigo_contable'],
		'0.00',
		//'ANT.ACTA. 16/047',
		'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
		'0.00',
		'0',
		'0.00',
		'0.00',
		'0.00',
		//'16/047',
		$anticipo['Operacion']['referencia'],
		'',
		'',
		'',
		'0',
		'0',
		'0',
		'0.000000',
		'0.00',
		'0.00',
		'',
		'',
		'',
		'',
		'0.00',
		'2',
		//'21357.54',
		$anticipo['Anticipo']['importe'],
		'0.00',
		'0.00',
		'FALSE',
		'',
		'',
		'0',
		'0.00',
		'0.00',
		'FALSE',
		'',
		'E',
		'FALSE',
		'0',
		'FALSE',
		'',
		'',
		'FALSE',
		'',
		'',
		'',
		'',
		'0.00',
		'0.00',
		'0',
		'0.00',
		'',
		'',
		'',
		'',
		'1',
		'',
		'',
		'0',
		'',
		'',
		'',
		'FALSE',
		'',
		'FALSE',
		'FALSE',
		'0.00',
		'',
		'0',
		'',
		'',
		'',
		'',
		'FALSE',
		'0',
		'',
		'',
		'',
		'0.00',
		'',
		'',
		'',
		'0.00',
		'',
		'0',
		'FALSE',
		'0',
		'',
		'0',
		'0',
		'0',
		'FALSE',
		'',
		'0.00',
		'',
		'0.00',
		'0',
		'',
		'FALSE',
		'',
		'',
		'FALSE',
		'',
		'10',
		'0',
		'',
		'0',
		'',
		'0.00',
		'FALSE',
		'FALSE',
		'0',
		''
	));
	//	$this->CSV->addRow(array(
	//		'',
	//		'',
	//		$key+1,
	//		$anticipo['Anticipo']['fecha_conta'],
	//		$anticipo['Operacion']['referencia'],
	//		$anticipo['Asociado']['codigo_contable'],
	//		$anticipo['Banco']['codigo_contable'],
	//		'.',
	//		'',
	//		'',
	//		'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
	//		'',
	//		$anticipo['Anticipo']['importe'],
	//		'',
	//		'',
	//		'',
	//		'',
	//		'',
	//		'',
	//		'.'
	//	));
	$this->CSV->addRow(array(
		//'2',
		$key+1,
		//'20170811',
		date_format(date_create($anticipo['Anticipo']['fecha_conta']),'Ymd'),
		//'43401019',
		$anticipo['Asociado']['codigo_contable'],
		//'57200005',
		$anticipo['Banco']['codigo_contable'],
		'0.00',
		//'ANT.ACTA. 16/047',
		'ANT.CTA.OP.'.$anticipo['Operacion']['referencia'],
		'0.00',
		'0',
		'0.00',
		'0.00',
		'0.00',
		//'16/047',
		$anticipo['Operacion']['referencia'],
		'',
		'',
		'',
		'0',
		'0',
		'0',
		'0.000000',
		'0.00',
		'0.00',
		'',
		'',
		'',
		'',
		'0.00',
		'2',
		//'21357.54',
		'0.00',
		$anticipo['Anticipo']['importe'],
		'0.00',
		'FALSE',
		'',
		'',
		'0',
		'0.00',
		'0.00',
		'FALSE',
		'',
		'E',
		'FALSE',
		'0',
		'FALSE',
		'',
		'',
		'FALSE',
		'',
		'',
		'',
		'',
		'0.00',
		'0.00',
		'0',
		'0.00',
		'',
		'',
		'',
		'',
		'1',
		'',
		'',
		'0',
		'',
		'',
		'',
		'FALSE',
		'',
		'FALSE',
		'FALSE',
		'0.00',
		'',
		'0',
		'',
		'',
		'',
		'',
		'FALSE',
		'0',
		'',
		'',
		'',
		'0.00',
		'',
		'',
		'',
		'0.00',
		'',
		'0',
		'FALSE',
		'0',
		'',
		'0',
		'0',
		'0',
		'FALSE',
		'',
		'0.00',
		'',
		'0.00',
		'0',
		'',
		'FALSE',
		'',
		'',
		'FALSE',
		'',
		'10',
		'0',
		'',
		'0',
		'',
		'0.00',
		'FALSE',
		'FALSE',
		'0',
		''
	));
}
$delimiter = ';';
$filename='anticipos_'.date('Ymd');
echo $this->CSV->render($filename);
?>
