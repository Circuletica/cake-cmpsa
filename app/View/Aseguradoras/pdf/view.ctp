<?php
	$this->extend('/Common/pdf/viewCompanyPdf');
	$this->assign('object', 'Aseguradora '.$referencia);
	$this->assign('class','Aseguradora');
	$this->assign('controller','aseguradoras');
?>
