<?php
	$this->extend('/Common/viewCompany');
	$this->assign('object', 'Banco '.$referencia);
	$this->assign('class','Banco');
	$this->assign('controller','bancos');
		echo $this->Html->link(__('PDF'), array('action' => 'view_pdf', 'ext' => 'pdf', $banco['Banco']['id']));
?>
