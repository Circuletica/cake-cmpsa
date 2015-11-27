<?php
$class = $this->fetch('class');
//el controller se calcula por defecto a partir de la clase
$controller = Inflector::tableize($class);
//si no hay $object definido explicitamente en
//la vista padre, se calcula uno por defecto a partir
//de la clase
$object = $this->fetch('object');
if ($object == '') $object = Inflector::humanize(Inflector::singularize($controller));

if ($this->action == 'add') { echo "<h2>Añadir <em>".$class."</em></h2>\n"; }
if ($this->action == 'edit') { echo "<h2>Modificar <em>".$object."</em></h2>\n"; }

$this->Html->addCrumb(Inflector::pluralize($class), array( 'controller' => $controller, 'action' => 'index'));

echo $this->Form->create($class);
?>
	<fieldset>
<?php
echo $this->Form->input('Empresa.nombre_corto');
echo $this->Form->input('Empresa.nombre', array('label'=>'Denominacion legal'));
echo $this->Form->input('Empresa.direccion', array('label'=>'Dirección'));
?>
	<div class="columna2">
<?php
echo $this->Form->input('Empresa.cp', array('label'=>'Código Postal'));
echo $this->Form->input('Empresa.municipio');
?>
	    <div class="formuboton">
		<ul>
		    <li>
<?php
echo $this->Form->input('Empresa.pais_id', array('label'=>'País'));
?>
		    </li>
		    <li>
			<div class="enlinea">
<?php            
echo $this->Html->link('<i class="fa fa-plus"></i> Añadir País', array(
    'controller'=>'paises',
    'action'=>'add'
),array(
    "class"=>"botond",
    'escape' => false)
);
?>
			 </div>
		    </li>
		</ul>
	    </div>
<?php
echo $this->Form->input('Empresa.telefono', array('label'=>'Teléfono'));
?>
	</div>
<?php
echo $this->Form->input('Empresa.cif', array('label'=>'CIF'));
echo $this->Form->input('Empresa.codigo_contable', array('label'=>'Código Contable'));
echo $this->Form->input('Empresa.bic', array('label'=>'BIC'));
echo $this->Form->input('Empresa.cuenta_bancaria');
echo $this->Form->input('Empresa.website', array(
    'label'=>'Sitio web',
    'between'=>'http://'
));
echo $this->Form->end('Guardar '.$class);
?>
</fieldset>
