<h2>Contactos</h2>
<?php 
$this->Html->addCrumb('Contactos', '/Contactos');
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
  <?php echo $contacto['Contacto']['email'] ?>
  </td>
  <td>
  <?php echo $contacto['Empresa']['nombre'] ?>
  </td>
  <td>
<?php echo $this->Html->link('Editar', array('action' => 'edit',$contacto['Contacto']['id'])).' '.
           $this->Form->postLink('Borrar',
		     array('action' => 'delete', $contacto['Contacto']['id']),
		     array('confirm' => 'Seguro que quieres borrar a '.$contacto['Contacto']['nombre'].'?'))
  ?>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<br>
<?php echo $this->Html->link('Añadir contacto', array('action'=>'add')); ?>
