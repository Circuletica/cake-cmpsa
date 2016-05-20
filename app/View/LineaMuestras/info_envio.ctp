<?php

echo $this->Form->create('EnvioCalidad'); 
echo "<h2>Informe de calidad de la línea de muestra <em>".$muestra['tipo_registro']."</em></h2>\n";


?>
<fieldset style=width:35%;>
<legend>Contactos</legend>
<?php

foreach($contactos as $contacto){
		if(!empty($contacto['Contacto']['email'])){//Controlo que no haya contactos sin email
		$opciones[$contacto['Contacto']['email']] = $contacto['Empresa']['nombre_corto'].' / '.$contacto['Contacto']['nombre'].' / '.$contacto['Contacto']['email'];
		}
	}
	echo $this->Form->input('email', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options'=>$opciones
		)
	);
?>
</fieldset>
<fieldset>
<legend>Datos</legend>
<?php
echo $this->Form->create('LineaMuestra');
/*echo $this->Form->input('email',array(
	'label'=> 'Correos a enviar (separado por comas): ',
	'after' => 'Solución temporal'
	)
);*/
echo $this->Form->input('LinueaMuestra.ref',array(
	'label'=> 'Referencia: '
	)
);
echo $this->Form->input('LinueaMuestra.a', array(
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
<fieldset style=width:29%;>
<legend>&nbsp</legend>
<?php
echo $this->Form->input('LinueaMuestra.atn', array(
	'label' =>'ATN: '
	)
);
echo $this->Form->input('LinueaMuestra.observacion_externa', array(
	'label' => 'Observaciones de la línea',
	'type' => 'textarea'
	)
);
echo $this->element('cancelarform');
/*echo $this->Html->link('<i class="fa fa-file-pdf-o fa-lg"></i> Previsualizar',
    array(
        'action' => 'info_calidad',
        $muestra['LineaMuestra']['id'],
        'ext' => 'pdf',
        $muestra['tipo_registro']
         ), 
    array(
    	'class'=>'button',
        'escape'=>false,
        'target' => '_blank',
        'title'=>'Informe calidad previo'
        )
    );*/
echo $this->Form->submit('Previsualizar informe',
	array(
		'name'=>'previsualizar',
        'title'=>'Informe calidad previo'
		)
);
	//echo $this->Form->end('Enviar informe');
	echo $this->Form->end('Enviar informe',array('name' =>'enviar'));
?>

</fieldset>
