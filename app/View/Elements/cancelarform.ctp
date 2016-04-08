
 <?php   
 	echo $this->Html->Link(
 		'<i class="fa fa-times"></i> Cancelar',
 		$this->request->referer(''), array(
 			'class' => 'botond',
 			'escape'=>false
 			)
 		);
 ?>
 