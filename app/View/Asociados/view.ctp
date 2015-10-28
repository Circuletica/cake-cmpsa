<?php
	$this->extend('/Common/viewCompany');
	$this->assign('object', 'Asociado '.$referencia);
	$this->assign('class','Asociado');
	$this->assign('controller','asociados');
$this->start('filter');
$this->end();
?>
