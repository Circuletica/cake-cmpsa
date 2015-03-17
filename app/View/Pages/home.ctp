<h2>Bienvenido al programa de gestión de Comercial de Materias Primas S.A.</h2>

<tr>
<td>
<?php echo $this->Html->link('Bancos','/banco_pruebas',array('class'=>'button'));?>
</td>
<td>
 <?php  echo $this->Html->link('Proveedores','/proveedores',array('class'=>'button'));?>
</td>
<td>
  <?php echo $this->Html->link('Asociados','/asociados',array('class'=>'button'));?>
</td>
<td>
  <?php echo $this->Html->link('Navieras','/navieras',array('class'=>'button'));?>
</td>
<td>
  <?php echo $this->Html->link('Agentes','/agentes',array('class'=>'button'));?>
</td>
<td>
  <?php echo $this->Html->link('Almacenes','/almacenes',array('class'=>'button'));?>
</td>
<td>
  <?php echo $this->Html->link('Paises','/paises',array('class'=>'button'));?>
</td>
</tr>
<br>
<div class="actions">
<?php 
echo $this->element('desplegabledatos');
?>
</div>