<?php
$this->Html->addCrumb('Operaciones','/operaciones/index_trafico/');
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
    'controller'=>'operaciones',
    'action'=>'view_trafico',
    $operacion['Operacion']['id']
    )
);
//$this->Html->addCrumb('Transporte','/transporte/view/');

$mostrar = ($operacion['Contrato']['Incoterm']['nombre'] =='IN STORE') || ($operacion['Contrato']['Incoterm']['nombre'] =='IN STORE DESPACHADO');
  echo $this->Form->create('Transporte');
if ($action == 'add') {

    $transportado = $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado;
    echo "<h2>Añadir Transporte a Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
echo "<fieldset>";
echo "<legend>Info</legend>";
  
 echo "<dl>";
        echo "<dt style=width:40%;>Incoterm</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['Contrato']['Incoterm']['nombre'].'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Precio</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['PrecioTotalOperacion']['precio_euro_kilo_total'].' €/Kg &nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Bultos operación</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['PesoOperacion']['cantidad_embalaje'].' en '.$embalaje.'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Bultos pendientes</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $transportado.' en '.$embalaje.'&nbsp;';
    echo "</dd>";  
echo "</dl>";  


}

if ($action == 'edit') {
    echo "<h2>Modificar Transporte de Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
  echo "<fieldset>";
  echo "<legend>Info</legend>"; 
 
  echo "<dl>";
        echo "<dt style=width:40%;>Incoterm</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['Contrato']['Incoterm']['nombre'].'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Precio</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['PrecioTotalOperacion']['precio_euro_kilo_total'].' €/Kg &nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Bultos operación</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $operacion['PesoOperacion']['cantidad_embalaje'].' en '.$embalaje.'&nbsp;';
    echo "</dd>";
        echo "<dt style=width:40%;>Transportados</dt>\n";
    echo "<dd style=margin-left:40%;>";
        echo $transportado.'&nbsp;';
    echo "</dd>";  
echo "</dl>";

}

    //Formulario para rellenar transporte
  
    ?>
    <br>
    <hr>
    <br>
    <legend>Datos</legend>

    <div class="col2"> 
        <?php
        echo $this->Form->input('linea',
            array(
                'label' => 'Número de línea',
                //'autofocus' => 'autofocus',
                'value'=>$num
                )
            ); 

        echo $this->Form->input('nombre_vehiculo',
            array(
                'label' => 'Nombre transporte',
                'autofocus' => 'autofocus'
                )
            );
        echo $this->Form->input('matricula',
            array(
                'label' => 'BL/Matrícula',
                'disabled'=> $mostrar
                )
            );
         echo $this->Form->input('cantidad_embalaje',
            array('label' => 'Cantidad '.$embalaje
                )
            );
        ?>
    </div>
        <div class="col2">   
       <?php
            echo $this->Form->input('puerto_carga_id',
                array('
                    label'=>'Puerto de embarque',
                    'empty' =>array('' => 'Sin Asignar'),
                'disabled'=> $mostrar
                    )
                );
           echo $this->Form->input('puerto_destino_id',
                array('
                    label'=>'Puerto de destino',
                    'empty' =>array('' => 'Sin Asignar')
                    )
                );
            echo $this->Form->input('naviera_id',
                array(
                      'label'=>'Naviera',
                      'empty' =>array('' => 'Sin Asignar'),
                      'disabled'=> $mostrar
                ));  
            echo $this->Form->input('agente_id',
                array(
                    'label'=>'Agente aduanas',
                    'empty' =>array('' => 'Sin Asignar')
                ));
        ?>
    </div>
