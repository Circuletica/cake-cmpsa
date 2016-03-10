<?php
	$this->extend('/Common/viewCompanyPdf');
	$this->assign('object', 'Banco '.$referencia);
	$this->assign('class','Banco');
	$this->assign('controller','bancos');
?>
