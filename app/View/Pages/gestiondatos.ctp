<?php $this->Html->addCrumb('Gestión de Datos', '/pages/gestiondatos');?>

<div class="printdet">
<?php
echo $this->element('desplegabledatos');
?>
</div>
<h2>Gestión de Datos</h2>
<table>
	<tr>
		<td><?php echo $this->Html->link('Agentes','/agentes',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Almacenes','/almacenes',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Aseguradoras','/aseguradoras',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Asociados','/asociados',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Bancos','/bancos',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Calidades','/calidades',array('class'=>'button'));?></td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link('Contactos','/contactos',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Contratos','/contratos',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Embalajes','/embalajes',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Incoterms','/incoterms',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('IVA','/tipoivas',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Muestras','/muestras',array('class'=>'button'));?></td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link('Navieras','/navieras',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Operaciones','/operaciones',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Paises','/paises',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Proveedores','/proveedores',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Puertos','/puertos',array('class'=>'button'));?></td>
		<td><?php echo $this->Html->link('Seguros','/seguros',array('class'=>'button'));?></td>
	</tr>
</table>
</div>
