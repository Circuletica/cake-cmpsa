<?php
$this->Html->addCrumb(
    'Operaciones',
    array(
	'controller' => 'financiaciones',
	'action' => 'index'
    )
);
$this->Html->addCrumb('Operación '.$financiacion['Operacion']['referencia'], array(
    'controller'=>'financiaciones',
    'action'=>'view',
    $financiacion['Financiacion']['id']
));


echo $this->Form->create('Financiacion');

echo "<h2>Envío financiación a los asociados de la operación <em>".$financiacion['Operacion']['referencia']."</em></h2>\n";
?>
<fieldset style=width:60%;>
<legend>Contactos asociados</legend>
<?php
/*
foreach($asociados_operacion as $asociado_operacion){
	foreach($asociado_operacion['Asociado'] as $asociado){
    	foreach($asociado['Contacto'] as $contacto){
    		echo $contacto['nombre'];
    	}
    }
	$opciones[$asociado_operacion['Asociado']['nombre_corto']] =
	 $asociado_operacion['Asociado']['nombre_corto'].' / '.$asociado_operacion['AsociadoOperacion']['cantidad_embalaje_asociado'].' sacos / ';
}*/

foreach($asociados as $asociado){
	foreach($contactos as $contacto){
		if($asociado['Asociado']['id'] == $contacto['Contacto']['empresa_id']){
    	$opciones[$contacto['Contacto']['email']] = $asociado['Asociado']['nombre_corto'].' / './*$asociado['AsociadoOperacion']['cantidad_embalaje_asociado'].' sacos / '.*/$contacto['Contacto']['nombre'].' / '.$contacto['Contacto']['email'];
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
		if(!empty($usuario['Usuario']['email']) && $usuario['Usuario']['departamento_id'] == 1){//Controlo que no haya usuarios sin email
		$contabilidad[$usuario['Usuario']['email']] = $usuario['Usuario']['nombre'].' / '.$usuario['Usuario']['email'];
		}
	}
		echo $this->Form->input('', array(
		'name'=>'contabilidad',
		'type' => 'select',
		'selected'=> array(
			'iregarbe@cmpsa.com',
			//'mcnevado@cmpsa.com'
			),
		'multiple' => 'checkbox',
		'options'=>$contabilidad
		));
        /*echo $this->Form->input('', array(
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
echo $this->Form->input('observacion_externa', array(
	'label' => 'Observaciones',
	'type' => 'textarea'
	)
);*/
echo $this->element('cancelarform');
	//echo $this->Form->submit('Guardar',array('name' =>'guardar'));
	echo $this->Form->submit('Previsualizar',
	array(
		'name'=>'previsualizar',
        'title'=>'Financiación',
		'onclick' => "var openWin = window.open('".$this->Html->url(
        	array(
        	'action' => 'view',
			$financiacion['Operacion']['id'],
			'ext' => 'pdf',
		    'operacion_id'.$financiacion['Operacion']['id'].'_'.date('Ymd')))
		    ."', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=1200,height=800');  return false;"
	)
);
	echo $this->Form->end('Enviar informe',array('name' =>'enviar'));
?>
</fieldset>
