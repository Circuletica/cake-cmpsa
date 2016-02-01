<?php
$this->Html->addCrumb('Operaciones','/operaciones');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'contratosMuestra' del contrato al javascript de la vista
//$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
//$this->Js->set('operacionesRetirada', $operacionesRetirada);
echo $this->Js->writeBuffer(array('onDomReady' => false));

if ($action == 'add') {
    echo "<h2>Añadir retirada de almacén</h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar retirada de almacén</h2>\n";
}
?>

<fieldset>
<?php

    echo $this->Form->create('Retirada');
    echo $this->Form->input('operacion_id',
        array(
          'label'=>'Ref. Operación',
          'autofocus' => 'autofocus',
          'onchange' => 'operacionesRetirada()',
          'value' => $operacion_id
        )
      );

    echo $this->Form->input('asociado_id',
         array(
              'label'=>'Asociado',
              'empty' =>array('' => 'Selecciona')
               )
         );  

    echo $this->Form->input('almacen_transporte_id',
       array(
              'label'=>'Cuenta Almacén',
              'empty' =>array('' => 'Selecciona')
               )
         );

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
<script type="text/javascript">
window.onload = operacionesRetirada();
</script>