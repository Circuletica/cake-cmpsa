<?php $this->Html->addCrumb('Gestión de Datos', '/pages/gestiondatos');?>

<div class="acciones">
<?php
echo $this->element('desplegabledatos');
?>
</div>
<h2>Gestión de Datos</h2>
<table>
	<tr><td><?php echo $this->Html->link('Bancos','/banco_pruebas',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Muestras','/muestras',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Proveedores','/proveedores',array('class'=>'button'));?></td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link('Línea de Muestra','/linea_muestras',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Paises','/paises',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Almacenes','/almacenes',array('class'=>'button'));?></td>
	</tr>
	<tr><td><?php echo $this->Html->link('Calidades','/calidades',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Asociados','/asociados',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Agentes','/agentes',array('class'=>'button'));?></td>
	</tr>
		<td><?php echo $this->Html->link('Navieras','/navieras',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Contactos','/contactos',array('class'=>'button'));?></td>
		<td></td>
	</tr>
	
	
</table>
</div>
