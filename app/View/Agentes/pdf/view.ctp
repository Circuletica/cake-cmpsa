<?php
	$this->extend('/Common/pdf/viewCompanyPdf');
	$this->assign('object', 'Agente '.$referencia);
	$this->assign('class','Agente');
	$this->assign('controller','agentes');
?>
