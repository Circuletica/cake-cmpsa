<?php
	$this->extend('/Common/viewCompany');
	$this->assign('object', 'Asociado '.$referencia);
	$this->assign('class','Asociado');
	$this->assign('controller','asociados');
	$this->assign('line2_object', 'Comisión');
	$this->assign('line2_controller','comisiones');
//$this->start('filter');
//$this->end();
	echo 'esto seria el content';
?>
