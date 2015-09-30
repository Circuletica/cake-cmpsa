<div class="acciones">
	<div class="printdet">
	<ul><li>
		<?php 
		echo $this->element('imprimirV');
		?>	
		
	</li>
	<li>
			<?php
		echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',
			array(
			'action'=>'edit',
			$transporte['Transporte']['id']
			),
			array('title'=>'Modificar Transporte',
				'escape'=>false))

		.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',
			array(
			'action'=>'delete',
			$transporte['Transporte']['id'],
			'from_controller' => 'transportes',
			'from_id' => $transporte['Operacion']['id']
			),		
			array(
			'escape'=>false, 'title'=> 'Borrar Transporte',
			'confirm'=>'¿Realmente quiere borrar la línea con BL/Matrícula '.$transporte['Transporte']['matricula'].'?')
		);
	?>
	</li>
	</ul>
	</div>
</div>