<?php
$class = $this->fetch('class');
//no necesitamos definir el controller,
//se puede deducir de la clase.
//$controller = $this->fetch('controller');
$controller = Inflector::tableize($class);
//$this->Html->getCrumbs(' > ');
$this->Html->addCrumb(ucfirst($controller), array(
    'controller' => $controller,
    'action' => 'index')
); 

echo "<h2>".ucfirst($controller)."</h2>\n";
if (empty($empresas)):
    echo "No hay ".$controller." en esta lista";
else:
    echo "<table>\n";
echo $this->Html->tableHeaders(array(
     $this->Paginator->sort('Empresa.nombre_corto',$class),
    $this->Paginator->sort('Empresa.codigo_contable','Código contable'),
    'País',
    'Teléfono',
    'Detalle'));

foreach($empresas as $empresa):
    echo $this->Html->tableCells(array(
	$empresa['Empresa']['nombre_corto'],
	$empresa['Empresa']['codigo_contable'],
	$empresa['Pais']['nombre'],
	$empresa['Empresa']['telefono'],
	$this->Html->link('<i class="fa fa-info-circle"></i>',array('action'=>'view',$empresa[$class]['id']), array('class' =>'boton','escape' => false,'title'=>'Detalles' ))
    ));

endforeach;?>
	</table>
<?php
echo $this->Paginator->counter(
    array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
?>
<?php endif; ?>

