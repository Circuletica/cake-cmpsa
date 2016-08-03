<?php
echo $this->Form->create('Anticipo', array('action'=>'contabilizar'));
echo "<table>\n";
echo $this->Html->tableHeaders(array(
	'Contabilizar',
	$this->Paginator->sort('Anticipo.fecha_conta','Fecha'),
	$this->Paginator->sort('Operacion.referencia','Operación'),
	$this->Paginator->sort('Asociado.nombre_corto','Asociado'),
	$this->Paginator->sort('Banco.nombre_corto','Banco'),
	$this->Paginator->sort('Anticipo.importe','Importe')
));
foreach($anticipos as $anticipo) {
	echo $this->Html->tableCells(array(
		$this->Form->input(
			'si_contabilizado',
			array(
				'label' => ''
			)
		),
		$this->Date->format($anticipo['Anticipo']['fecha_conta']),
		$anticipo['Operacion']['referencia'],
		$anticipo['Asociado']['nombre_corto'],
		$anticipo['Banco']['nombre_corto'],
		$anticipo['Anticipo']['importe'],
	));
}
echo "</table>\n";
//echo $this->Form->input(
//	'incluir',
//	array(
//		'type' =>'select',
//		'multiple' => 'checkbox',
//		'label' => 'A contabilizar',
//		'options' => array(
//			'title...' => array($anticipos)
//		)
//	)
//);
echo $this->Form->end('Contabilizar');
?>
		</li>
	</ul>
</div>
