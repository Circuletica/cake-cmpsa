
 <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i></a>
 <?php //PARA INDEX
 echo " ".
 $this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i>'),array(
 	'action' => 'index',
 	'ext' => 'pdf'
 	),
 	array(
 	'escape'=>false,
 	'target' => '_blank',
 	'title'=>'Exportar a PDF'
 	)
 );
 ?>
 