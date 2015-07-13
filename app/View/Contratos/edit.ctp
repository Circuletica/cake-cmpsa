<h1>Modificar Contrato</h1>
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
  ?>
     <table>
	<tr>
      <th> </th>
      <th>cantidad</th>
      <th>peso</th>
	</tr>
	
	<?php
	    foreach ($embalajes as $index => $embalaje):
		    echo '<tr>';
		    echo "<td>".$embalaje."</td>\n";
		    echo '<td>';
		    echo $this->Form->input('Embalaje.'.$index.'.cantidad_embalaje', array(
			'label' => '',
			'class' => 'cantidad',
			'onblur' => 'totalDesglose()',
			'oninput' => 'totalDesglose()'
			    )
		    );
		    echo '</td>';
		    echo '<td>';
		    echo $this->Form->input('Embalaje.'.$index.'.peso_embalaje_real', array(
			'label' => '',
			'class' => 'peso',
			'onblur' => 'totalDesglose()',
			'oninput' => 'totalDesglose()'
			)
		);
		    echo '</td>';
		    echo '</tr>';
	    endforeach;
	    ?>
    </table>
    <p id="total"></p>
	<?php
		echo $this->Form->input('diferencial');
		echo $this->Form->input('opciones');
		echo $this->Form->input('si_londres', array(
			'label' => 'Bolsa de Londres'
			)
		);
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
