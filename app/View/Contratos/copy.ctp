<h1>Duplicar Contrato</h1>
<p>
<?php
	echo "Bolsa: ".$canal['CanalCompra']['nombre']."(".$canal['CanalCompra']['divisa'].")";

	$this->Html->addCrumb('Contratos', '/contratos');
	//si no esta la calidad en el listado, dejamos un enlace para
	//agragarla
	$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		'controller' => 'calidades',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_action' => 'copy',
		'from_id' => $contrato['Contrato']['id']
		)
	);
	//si no esta el proveedor en el listado, dejamos un enlace para
	//agragarlo
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_action' => 'copy',
		'from_id' => $contrato['Contrato']['id']
		)
	);

	echo $this->Form->create('Contrato', array(
		'action' => 'copy',
		)
	);
?>
<div class="col4">
<?php
	echo $this->Form->input('referencia');
	echo $this->Form->input('incoterm_id', array(
		'label' => 'Incoterms',
		'empty' => array('' => 'Selecciona'),
	    )
	);
	echo $this->Form->input('puerto_carga_id', array(
		'label' => 'Puerto de carga',
		'empty' => array('' => ''),
	    )
	);
	echo $this->Form->input('puerto_destino_id', array(
		'label' => 'Puerto de destino',
		'empty' => array('' => ''),
	    )
	);
?>
</div>
<div class="col2">
<?php
	echo $this->Form->input('calidad_id', array(
		'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
		'empty' => array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'combobox'
		)
	);
	echo $this->Form->input('proveedor_id', array(
		'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
		'empty' => array('' => '')
		)
	);
?>
</div>
<div class="col2">
<?php
	echo $this->Form->input('peso_comprado', array(
		'id' => 'pesoComprado',
		'onblur' => 'totalDesglose()',
		'oninput' => 'totalDesglose()'
		    )
	);
	echo $this->Form->input('lotes_contrato');
  ?>
  </div>
  <div class="col2">
     <table>
	<tr>
      <th>Tipo de bulto</th>
      <th>Cantidad</th>
      <th>Peso</th>
	</tr>

	<?php
	    foreach ($embalajes as $embalaje):
		    echo '<tr>';
		    echo "<td>".$embalaje['Embalaje']['nombre']."</td>\n";
		    echo '<td>';
		    echo $this->Form->input(
			    'Embalaje.'.$embalaje['Embalaje']['id'].'.cantidad_embalaje',
			    array(
				'label' => '',
				'class' => 'cantidad',
				'onblur' => 'totalDesglose()',
				'oninput' => 'totalDesglose()'
			    )
		    );
		    echo '</td>';
		    echo '<td>';
		    //rellenamos la celda de peso y la dejamos en lectura sola si
		    //el peso del embalaje es fijo
		    //casi siempre, menos los bigbag que tienen un peso variable
		    if(!$embalaje['Embalaje']['peso_embalaje']){
			    echo $this->Form->input(
				    'Embalaje.'.$embalaje['Embalaje']['id'].'.peso_embalaje_real',
				    array(
					'label' => '',
					'class' => 'peso',
					'oninput' => 'totalDesglose()'
				    )
			    );
		    } else {
			    echo $this->Form->input(
				    'Embalaje.'.$embalaje['Embalaje']['id'].'.peso_embalaje_real',
				    array(
					'label' => '',
					'default' => $embalaje['Embalaje']['peso_embalaje'],
					'class' => 'peso',
					'oninput' => 'totalDesglose()',
					'readonly' => true
					)
				);
			}
		    echo '</td>';
		    echo '</tr>';
	    endforeach;
	    ?>
    </table>
    <p id="total"></p>
	<?php
		echo $this->Form->input('diferencial');
		    //Las opciones estan en Operacion
		?>
		<br><br><br>
		<?php
		echo "<div class='radiomuestra'>\n";
		echo $this->Form->radio(
			'si_entrega',
			$tipos_fecha_transporte,
			array(
				'legend' => 'Fecha:',
				'value' => $si_entrega
			)
		);
		echo "</div>\n";
		echo "<div class='linea'>\n";
		echo $this->Form->input('fecha_transporte', array(
			'label' => '',
			'dateFormat' => 'DMY')
		);
		echo "</div>\n";
		echo "<div class='linea'>\n";
		echo $this->Form->input('posicion_bolsa', array(
			'label' => 'Posición de bolsa',
			'dateFormat' => 'MY')
		);
		echo "</div>\n";
		echo $this->Form->input('comentario');
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->end('Guardar Contrato');
	?>
</div>

<script type="text/javascript">
	window.onload = totalDesglose();
</script>
