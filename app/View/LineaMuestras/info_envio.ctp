<?php

//echo $this->Form->create('EnvioCalidad');
echo $this->Form->create('LineaMuestra');

echo "<h2>Informe de calidad de la línea de muestra <em>".$linea_muestra['tipo_registro']."</em></h2>\n";


?>
<fieldset style=width:44%;>
<legend>Contactos asociados</legend>
<?php

foreach($contactos as $contacto){
		if(!empty($contacto['Contacto']['email']) &&  $contacto['Empresa']['nombre_corto']!= 'CMPSA' && $contacto['Contacto']['departamento_id'] == 2){//Controlo que no haya contactos sin email
		$opciones[$contacto['Contacto']['email']] = $contacto['Empresa']['nombre_corto'].' / '.$contacto['Contacto']['nombre'].' / '.$contacto['Contacto']['email'];
		}
}

	echo $this->Form->input('', array(
		'name'=>'email',
		'type' => 'select',
		'multiple' => 'checkbox',
		'options'=>$opciones
		)
	);
	echo "<hr><br>";
	echo "<legend>Contactos CMPSA</legend>";
	foreach($usuarios as $usuario){
		if(!empty($usuario['Usuario']['email']) && $usuario['Usuario']['departamento_id'] == 2){//Controlo que no haya contactos sin email
		$calidad[$usuario['Usuario']['email']] = $usuario['Usuario']['nombre'].' / '.$usuario['Usuario']['email'];
		}
	}
	echo $this->Form->input('', array(
		'name'=>'calidad',
		'type' => 'select',
		'multiple' => 'checkbox',
		'selected' => array(
			'cerausquinr@cmpsa.com',
			//'marfernandez@cmpsa.com'
			),
		'options'=>$calidad
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
?>
</fieldset>
<fieldset style=width:25%;>
<legend>Datos</legend>
<?php
/*echo $this->Form->input('email',array(
	'label'=> 'Correos a enviar (separado por comas): ',
	'after' => 'Solución temporal'
	)
);*/
echo $this->Form->input('ref',array(
	'label'=> 'Referencia: '
	)
);
echo $this->Form->input('a', array(
	'label'=>'A: '
	)
);


/*echo $this->Form->input('asunto',array(
	'label'=> 'Asunto: '
	)
);
echo $this->Form->input('mensaje',array(
	'label'=> 'Mensaje: ',
	'type' => 'textarea'
	)
);*/
?>
</fieldset>
<fieldset style=width:25%;>
<legend>&nbsp</legend>
<?php
echo $this->Form->input('atn', array(
	'label' =>'ATN: '
	)
);
echo $this->Form->input('observacion_externa', array(
	'label' => 'Observaciones de la línea',
	'type' => 'textarea'
	)
);
echo $this->element('cancelarform');
	echo $this->Form->submit('Guardar',array('name' =>'guardar'));
	echo $this->Form->submit('Previsualizar',
	array(
		'name'=>'previsualizar',
        'title'=>'Informe calidad previo',
		'onclick' => "var openWin = window.open('".$this->Html->url(
        	array(
        	'action' => 'info_calidad',
			$linea_muestra['LineaMuestra']['id'],
			'ext' => 'pdf',
		    $linea_muestra['tipo_registro']))
		    ."', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=800,height=1000');  return false;"	    
	)
);
	echo $this->Form->end('Enviar informe',array('name' =>'enviar'));
	
?>

</fieldset>
