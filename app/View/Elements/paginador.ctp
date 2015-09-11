<?php echo $this->Paginator->counter(
	   array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
);?>
<div class="paging">
	<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled'));?>
</div>
