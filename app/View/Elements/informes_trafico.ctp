<?php
   echo '<br><br>';
    echo '<h3>Informes</h3>';
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Despachos',
      array(
          'action' =>'index',
          'controller' => 'transportes'
          ),
        array(
          'escape'=>false,
          'title'=>'Informe de situación de embarques sin despachar'
          )
        );       
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Embarques',
      array(
          'action' =>'embarque',
          'controller' => 'transportes'
          ),
        array(
          'escape'=>false,
          'title'=>'Informe de situación de embarques'
          )
        );
    
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Supl. sin reclamación',
      array(
        'action' =>'suplemento',
        'controller' => 'transportes'
        ),
      array(
        'escape'=>false,
        'title'=>'Informe de operaciones con suplemento sin reclamación'
      )
    );
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Pedientes de adjudicar',
      array(
        'action' =>'pendiente',
        'controller' => 'transportes'
        ),
      array(
        'escape'=>false,
        'title'=>'Informe de sacos pendientes de adjudicar'
      )
    );
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Sin reclamación pendientes',
      array(
        'action' =>'reclamacion_factura',
        'controller' => 'transportes'
        ),
      array(
        'escape'=>false,
        'title'=>'Informe de operaciones sin reclamacion pendientes de facturar'
      )
    );
    echo  $this->Html->link('<i class="fa fa-info fa-lg"></i> Prórrogas pendientes',
      array(
        'action' =>'prorrogas_pendientes',
        'controller' => 'transportes'
        ),
      array(
        'escape'=>false,
        'title'=>'Informe de prórrogas pendientes'
      )
    );    

    /*echo $this->Html->link('<i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Descargar a CSV',
      array(
        'controller'=>'operaciones',
        'action'=>'export'
        ),
      array(
        'target'=>'_blank',
        'escape'=>false,
        'title'=>'Descargar la información a un archivo CSV'
      )
    ); */
?>
