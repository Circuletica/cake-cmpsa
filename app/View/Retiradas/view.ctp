<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada '.$referencia);
$this->assign('line_object', 'precio');
$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
//this->assign('line_controller','retiradas');

$this->start('filter');