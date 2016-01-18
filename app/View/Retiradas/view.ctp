<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada');
//$this->assign('line_object', 'precio');
//$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
$this->assign('line_controller','retiradas');

$this->start('filter');
$this->end();

$this->start('main');

$this->end();

?>
		</div>
</div>
