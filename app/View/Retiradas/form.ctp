<?php
$this->Html->addCrumb('Operaciones','/operaciones');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'contratosMuestra' del contrato al javascript de la vista
//$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
//$this->Js->set('operacionesRetirada', $operacionesRetirada);
echo $this->Js->writeBuffer(array('onDomReady' => false));

if ($action == 'add') {
    echo "<h2>Añadir retirada de asociado</h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar retirada de asociado</h2>\n";
}
?>

<fieldset>
<?php

    echo $this->Form->create('Retirada');
       ?>
        <div class="linea">
    <?php
    echo $this->Form->input('fecha_retirada',array(
       'dateFormat' => 'DMY',
        'minYear' => date('Y')-1,
        'maxYear' => date('Y'),
        'orderYear' => 'asc',
        'timeFormat' => null ,
        'label' => 'Fecha retirada',
        'autofocus' => 'autofocus'
        )
    );
    
        ?>
    </div>
    <div class="col3">
<?php

    echo $this->Form->input('operacion_id',
        array(
          'label'=>'Ref. Operación',
          'onchange' => 'operacionesRetirada()',
          'value' => $operacion_id,
          //si se sabe la operacion, se deshabilita
          'disabled' => $operacion_id != NULL
        )
      );

    echo $this->Form->input('asociado_id',
         array(
              'label'=>'Asociado',
              'empty' =>array('' => 'Selecciona'),
              'class' => 'ui-widget',
              'id' => 'combobox',              
               )
         );  

    echo $this->Form->input('almacen_transporte_id',
       array(
              'label'=>'Cuenta Almacén',
              'empty' =>array('' => 'Selecciona')
               )
         );
?>
      </div>
   <div class="col2">
<?php
   echo $this->Form->input('embalaje_retirado',
         array(
              'label'=>'Sacos retirados'
              )
         );
   echo $this->Form->input('peso_retirado');
?>
    </div>
<?php
   echo $this->Form->end('Guardar Retirada');
?>

</fieldset>
<script type="text/javascript">
window.onload = operacionesRetirada();
</script>