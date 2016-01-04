<?php
$this->Html->addCrumb('Operaciones','/operaciones');
//$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

if ($action == 'add') {
    echo "<h2>Añadir retirada de almacén <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar retirada de almacnén <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}
?>

<fieldset>
<?php
    echo $this->Form->create('Retirada');
    echo $this->Form->input('asociado_id',
         array(
              'label'=>'Nombre asociado',
              'empty' =>array('' => 'Selecciona')
               ));  
       ?>
    <div class="linea">
    <?php
    echo $this->Form->input('fecha_retirada',array(
       'dateFormat' => 'DMY',
        'minYear' => date('Y')-1,
        'maxYear' => date('Y')+2,
        'orderYear' => 'asc',
        'timeFormat' => null ,
        'label' => 'Fecha retirada',
        'empty' => ' ')
        );
        ?>
    </div>


<?php
   echo $this->Form->input('embalaje_retirado');
   echo $this->Form->input('peso_retirado');
   echo $this->Form->end('Guardar Retirada');
?>
</fieldset>