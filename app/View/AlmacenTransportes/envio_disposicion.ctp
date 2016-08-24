<?php
$this->Html->addCrumb(
    'Operaciones',
    array(
	'controller' => 'almacen_transportes',
	'action' => 'index'
    )
);
$this->Html->addCrumb('Operación '.$almacentransportes['AlmacenTransporte']['cuenta_almacen'], array(
    'controller'=>'almacen_transportes',
    'action'=>'view',
    $almacentransportes['AlmacenTransporte']['id']
));


echo $this->Form->create('AlmacenTransporte');

echo "<h2>Envío de disposición a los asociados de la cuenta corriente <em>".$almacentransportes['AlmacenTransporte']['cuenta_almacen']."</em></h2>\n";
?>
<fieldset style=width:60%;>
<legend>Contactos asociados</legend>
<?php
foreach($almacentransportes['AlmacenTransporteAsociado'] as $disposicion_asociado){
	foreach($contactos as $contacto){
		if($disposicion_asociado['Asociado']['id'] == $contacto['Contacto']['empresa_id']){
    	$opciones[$contacto['Contacto']['email']] = $disposicion_asociado['Asociado']['Empresa']['nombre_corto'].' / '.$contacto['Contacto']['nombre'].' / '.$contacto['Contacto']['email'];
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
		if(!empty($usuario['Usuario']['email']) && $usuario['Usuario']['departamento_id'] == 4){//Controlo que no haya usuarios sin email
		$compras[$usuario['Usuario']['email']] = $usuario['Usuario']['nombre'].' / '.$usuario['Usuario']['email'];
		}
	}
		echo $this->Form->input('', array(
		'name'=>'compras',
		'type' => 'select',
		'selected'=> array(
            'yolandaordonez@cmpsa.com',
			'mvillarm@cmpsa.com'
			),
		'multiple' => 'checkbox',
		'options'=>$compras
		)
		);
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
        'title'=>'Disposición',
		'onclick' => "var openWin = window.open('".$this->Html->url(
        	array(
        	'action' => 'view_disposicion',
			$almacentransportes['AlmacenTransporte']['id'],
			'ext' => 'pdf',
		    'cuenta_almacen'.$almacentransportes['AlmacenTransporte']['cuenta_almacen'].'_'.date('Ymd')))
		    ."', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=800,height=1000');  return false;"
	)
);
	echo $this->Form->end('Enviar informe',array('name' =>'enviar'));
?>
</fieldset>
