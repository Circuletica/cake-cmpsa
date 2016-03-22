<?php
$this->Html->addCrumb('Operaciones','/operaciones/index_trafico/');
$this->Html->addCrumb('Operación '.$operacion['Operacion']['referencia'], array(
    'controller'=>'operaciones',
    'action'=>'view_trafico',
    $operacion['Operacion']['id']
    )
);
//$this->Html->addCrumb('Transporte','/transporte/view/');

if ($action == 'add') {
    $transportado = $operacion['PesoOperacion']['cantidad_embalaje'] - $transportado;
    echo "<h2>Añadir Transporte a Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
    echo '<h4>Incoterm: '.$operacion['Contrato']['Incoterm']['nombre'].' / Bultos operación: '.$operacion['PesoOperacion']['cantidad_embalaje'].' en '.$embalaje.' / Bultos pendientes: '.$transportado.' en '.$embalaje.'</h4>';
}

if ($action == 'edit') {
    echo "<h2>Modificar Transporte de Operación <em>".$operacion['Operacion']['referencia']."</em></h2>\n";
    echo '<h4>Incoterm: '.$operacion['Contrato']['Incoterm']['nombre'].' / Bultos operación: '.$operacion['PesoOperacion']['cantidad_embalaje'].' en '.$embalaje.' / Transportados previamente: '.$transportado.'</h4>';
}

    //Formulario para rellenar transporte
    echo $this->Form->create('Transporte');
    ?>
    <br>
    <fieldset>
    <div class="col2"> 
        <?php
        echo $this->Form->input('nombre_vehiculo',
            array(
                'label' => 'Nombre del transporte',
                'autofocus' => 'autofocus'
                )
            );
        if ($operacion['Contrato']['Incoterm']['id'] !='3'){ //3 corresponde a IN STORE
        echo $this->Form->input('matricula',
            array('label' => 'BL/Matrícula'
                )
            );
        }  
         echo $this->Form->input('cantidad_embalaje',
            array('label' => 'Cantidad de '.$embalaje
                )
            );
         echo '<br>';   
        ?>
    </div>
    <div class="col2">   
       <?php
            echo $this->Form->input('puerto_carga_id',
                array('
                    label'=>'Puerto de embarque',
                    'empty' =>array('' => 'Sin Asignar')
                    )
                );
           echo $this->Form->input('puerto_destino_id',
                array('
                    label'=>'Puerto de destino',
                    'empty' =>array('' => 'Sin Asignar')
                    )
                );
        // id = 3 es el valor de IN STORE
        if ($operacion['Contrato']['Incoterm']['id'] !='3'){ //3 corresponde a IN STORE
            echo $this->Form->input('naviera_id',
                array(
                      'label'=>'Naviera',
                      'empty' =>array('' => 'Sin Asignar')
                ));  
        }
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

        <div class="linea">
            <?php
            echo $this->Form->input('fecha_carga', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Carga mercancía',
            'empty' => ' ')
            );
            echo $this->Form->input('fecha_prevista', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Fecha prevista llegada',
            'empty' => ' ')
            );
            echo $this->Form->input('fecha_llegada', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Fecha de llegada',
            'empty' => ' ')
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

            echo $this->Form->input('fecha_entradamerc', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y')-1,
            'maxYear' => date('Y')+2,
            'orderYear' => 'asc',
            'timeFormat' => null ,
            'label' => 'Entrada mercancía',
            'empty' => ' ')
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
            echo '<br>';           
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
                   echo '<br><br>';
            ?>
            
        </div>

</fieldset>
   <fieldset>    <!-- Seguro de la línea transporte -->

<?php
if ($operacion['Contrato']['Incoterm']['nombre'] == 'FOB'){
    ?>
    <legend>Seguro</legend>
     <div class="col2">    
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
    </div>
            <br>
     <div class="col3">              
            <?php

                   // echo $this->Form->input('coste_seguro',array('label'=>'Coste seguro'));
                    echo $this->Form->input('suplemento_seguro',array('label'=>'Suplemento'));
                    echo $this->Form->input('peso_neto',array('label'=>'Peso neto (Kg)'));
                    ?>
       </div>
          <legend>Reclamación</legend> 
          <br>
        <div class="col2">          
            <div class="linea">
            <?php
            echo $this->Form->input('fecha_reclamacion', array(
              'dateFormat' => 'DMY',
              'minYear' => date('Y')-1,
              'maxYear' => date('Y')+2,
              'orderYear' => 'asc',
              'timeFormat' => null ,
              'label' => 'Fecha reclamación seguro'
              )
            );
            ?>
            </div>  

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
        echo $this->Form->hidden('linea', array('value' =>$num));    
        echo $this->Html->Link('<i class="fa fa-times"></i> Cancelar', $this->request->referer(''), array('class' => 'botond', 'escape'=>false));
        echo $this->Form->end('Guardar Línea Transporte', array('escape'=>false));
        ?>
    </fieldset>