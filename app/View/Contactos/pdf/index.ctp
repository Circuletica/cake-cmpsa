<?php 
$this->Html->addCrumb('Contactos', '/Contactos');
?>
<div class="printdet">
<ul><li>
  <?php 
  echo $this->element('imprimirI');
  ?>
  </li>
  <li>
  <?php
  echo $this->element('desplegabledatos');
  ?>
  </li>
</ul>
</div>
<h2>Contactos</h2>
<?php
if(empty($contactos)): ?>
No hay contactos en esta lista
<?php else: ?>
<table>
<tr>
  <th>Nombre</th>
  <th>Función</th>
  <th>Teléfono1</th>
  <th>Teléfono2</th>
  <th>Email</th>
  <th>Empresa</th>
  <th>&nbspDetalle&nbsp</th>
</tr>
<?php foreach ($contactos as $contacto): ?>
<tr>
  <td>
  <?php echo $contacto['Contacto']['nombre'] ?>
  </td>
  <td>
  <?php echo $contacto['Contacto']['funcion'] ?>
  </td>
  <td>
  <?php echo $contacto['Contacto']['telefono1'] ?>
  </td>
  <td>
  <?php echo $contacto['Contacto']['telefono2'] ?>
  </td>
  <td>
  <?php echo $this->Text->autoLinkEmails($contacto['Contacto']['email'])?>
  </td>
  <td>
  <?php echo $contacto['Empresa']['nombre'] ?>
  </td>
  <td>
<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
      array('action' => 'edit',$contacto['Contacto']['id']),array('class'=>'botond','escape'=>false, 'title'=>'Modificar')).' '.
      $this->Form->postLink('<i class="fa fa-trash"></i>',
		  array('action' => 'delete', $contacto['Contacto']['id']),
		  array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar', 'confirm' => 'Seguro que quieres borrar a '.$contacto['Contacto']['nombre'].'?'));
  ?>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
  <div class="btabla">
      <?php
      // echo $this->Html->link('<i class="fa fa-user-plus"></i> Añadir contacto',
      //  array(
      // 'action'=>'add'),
      //  array(
      // 'escape' => false,'title'=>'Añadir contacto'));?>
  </div>
