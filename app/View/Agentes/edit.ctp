<h2>Modificar Agente</h2>
<?php
    $this->Html->addCrumb('Agentes', array(
	'controller'=>'agentes',
	'action'=>'index'
	)
    );
    $this->Html->addCrumb($empresa['Empresa']['nombre'], array(
	'controller'=>'agentes',
	'action'=>'view',
	$empresa['Empresa']['id']
	)
    );
    echo $this->Form->create('Agente', array('action' => 'edit'));
?>
<fieldset>
    <?php
	echo $this->Form->input('Empresa.nombre');
	echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
    ?>
    <div class="columna3">
	<?php
	    echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
	    echo $this->Form->input('Empresa.municipio');
	    echo $this->Form->input('Empresa.pais_id', array('label'=>'País'));
	    echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
	    echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
	?>
    </div>
    <?php
	echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
	echo $this->Form->input('BancoPrueba.bic', array('label'=>'BIC'));
	echo $this->Form->input('Empresa.cuenta_bancaria');
	echo $this->Form->input('BancoPrueba.bic', array('label'=>'BIC'));
	echo $this->Form->input('id',array('type'=>'hidden'));
	echo $this->Form->end('Guardar agente');
    ?>
</fieldset>