</fieldset>
<fieldset>   
    <legend>Fechas</legend>

        <div class="linea" style="margin-left: 18%">
            <?php
            echo $this->Form->input('fecha_carga',
                array(
                'dateFormat' => 'DMY',
                'minYear' => date('Y')-1,
                'maxYear' => date('Y')+2,
                'orderYear' => 'asc',
                'timeFormat' => null ,
                'label' => 'Carga mercancía',
                'empty' => ' ',
                'disabled'=> $mostrar
                )
            );
            echo $this->Form->input('fecha_prevista', 
                array(
                'dateFormat' => 'DMY',
                'minYear' => date('Y')-1,
                'maxYear' => date('Y')+2,
                'orderYear' => 'asc',
                'timeFormat' => null ,
                'label' => 'Fecha prevista llegada',
                'empty' => ' '
              )
            );
            echo $this->Form->input('fecha_llegada',
                array(
                'dateFormat' => 'DMY',
                'minYear' => date('Y')-1,
                'maxYear' => date('Y')+2,
                'orderYear' => 'asc',
                'timeFormat' => null ,
                'label' => 'Fecha de llegada',
                'empty' => ' ',
                'disabled'=> $mostrar
                    )
            );
            echo $this->Form->input('fecha_pago', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Pago',
            'empty' => ' ')
            );     
            echo $this->Form->input('fecha_enviodoc', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Envío documentación',
            'empty' => ' ')
            );
            echo $this->Form->input('fecha_entradamerc',
                array(
                'dateFormat' => 'DMY',
                'minYear' => date('Y')-1,
                'maxYear' => date('Y')+2,
                'orderYear' => 'asc',
                'timeFormat' => null ,
                'label' => 'Entrada mercancía',
                'empty' => ' ',
                'disabled'=> $mostrar
                )
            );
            echo $this->Form->input('fecha_despacho_op', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Despacho operación',
            'empty' => ' ')
            );
            //echo '<br>';           
        if ($operacion['Contrato']['Incoterm']['nombre'] !='FOB'){
            echo $this->Form->input('fecha_limite_retirada', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Límite de retirada',
            'empty' => ' ')
            );
            echo $this->Form->input('fecha_reclamacion_factura', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Reclamación factura',
            'empty' => ' ')
            );
        }
            ?>
            
        </div>
</fieldset>
<fieldset>    <!-- Seguro de la línea transporte -->

<?php
if ($operacion['Contrato']['Incoterm']['nombre'] == 'FOB'){
    ?>
     <legend>Seguro</legend>
          <?php
                        echo $this->Form->input('aseguradora_id',
                            array(
                            'label'=>'Aseguradora',
                            'empty' =>array('' => 'Sin Asignar')
                            )
                        );
               
                        ?>
                  
            <div class="linea">
            <?php
            echo $this->Form->input('fecha_seguro', array(
                'dateFormat' => 'DMY',
                'minYear' => date('Y')-1,
                'maxYear' => date('Y')+2,
                'orderYear' => 'asc',
                'timeFormat' => null ,
                'label' => 'Fecha del seguro',
                'empty' => ' ')
                );
            ?>
            </div>
            
     <div class="col2">              
            <?php

                   // echo $this->Form->input('coste_seguro',array('label'=>'Coste seguro'));
                    echo $this->Form->input('suplemento_seguro',array('label'=>'Suplemento'));
                    echo $this->Form->input('peso_neto',array('label'=>'Peso neto (Kg)'));
                    ?>
       </div>
       <hr>
       <br>
          <legend>Reclamación</legend> 
          <br>
              
            <div class="linea">
            <?php
            echo $this->Form->input('fecha_reclamacion', array(
              'dateFormat' => 'DMY',
              'minYear' => date('Y')-1,
              'maxYear' => date('Y')+2,
              'orderYear' => 'asc',
              'timeFormat' => null ,
              'label' => 'Fecha reclamación seguro',
              'empty' => ' '
              )
            );
            ?>
            </div>  
 <div class="col2">   
        <?php
        echo $this->Form->input('peritacion',array(
            'label'=>'Peritación (€)'
            )
        );        
        echo $this->Form->input('averia',array(
            'label'=>'Avería (Kg)'
            )
        );
    ?></div>
   
    <?php
}    
        echo $this->Form->input('peso_factura',array(
            'label'=>'Peso facturado (Kg)'
            )
        );

        echo $this->Form->input('observaciones', array('label'=>'Observaciones')); 
        //Agregamos el número de línea que le corresponde     
        //echo $this->Form->hidden('linea', array('value' =>$num));  
        echo $this->element('cancelarform');
        echo $this->Form->end('Guardar Línea Transporte', array('escape'=>false));
        ?>
    </fieldset>