<h1>Modificar Contrato</h1>
<p>
<?php
	echo "Bolsa: ".$canal['CanalCompra']['nombre']."(".$canal['CanalCompra']['divisa'].")";
?>
<fieldset>
  <?php
	$this->Html->addCrumb('Contratos', '/contratos');
	//si no esta la calidad en el listado, dejamos un enlace para
	//agragarla
	$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		'controller' => 'calidades',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_action' => 'edit',
		'from_id' => $contrato['Contrato']['id']
		)
	);
	//si no esta el proveedor en el listado, dejamos un enlace para
	//agragarlo
	$enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		'controller' => 'proveedores',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_action' => 'add'
		)
	);

	echo $this->Form->create('Contrato', array(
		'action' => 'edit',
		//'onload' => 'totalDesglose()'
		)
	);
	echo $this->Form->input('referencia');
	echo $this->Form->input('incoterm_id', array(
		'label' => 'Incoterms',
		'empty' => array('' => 'Selecciona'),
	    )
	);
	echo $this->Form->input('calidad_id', array(
		'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
		'empty' => array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'combobox'
		)
	);
	echo $this->Form->input('proveedor_id', array(
		'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
		'empty' => array('' => 'Selecciona')
		)
	);
	echo $this->Form->input('peso_comprado', array(
		'id' => 'pesoComprado',
		'onblur' => 'totalDesglose()',
		'oninput' => 'totalDesglose()'
		    )
	);
	echo $this->Form->input('lotes_contrato');
  ?>
     <table>
	<tr>
      <th> </th>
      <th>cantidad</th>
      <th>peso</th>
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
//		    echo $this->Form->input(
//			    'Embalaje.'.$embalaje['Embalaje']['id'].'.peso_embalaje_real',
//			    array(
//				'label' => '',
//				'class' => 'peso',
//				'onblur' => 'totalDesglose()',
//				'oninput' => 'totalDesglose()'
//			)
//		);
		    echo '</td>';
		    echo '</tr>';
	    endforeach;
	    ?>
    </table>
    <p id="total"></p>
	<?php
		echo $this->Form->input('diferencial');
		    //Las opciones estan en Operacion
		//echo $this->Form->input('opciones');
//		echo $this->Form->input('si_londres', array(
//			'label' => 'Bolsa de Londres'
//			)
//		);
//	    echo $this->Form->radio('canal_compra', $canales, array(
//		    'legend' => false,
//		    //'value' => 1,
//		    'separator' => '<br/>',
//		    'onclick' => 'canalCompra()'
//	    		)
//	    );
		echo "<div class='linea'>\n";
		echo $this->Form->input('fecha_embarque', array(
			'label' => 'Fecha de embarque',
			'dateFormat' => 'DMY')
		);
		echo "</div>\n";
		echo "<div class='linea'>\n";
		echo $this->Form->input('fecha_entrega', array(
			'label' => 'Fecha de entrega',
			'dateFormat' => 'DMY')
		);
		echo "</div>\n";
		echo $this->Form->input('id', array('type'=>'hidden'));
		echo $this->Form->end('Guardar Contrato');
	?>
</fieldset>
<script type="text/javascript">
	window.onload = totalDesglose();
</script>
