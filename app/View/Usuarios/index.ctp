<?php
$this->Html->addCrumb('Usuarios', '/Usuarios');
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
<h2>Usuarios</h2>
<?php
if(empty($usuarios)): ?>
No hay usuarios en esta lista
<?php else: ?>
<table class='tc5 tc6 tc7'>
<tr>
  <th>Nombre</th>
  <th>Función</th>
  <th>Teléfono1</th>
  <th>Teléfono2</th>
  <th>Email</th>
  <th>Departamento</th>
  <th>&nbspDetalle&nbsp</th>
</tr>
<?php foreach ($usuarios as $usuario): ?>
<tr>
  <td>
  <?php echo $usuario['Usuario']['nombre'] ?>
  </td>
  <td>
  <?php echo $usuario['Usuario']['funcion'] ?>
  </td>
  <td>
  <?php echo $usuario['Usuario']['telefono1'] ?>
  </td>
  <td>
  <?php echo $usuario['Usuario']['telefono2'] ?>
  </td>
  <td>
  <?php echo $this->Text->autoLinkEmails($usuario['Usuario']['email'])?>
  </td>
  <td>
  <?php echo $usuario['Departamento']['nombre'] ?>
  </td>
  <td>
<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
      array('action' => 'edit',$usuario['Usuario']['id']),array('class'=>'botond','escape'=>false, 'title'=>'Modificar')).' '.
      $this->Form->postLink('<i class="fa fa-trash"></i>',
		  array('action' => 'delete', $usuario['Usuario']['id']),
		  array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar', 'confirm' => 'Seguro que quieres borrar a '.$usuario['Usuario']['nombre'].'?'));
  ?>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<br>
  <div class="btabla">
      <?php
       echo $this->Html->link('<i class="fa fa-user-plus"></i> Añadir usuario',
        array(
       'action'=>'add'),
        array(
       'escape' => false,'title'=>'Añadir usuario'));?>
  </div>
