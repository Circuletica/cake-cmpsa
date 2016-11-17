<?php
$this->Html->addCrumb(
    'Operaciones',
    array(
	'controller' => 'operacion_ventas',
	'action' => 'index'
    )
);
$this->Html->addCrumb('Operación (venta)'.$operacion['Operacion']['referencia'], array(
    'controller'=>'operacion_ventas',
    'action'=>'view',
    $operacion['Operacion']['id']
));


echo $this->Form->create('Operacion');

echo "<h2>Envío de distribución a los asociados de la operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
?>
<fieldset style=width:60%;>
<legend>Contactos asociados</legend>
<?php
foreach($asociados_operacion as $asociado_operacion){
	foreach($contactos as $contacto){
		if($asociado_operacion['Asociado']['id'] == $contacto['Contacto']['empresa_id']){
    	$opciones[$contacto['Contacto']['email']] = $asociado_operacion['Asociado']['nombre_corto'].' / '.$asociado_operacion['AsociadoOperacion']['cantidad_embalaje_asociado'].' sacos / '.$contacto['Contacto']['nombre'].' / '.$contacto['Contacto']['email'];
		}
    }

}
	$opciones['circuletica@gmail.com'] = 'Circulética';

	echo $this->Form->input('', array(
		'name'=>'email',
		'type' => 'select',
		'multiple' => 'checkbox',
		'selected' =>$opciones,
		'options'=>$opciones
		)
	);
?>
</fieldset>
<fieldset style=width:35%;>
<legend>Contactos CMPSA</legend>
<?php
	foreach($usuarios as $usuario){
		if(!empty($usuario['Usuario']['email']) && $usuario['Usuario']['departamento_id'] == 3){//Controlo que no haya usuarios sin email
		$compras[$usuario['Usuario']['email']] = $usuario['Usuario']['nombre'].' / '.$usuario['Usuario']['email'];
		}
	}
		echo $this->Form->input('', array(
		'name'=>'compras',
		'type' => 'select',
		'selected'=> array(
			'cmpsa@cmpsa.com',
			'mcnevado@cmpsa.com'
			),
		'multiple' => 'checkbox',
		'options'=>$compras
		)
		);
        foreach($usuarios as $usuario){
    		if(!empty($usuario['Usuario']['email']) && $usuario['Usuario']['departamento_id'] == 4){//Controlo que no haya usuarios sin email
    		$trafico[$usuario['Usuario']['email']] = $usuario['Usuario']['nombre'].' / '.$usuario['Usuario']['email'];
    		}
    	}
    	echo $this->Form->input('', array(
    		'name'=>'trafico',
    		'type' => 'select',
    		'selected'=> array(
    			'mvillarm@cmpsa.com',
    			'yolandaordonez@cmpsa.com'
    			),
    		'multiple' => 'checkbox',
    		'options'=>$trafico
    		)
    	);
echo $this->element('cancelarform');
	//echo $this->Form->submit('Guardar',array('name' =>'guardar'));
	echo $this->Form->submit('Previsualizar',
	array(
		'name'=>'previsualizar',
        'title'=>'Distribución',
		'onclick' => "var openWin = window.open('".$this->Html->url(
        	array(
        	'action' => 'view_asociados',
			$operacion['Operacion']['id'],
			'ext' => 'pdf',
		    'operacion_id'.$operacion['Operacion']['id'].'_'.date('Ymd')))
		    ."', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=800,height=1000');  return false;"
	)
);
	echo $this->Form->end('Enviar informe',array('name' =>'enviar'));
?>
</fieldset>
