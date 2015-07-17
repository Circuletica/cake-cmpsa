<h2>Modificar Asociado</h2>
<?php
    $this->Html->addCrumb('Asociados', array(
	'controller'=>'asociados',
	'action'=>'index'
	)
    );
    $this->Html->addCrumb($empresa['Empresa']['nombre'], array(
	'controller'=>'asociados',
	'action'=>'view',
	$empresa['Empresa']['id']
	)
    );
    echo $this->Form->create('Asociado', array('action' => 'edit'));
?>
<fieldset>
    <?php
	echo $this->Form->input('Empresa.nombre_corto');
	echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal'));
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
    ?>
    <div class="columna3">
	<?php
	    echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	    echo $this->Form->input('Empresa.municipio');
	    ?>
	<div class="formuboton">
		<ul>
		   	<li><?php
	    echo $this->Form->input('Empresa.pais_id', array('label'=>'País'));
	    ?>
			</li>
			<li>
			<div class="enlinea">
				<?php            
				echo $this->Html->link('<i class="fa fa-plus"></i> Añadir País', array(
						'controller'=>'paises',
						'action'=>'add'),
						array("class"=>"botond", 'escape' => false)
						);
						 ?>
			 </div>
			</li>
   		</ul>
	</div>
	<?php
	echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
	echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
	echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
		?></div>
	<div class="columna2"><?php
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('BancoPrueba.bic', array('label'=>'BIC'));
	?>
    </div>
    <?php
	echo $this->Form->input('id',array('type'=>'hidden'));
	echo $this->Form->end('Guardar asociado');
    ?>
</fieldset>