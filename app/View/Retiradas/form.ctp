<?php
$this->Html->addCrumb('Operaciones','/operaciones/index_trafico');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
$this->Js->set('operaciones_asociados', $operaciones_asociados);
$this->Js->set('operaciones_almacen', $operaciones_almacen);
echo $this->Js->writeBuffer(array('onDomReady' => false));

if ($action == 'add' && !empty($operacion_ref) && !empty($asociado_nombre)){
       echo "<h2>Añadir retirada de ".$asociado_nombre." en operación ".$operacion_ref."</h2>\n";
}elseif($action == 'edit') {
    echo "<h2>Modificar retirada de ".$asociado_nombre." en operación ".$operacion_ref."</h2>\n";  
    //echo '<h4>Sacos solicitados: ' $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'].' en '.$embalaje.' / Pendientes: '.$retirados'</h4>';*/
}elseif (!empty($operacion_ref) && $action == 'add'){
    echo "<h2>Añadir retirada de asociado en operación ".$operacion_ref."</h2>\n";
}else{
   echo "<h2>Añadir retirada de asociado en operación ".$operacion_ref."</h2>\n";;
}

    echo $this->Form->create('Retirada');
    ?><fieldset>

       <div class="linea">
    <?php
    echo $this->Form->input('fecha_retirada',array(
       'dateFormat' => 'DMY',
        'minYear' => date('Y')-1,
        'maxYear' => date('Y'),
        'orderYear' => 'asc',
        'timeFormat' => null ,
        'label' => 'Fecha retirada',
        'autofocus' => 'autofocus'
        )
    );
    
?>
      </div>
<?php
echo $this->Form->input('operacion_id',
	array(
		'label'=>'Ref. Operación',
		'empty' => array('' => 'Selecciona'),
		'onchange' => 'operacionesRetirada()',
		'value' => $operacion_id
	)
);
echo $this->Form->input('asociado_id',
	array(
		'label'=>'Asociado',
		'empty' =>array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'asociado', 
	'value'=> isset($asociado_id)?$asociado_id:null  
	 )
);  
?>
   </fieldset>
   <fieldset>
<?php
echo $this->Form->input('almacen_transporte_id',
	array(
		'label'=>'Cuenta Almacén',
		'empty' =>array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'almacen',
		'value'=> isset($almacen_transporte_id)?$almacen_transporte_id:null
	)
); 
  
?>
<?php
if(!empty($operacion['Embalaje']['nombre'])){
	echo $this->Form->input('embalaje_retirado',
		array(
			'label'=>'Cantidad en '.$operacion['Embalaje']['nombre']
		)
	);
}else{
	echo $this->Form->input('embalaje_retirado',
		array(
			'label'=>'Sacos retirados'
		)
	);
}
echo $this->Form->input('peso_retirado',
	array(
		'label'=>'Peso retirado (Kg)'
	)
);
?>

<?php
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Retirada');
?>

</fieldset>

<script type="text/javascript">
window.onload = operacionesRetirada();
</script>
