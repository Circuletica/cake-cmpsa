
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operaciones ', array(
'controller'=>'operaciones',
'action'=>'index_trafico'
));
$this->Html->addCrumb('Transporte', array(
'controller'=>'transportes',
'action'=>'view',
$this->params['named']['from_id']
));

if ($action == 'add') {
	echo "<h2>Agregar Cuenta corriente almacén</h2>\n";
  $almacenado = $transporte['Transporte']['cantidad_embalaje'] - $almacenado;  
  echo '<h4>Bultos línea: '.$transporte['Transporte']['cantidad_embalaje'].' / Bultos por almacenar: '.$almacenado.'</h4>';
   }

if ($action == 'edit') {
  echo "<h2>Modificar Cuenta corriente almacén</h2>\n";
  echo '<h4>Bultos línea: '.$transporte['Transporte']['cantidad_embalaje'].' / Bultos almacenados previamente: '.$almacenado.'</h4>';
}
  //FORMULARIO PARA RELLENAR ALMACEN TRANSPORTE
	echo $this->Form->create('AlmacenTransporte');
	?>
<fieldset>	
		<div class="col2">
		<?php
		echo $this->Form->input('almacen_id',array(
				'label'=>'Nombre almacén',
	    		'empty' => array(
            '' => 'Selecciona'
            ),					
				)
			);
		echo $this->Form->input('cuenta_almacen',array(
      'label'=>'Referencia almacén'
      )
    );
    ?>
    </div>
    <div class="col3">
    <?php
    echo $this->Form->input('cantidad_cuenta',array(
      'label'=>'Cantidad de sacos'
      )
    );
    echo $this->Form->input('peso_bruto',array(
      'label'=>'Peso bruto (Kg)'
      )
    );
		echo $this->Form->input('marca_almacen',array(
      'label'=>'Marca almacenada'
      )
    );
			?> 
	</div>
	<?php
   echo $this->Html->Link(
    '<i class="fa fa-times"></i> Cancelar',
    $this->request->referer(''), array(
    'class' => 'botond',
    'escape'=>false
    )
   );
	echo $this->Form->end('Guardar Cuenta Almacén');
	?> 
	</div>
</fieldset>