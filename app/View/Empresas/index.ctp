<h2>Empresas</h2>
<?php if(empty($empresas)): ?>
No hay empresas en esta lista
<?php else: ?>
<table>
<tr>
  <th>Nombre</th>
  <th>Teléfono</th>
  <th>Dirección</th>
  <th>País</th>
</tr>
<?php foreach ($empresas as $empresa): ?>
<tr>
  <td>
  <?php echo $empresa['Empresa']['nombre'] ?>
  </td>
  <td>
  <?php echo $empresa['Empresa']['telefono'] ?>
  </td>
  <td>
  <?php echo $empresa['Empresa']['direccion'] ?>
  </td>
  <td>
  <?php echo $empresa['Pais']['nombre'] ?>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<br>
<?php echo $this->Html->link('Añadir empresa', array('action'=>'add')); ?>
