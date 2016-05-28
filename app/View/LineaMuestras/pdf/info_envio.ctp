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
/*echo $this->Form->input('email',array(
	'label'=> 'Correos a enviar (separado por comas): ',
	'after' => 'Solución temporal'
	)
);*/
echo $this->Form->input('referencia',array(
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
<fieldset style=width:29%;>
<legend>&nbsp</legend>
<?php
echo $this->Form->input('atn', array(
	'label' =>'ATN: '
	)
);
echo $this->Form->input('observacion', array(
	'label' => 'Observaciones de la línea',
	'type' => 'textarea'
	)
);
echo $this->element('cancelarform')
.' '.
$this->Html->link(('<i class="fa fa-file-pdf-o fa-lg"></i> Previsualizar'),
    array(
        'action' => 'info_envio',
        $this->params['named']['from_id'],
        'ext' => 'pdf',
        $muestra['tipo_registro']
         ), 
    array(
    	'class' => 'botond',
        'escape'=>false,
        'target' => '_blank','title'=>'Informe calidad previo'
        )
    );
/*	echo $this->Form->submit('Previsualizar informe',array(
		'name'=>'info_calidad',
		'escape'=>false
		)
	);*/
//	echo $this->Form->end('Enviar informe');
//	echo $this->Form->end('Enviar informe' => 'info_envio'));


	/*$Email = new CakeEmail();
 	$Email->config('smtp')
    ->subject('INFORME CALIDAD')
    ->to('info@circuletica.org')
    ->from('rodolgl@gmail.com')
    ->cc('rodolgl@gmail.com')
    ->send('Un informe de calidad');*/
?>

</fieldset>
