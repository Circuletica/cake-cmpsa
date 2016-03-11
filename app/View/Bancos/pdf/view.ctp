<?php
	$this->extend('/Common/pdf/viewCompanyPdf');
	$this->assign('object', 'Banco '.$referencia);
	$this->assign('class','Banco');
	$this->assign('controller','bancos');
?>
