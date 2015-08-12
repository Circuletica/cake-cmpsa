

  <?php echo $this->Form->create('Muestra', array('action'=>'filtroListado'));?>
  <?php
    echo $this->Form->input('Search.referencia');
    echo $this->Form->input('Search.fecha', array('after'=>'aaaa o mm-aaaa'));
    echo $this->Form->input('Search.contrato.referencia', array(
      'label' => 'Referencia contrato',
      'empty' => true));
    //echo $this->Form->input('Search.calidad_id');
    echo $this->Form->input('Search.calidad_id', array(
      'label' => 'Calidad',
      'empty' => true));
    echo $this->Form->input('Search.matricula', array(
      'label' => 'BL/Matrícula',
      'empty' => true));
     echo $this->Form->input('Search.almacen.cuenta_corriente_almacen');
    //  echo $this->Form->input('Search.aprobado', array(
    //    'empty'=>__('Cualquiera', true),
    //    'options'=>array(
    //      0=>__('Rechazado',true),
    //      1=>__('Aprobado',true)
    //      )
    //    ));
  ?>
  <div class="formuboton">
    <ul>
      <li><?php
  if(isset($this->request->data['Search']['tipo_id'])){
    echo $this->Html->Link('Resetear filtro',array(
      'action'=>'index',
      'Search.tipo_id'=>$this->request->data['Search']['tipo_id'])
    );
  } else {
    echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array('action'=>'index'), array('escape'=>false));
  }
  ?>
      </li>
      <li style="margin: 0">
  <?php           
    echo $this->Form->end('Buscar');
  ?>
      </li>
    </ul>
  </div>
