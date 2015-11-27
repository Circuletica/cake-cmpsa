<script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByClassName('criba');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value = tot.toFixed(1);
    console.log(tot);
    if(tot == 100)
    	document.getElementById('total').style.color = "black";
    if(tot != 100)
    	document.getElementById('total').style.color = "red";
}

</script>

<h2>Agregar linea a Muestra <em><?php echo $muestra['Muestra']['referencia'].' '.$muestra['CalidadNombre']['nombre']?></em></h2>

<?php
$this->Html->addCrumb('Muestras','/muestras');
$this->Html->addCrumb('Muestra '.$muestra['Muestra']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

?>
<?php
echo $this->Form->create();
?>
	<div class="col3">
	<?php
	echo $this->Html->tableCells(array(
		$this->Form->input('marca'),
		$this->Form->input('numero_sacos', array(
			'label' => 'Número de sacos'
			)
		)
	)
	);
	echo $this->Html->tableCells(array(
		$this->Form->input('humedad'),
		$this->Form->input('tueste')
		)
	);
	echo $this->Html->tableCells(array(
		$this->Form->input('referencia_proveedor',array(
			'label' => 'Referencia Proveedor'
				)
			),
		$this->Form->input('referencia_almacen',array(
			'label' => 'Referencia Almacén' 
				)
			)
		)
	);
	?>
	</div>
	<div class="col2">
	<?php
	echo $this->Form->input('apreciacion_bebida', array(
	'label' => 'Bebida')
);

echo $this->Form->input('defecto');
	?>
	</div>
	<div class="col4">
	<?php

echo $this->Html->tableCells(array(
		$this->Form->input('criba20', array(
			'label' => 'Criba 20',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba19', array(
			'label' => 'Criba 19',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba13p', array(
			'label' => 'Caracol 13',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba18', array(
			'label' => 'Criba 18',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba12p', array(
			'label' => 'Caracol 12',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba17', array(
			'label' => 'Criba 17',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba11p', array(
			'label' => 'Caracol 11',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba16', array(
			'label' => 'Criba 16',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba10p', array(
			'label' => 'Caracol 10',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba15', array(
			'label' => 'Criba 15',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba9p', array(
			'label' => 'Caracol 9',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba14', array(
			'label' => 'Criba 14',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba8p', array(
			'label' => 'Caracol 8',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		$this->Form->input('criba13', array(
			'label' => 'Criba 13',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			)
		)

	);
echo $this->Html->tableCells(array(
		$this->Form->input('criba12', array(
			'label' => 'Criba 12',
			'class' => 'criba',
			'oninput' => 'findTotal()')
			),
		'Total : <input type="number" name="total" id="total"/>'
		)
	);
?>
</div>
<?php
echo $this->Form->end('Guardar Linea de muestra');
?>
