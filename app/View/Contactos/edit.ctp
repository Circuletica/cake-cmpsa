<h2>Modificar contacto <?php echo $this->request->data['Contacto']['nombre'].' en '.$this->request->data['Empresa']['nombre']?></h2>
<?php
  $this->Html->addCrumb('Entidades','/'.$this->params['named']['from']);
  $this->Html->addCrumb($this->request->data['Empresa']['nombre'], '/'.$this->params['named']['from'].'/view/'.$this->params['named']['from_id']);
  $this->Html->addCrumb('Modificar Contacto ', '/contactos/edit/'.$this->request->data['Contacto']['id'].'/'.'from:'.$this->params['named']['from'].'/from_id:'.$this->params['named']['from_id']);
  //debug($this->params['named']);
  //echo "<pre>";
  //print_r($this->request->data);
  //echo "</pre>";
  //metemos la clase de empresa y el empresa_id para volver a la view()
  //de dicha empresa una vez enviado el formulario
  echo $this->Form->create('Contacto', array(
	  'url'=> array('action' => 'edit',
	  'from'=>$this->params['named']['from'],
	  'from_id'=>$this->params['named']['from_id']
  )));
    ?>

  <fieldset>
  <div class="columna2">
  <?php
  echo $this->Form->input('nombre');
  echo $this->Form->input('funcion',array('label'=>'Función'));
  ?> 
  </div> 
  <div class="columna3">
  <?php
  echo $this->Form->input('telefono1',array('label'=>'  Teléfono Nº1'));
  echo $this->Form->input('telefono2',array('label'=>'Teléfono Nº2'));
  echo $this->Form->input('email', array('type' => 'email'));
  //echo 'Empresa';
  //echo $this->Form->select('pais_id', array($paises,
//	  'label' => 'País'));
  //echo $this->Form->select('empresa_id', $empresas);
  echo $this->Form->input('id',array('type'=>'hidden'));
        ?>
    </div>
    <?php
  echo $this->Form->end('Guardar contacto');
?></fieldset>

