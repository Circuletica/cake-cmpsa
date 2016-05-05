<?php
echo $this->Form->create();
echo "<h2>Informe de calidad de la línea de muestra <em>".$muestra['tipo_registro']."</em></h2>\n";
?>
<fieldset style=width:63%;>
<legend>Contactos</legend>
<?php
$selected = null;
echo "<table>";
echo $this->Html->tableHeaders(array('Asociado','Nombre', 'Departamento','Email', 'Enviar'));
	foreach($contactos as $contacto){
	    echo $this->Html->tableCells(array(
	    	$contacto['Empresa']['nombre_corto'],
	    	$contacto['Contacto']['nombre'],
	    	isset($contacto['Departamento']['nombre']) ? $contacto['Departamento']['nombre'] : '',
	    	$contacto['Contacto']['email'],
	       	$this->Form->checkbox('email', array(
	       		//'value'=>$contacto['Contacto'],
	    		'selected' =>$selected,
	    		//'options'=>array($contacto['Contacto']['email']),
	    		//'name' => 'email'	
	    		)
	    	)
	    	)
	    );
	   /* if ($contacto['Contacto']['email'][=>1)
	  	 $selected = $contacto['Contacto']['email'];*/
	}
echo "</table>";
	  /*   echo  	$this->Form->input('correo',array(
	    		'value'=> array($email),
	    		'type'=> 'select',
	    		'multiple'=>'checkbox',
	    		'selected' => array($email),
	    		'options'=>$email
	    		//'name' => 'correo'	    		
	    		)
	    	);*/

?>
</fieldset>
<fieldset>
<legend>Datos de envío</legend>

<?php
echo $this->Form->input('correo',array(
	'label'=> 'Correos a enviar (separado por comas): ',
	'after' => 'Solución temporal'
	)
);
echo $this->Form->input('referencia',array(
	'label'=> 'Referencia: '
	)
);
echo $this->Form->input('a', array(
	'label'=>'A: '
	)
);
echo $this->Form->input('atn', array(
	'label' =>'ATN: '
	)
);
echo $this->Form->input('asunto',array(
	'label'=> 'Asunto: '
	)
);
echo $this->Form->input('mensaje',array(
	'label'=> 'Mensaje: ',
	'type' => 'textarea'
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
        'action' => 'info_calidad',
        $muestra['id'],
        'ext' => 'pdf',
        ), 
    array(
    	'class' => 'botond',
        'escape'=>false,
        'target' => '_blank','title'=>'Informe calidad previo'
        )
    );
	echo $this->Form->end('Enviar informe');

	/*$Email = new CakeEmail();
 	$Email->config('smtp')
    ->subject('INFORME CALIDAD')
    ->to('info@circuletica.org')
    ->from('rodolgl@gmail.com')
    ->cc('rodolgl@gmail.com')
    ->send('Un informe de calidad');*/
?>

</fieldset>
