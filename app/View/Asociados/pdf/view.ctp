<?php
	$this->extend('/Common/pdf/viewCompanyPdf');
	$this->assign('object', 'Asociado '.$referencia);
	$this->assign('class','Asociado');
	$this->assign('controller','asociados');
	$this->assign('line2_object', 'Comisión');
	$this->assign('line2_controller','asociado_comisiones');
?>
