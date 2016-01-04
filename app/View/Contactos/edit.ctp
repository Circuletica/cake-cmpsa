<h2>Modificar contacto <?php echo $this->request->data['Contacto']['nombre'].' en '.$this->request->data['Empresa']['nombre']?></h2>
<?php
  $this->Html->addCrumb('Entidades','/'.$this->params['named']['from_controller']);
  $this->Html->addCrumb($this->request->data['Empresa']['nombre'], '/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
  $this->Html->addCrumb('Modificar Contacto ', '/contactos/edit/'.$this->request->data['Contacto']['id'].'/'.'from_controller:'.$this->params['named']['from_controller'].'/from_id:'.$this->params['named']['from_id']);
  //metemos la clase de empresa y el empresa_id para volver a la view()
  //de dicha empresa una vez enviado el formulario
  echo $this->Form->create('Contacto', array(
	  'url'=> array('action' => 'edit',
	  'from_controller'=>$this->params['named']['from_controller'],
	  'from_id'=>$this->params['named']['from_id']
  )));
    ?>
  <div class="col2">
  <?php
  echo $this->Form->input('nombre');
  echo $this->Form->input('funcion',array('label'=>'Función'));
  ?> 
  </div> 
  <div class="colu3">
  <?php
  echo $this->Form->input('telefono1',array('label'=>'  Teléfono Nº1'));
  echo $this->Form->input('telefono2',array('label'=>'Teléfono Nº2'));
  echo $this->Form->input('email', array('type' => 'email'));
  echo $this->Form->input('id',array('type'=>'hidden'));
        ?>
    </div>
    <?php
  echo $this->Form->end('Guardar contacto');
?>

