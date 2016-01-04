<?php
$this->Html->addCrumb('Operaciones','/operaciones');
//$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);

if ($action == 'add') {
    echo "<h2>Añadir retirada de almacén <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}

if ($action == 'edit') {
    echo "<h2>Modificar retirada de almacnén <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
}
/*
echo "<dl>";
echo "  <dt>Operación</dt>\n";
echo "  <dd>".$referencia.'&nbsp;'."</dd>";
echo "  <dt>Calidad</dt>\n";
echo "  <dd>".$calidad.'&nbsp;'."</dd>";
echo "  <dt>Proveedor</dt>\n";
echo "<dd>";
echo $this->html->link($proveedor, array(
    'controller' => 'proveedores',
    'action' => 'view',
    $proveedor_id)
);
echo "</dd>";
echo "  <dt>Condición</dt>\n";
echo "<dd>".$condicion.'&nbsp;'."</dd>";
echo "</dl>";
echo $this->Form->create('Financiacion');
echo $this->Form->hidden('id', array(
    'value' => $operacion['Operacion']['id']
)
    );
echo "<div class='linea'>\n";
echo $this->Form->input('fecha_vencimiento', array(
    'label' => 'Fecha de vencimiento',
    'dateFormat' => 'DMY'
)
);
echo "</div>\n";*/
//solo si es una financiacion nueva, asignamos valores por defecto
//si es un edit, hay que respetar los valores existentes
//if ($action == 'add') {
?>
<fieldset>
<?php
    echo $this->Form->input('asociado_id',
         array(
              'label'=>'Nombre asociado',
              'empty' =>array('' => 'Selecciona')
               ));  
    echo $this->Form->input('tipo_iva_id', array( 'value' => 3));
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
    echo $this->Form->end('Guardar Retirada');
?>
</fieldset>