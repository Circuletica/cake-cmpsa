<h2>Agregar linea a Contrato <em><?php echo $contrato['Contrato']['referencia']?></em></h2>

<?php
<<<<<<< HEAD
	$this->Html->addCrumb('Operaciones', array(
		'controller' => 'Operaciones',
		'action' => 'index')
	);
	$this->Html->addCrumb('Añadir Operación', array(
		'controller' => 'operaciones',
		'action' => 'add')
	);
?>

<fieldset>
    <?php
	    //si no esta la calidad en el listado, dejamos un enlace para agregarlo
	    $enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
		    'controller' => 'calidades',
		    'action' => 'add',
		    'from_controller' => 'operaciones',
		    'from_action' => 'add',
		    )
	    );
	    //si no esta el proveedor en el listado, dejamos un enlace para agregarlo

	    $enlace_anyadir_proveedor = $this->Html->link ('Añadir Proveedor', array(
		    'controller' => 'proveedores',
		    'action' => 'add',
		    'from_controller' => 'operaciones',
		    'from_action' => 'add',
		    )
	    );
	//si no esta el almacén en el listado, dejamos un enlace para agregarlo
	//    $enlace_anyadir_incoterms = $this->Html->link ('Añadir Incoterms', array(
	//	    'controller' => 'incoterms',
	//	    'action' => 'add',
	//	    'from_controller' => 'operaciones',
	//	    'from_action' => 'add',
	//	    )
	 //  );
	    //Formulario para rellenar operación
	echo $this->Form->create('Operacion', array('action' => 'add'));
	echo $this->Form->input('Operacion.referencia');
	echo $this->Form->input('Operacion.cantidad_contenedores');
	echo $this->Form->input('Operacion.cambio_dolar_euro');
	echo $this->Form->input('proveedor_id', array(
	   'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	   'empty' => array('' => 'Selecciona')
		)
	);
	echo $this->Form->input('calidad_id', array(
	    'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
	    'empty' => array('' => 'Selecciona'),
	    'id' => 'combobox'
	    )
	);	
	echo $this->Form->end('Guardar Operación');
=======
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

echo 'Proveedor: '.$proveedor."\n";
echo "<p>\n";
echo 'Calidad: '.$contrato['CalidadNombre']['nombre']."\n";
echo "<p>\n";
echo 'Bolsa: '.$contrato['CanalCompra']['nombre']."\n";
echo "<p>\n";
echo 'Peso total: '.$contrato['Contrato']['peso_comprado']."\n";
echo "<p>\n";
echo 'Peso sin fijar: '.$contrato['RestoContrato']['peso_restante']."\n";
echo "<p>\n";
echo $this->Form->create('LineaContrato');
echo $this->Form->input('referencia');
echo $this->Form->input('embalaje_id', array(
	//'after' => '(quedan '.$embalajes_completo[1]['cantidad_embalaje'].' sin fijar)'
	'after' => '(quedan ????? sin fijar)'
	)
);
//necesitamos un array con la cantidad asignada a cada socio
echo "<table>";
foreach ($asociados as $id => $asociado):
	echo "<tr>";
	echo "<td>".$asociado."</td>\n";
	echo "<td>";
	echo $this->Form->input('CantidadAsociado.'.$id, array(
		'label' => ''
		)
	);
	echo "</td>";
	echo "<td>";
	//echo $embalajes_completo[1]['peso_embalaje_real'];
	echo "?????? kg";
	echo "</td>";
	echo "</tr>";
endforeach;
echo "</table>";
echo "<div class='linea'>\n";
echo $this->Form->input('lotes_linea_contrato',
	array(
		'label' => 'Lotes <em>(Quedan por fijar '.$contrato['RestoLotesContrato']['lotes_restantes'].' lotes)</em>'
	)
);
echo $this->Form->input('fecha_pos_fijacion', array(
	'label' => 'Fecha de fijación',
	'dateFormat' => 'DMY',
	'selected' => date('Y-m-1')
	)
);
		echo "</div>\n";
echo $this->Form->input('precio_fijacion', array(
	'between' => '('.$contrato['CanalCompra']['divisa'].')'
	)
);
echo $this->Form->input('precio_compra', array(
	'between' => '('.$contrato['CanalCompra']['divisa'].')',
	'label' => 'Precio factura'
	)
);
echo $this->Form->end('Guardar Linea de contrato');
>>>>>>> compras
?>
</div>

