<?php $this->Html->addCrumb('Gestión de Datos', '/pages/gestiondatos');?>

<div class="printdet">
<?php
echo $this->element('desplegabledatos');
?>
</div>
<h2>Gestión de Datos</h2>
<table>
	<tr>
		<td><?php echo $this->Html->link('Agentes','/agentes',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Almacenes','/almacenes',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Aseguradoras','/aseguradoras',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Asociados','/asociados',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Bancos','/bancos',array('class'=>'boton'));?></td>

	</tr>
	<tr>
		<td><?php echo $this->Html->link('Calidades','/calidades',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Comisiones','/admin/comisiones',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Embalajes','/admin/embalajes',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Incoterms','/incoterms',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('IVA','/tipo_ivas',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Usuarios','/usuarios',array('class'=>'boton'));?></td>		
	</tr>
	<tr>
		<td><?php echo $this->Html->link('Navieras','/navieras',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Paises','/paises',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Proveedores','/proveedores',array('class'=>'boton'));?></td>
		<td><?php echo $this->Html->link('Puertos','/puertos',array('class'=>'boton'));?></td>
	</tr>
</table>
</div>
