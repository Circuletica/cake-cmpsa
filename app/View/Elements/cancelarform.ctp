 <?php   
 	echo $this->Html->Link(
 		'<i class="fa fa-arrow-left"></i> Cancelar',
 		$this->request->referer(''), array(
 			'class' => 'botond',
 			'escape'=>false,
 			)
 		);
 ?>

