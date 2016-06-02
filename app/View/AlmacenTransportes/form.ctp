
<?php
$this->Html->addCrumb('Contratos','/contratos');
$this->Html->addCrumb('Operaciones ', array(
'controller'=>'operaciones',
'action'=>'index_trafico'
));
$this->Html->addCrumb('Transporte', array(
'controller'=>'transportes',
'action'=>'view',
$transporte_id
));
  //FORMULARIO PARA RELLENAR ALMACEN TRANSPORTE
  echo $this->Form->create('AlmacenTransporte');
?>

<?php
if ($action == 'add') {
  //$almacenado = $transporte['Transporte']['cantidad_embalaje'] - $almacenado;
	echo "<h2>Agregar Cuenta corriente almacén</h2>\n";
  echo "<fieldset>";
  echo "<legend>Info</legend>";
echo "<dl>";
        echo "<dt style=width:40%;>Bultos línea</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $transporte['Transporte']['cantidad_embalaje'].'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Almacenado</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $almacenado.'&nbsp;';
echo "</dl>";  



   }

if ($action == 'edit') {
  //  $almacenado = $transporte['Transporte']['cantidad_embalaje'] - $almacenado;
  echo "<h2>Modificar Cuenta corriente almacén</h2>\n";
    echo "<fieldset>";
  echo "<legend>Info</legend>";
echo "<dl>";
        echo "<dt style=width:40%;>Bultos línea</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $transporte['Transporte']['cantidad_embalaje'].'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Almacenados</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $almacenado.'&nbsp;';
    echo "</dd>";
echo "</dl>";  

}
?>
<br>
<hr>
</fieldset>
<fieldset>
<legend>Datos</legend>
<?php
    ?>
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
      'label'=>'Ref. almacén'
      )
    );
    ?>
    </div>
    <?php
    echo $this->Form->input('cantidad_cuenta',array(
      'label'=>'Cantidad '.$transporte['Operacion']['Embalaje']['nombre']
      )
    );
    ?>
</fieldset>
  <br>
<fieldset>
    <?php
    echo $this->Form->input('peso_bruto',array(
      'label'=>'Peso bruto (Kg)'
      )
    );

		echo $this->Form->input('marca_almacen',array(
      'label'=>'Marca almacenada'
      )
    );
if ($action == 'edit') {
}
  echo $this->element('cancelarform');
	echo $this->Form->end('Guardar Cuenta Almacén');
	?> 
</fieldset>