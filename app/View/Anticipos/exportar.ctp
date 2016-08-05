<?php
echo $this->Form->create('Anticipo', array('action'=>'csv'));
echo "<table>\n";
echo $this->Html->tableHeaders(array(
//	$this->Form->input(
//		'checkbox',
//		array(
//			'type' => 'checkbox',
//			'label' => false,
//			'name' => 'selectAll',
//			'id' => 'selectAll',
//			'hiddenField' => false
//		)
//	),
	'Exportar',
	$this->Paginator->sort('Anticipo.fecha_conta','Fecha'),
	$this->Paginator->sort('Operacion.referencia','Operación'),
	$this->Paginator->sort('Asociado.nombre_corto','Asociado'),
	$this->Paginator->sort('Banco.nombre_corto','Banco'),
	$this->Paginator->sort('Anticipo.importe','Importe')
));
foreach($anticipos as $anticipo) {
	echo $this->Html->tableCells(array(
		$this->Form->checkbox(
			'exportar',
			array(
				'name' => 'data[Anticipo][]',
				'value' => $anticipo['Anticipo']['id'],
				'hiddenField' => false,
				'checked' => true
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
echo $this->Form->end('Exportar(CSV)');
?>
		</li>
	</ul>
</div>
