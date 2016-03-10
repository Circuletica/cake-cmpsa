
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php // PARA VIEW
 echo " ".$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),
 	array(
 		'action' => 'View',
 		'ext' => 'pdf',
 		3
 		), 
 	array(
 		'escape'=>false,'target' => '_blank','title'=>'Exportar a PDF')).' '.
 $this->Html->link('<i class="fa fa-envelope-o fa-lg"></i>', 'mailto:',array('escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'));
 ?>
 