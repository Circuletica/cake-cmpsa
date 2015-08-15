<h2>Agregar Cuenta Corriente/Referencia almacén</h2>
<?php
$this->Html->addCrumb(['Transporte'], array(
'controller'=>'transporte',
'action'=>'view'
));
//$this->Html->addCrumb('Añadir Cuenta Corriente', array(
//'controller' => 'almacenestransportes',
//'action' => 'add')
//);
?>
<fieldset>
			<div class="formuboton">
			<ul>
				<li><?php
				echo $this->Form->input('almacen_id',array('label'=>'Nombre almacén'));
				?>
				</li>
				<li>
				<div class="enlinea">
						<?php            
						echo $this->Html->link('<i class="fa fa-plus"></i> Almacén', array(
						'controller'=>'almacenes',
						'action'=>'add'),array("class"=>"botond", 'escape' => false)
						);
						?>
				</div>
				</li>
			</ul>
			</div>
			<br><br>
		<?php
		echo $this->Form->input('cuenta_almacen',array('label'=>'Cuenta corriente / Referencia almacén'));
		echo $this->Form->input('cantidad_cuenta',array('label'=>'Cantidad embalajes en cuenta'));
		echo $this->Form->input('MarcaAlmacen.nombre',array('label'=>'Marca'));
		echo $this->Form->end('Guardar Cuenta Almacén');
	?> 
</fieldset>

