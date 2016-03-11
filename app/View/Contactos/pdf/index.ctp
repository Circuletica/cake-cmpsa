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

</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

