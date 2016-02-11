<?php
$this->extend('/Common/view');
$this->assign('object', $this->fetch('object'));
$this->assign('line_object', 'contacto');
$this->assign('id',$empresa['Empresa']['id']);
$this->assign('class',$this->fetch('class'));
$this->assign('controller',$this->fetch('controller'));
$this->assign('line_controller','contactos');
$this->assign('line_add', '1');

$this->start('filter');
//echo $this->element('filtroflete');
echo 'Aquí va el filtro';
$this->end();

$this->start('main');
echo "<dl>";
echo "  <dt>Razón social</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['nombre'];
echo "</dd>";
echo "  <dt>Dirección</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['direccion'].' - '.
    $empresa['Empresa']['cp'].' '.
    $empresa['Empresa']['municipio'].' - '.
    $empresa['Empresa']['Pais']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <dt>Teléfono</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['telefono'].'&nbsp;';
echo "</dd>";
echo "  <dt>CIF</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['cif'].'&nbsp;';
echo "</dd>";
echo "  <dt>Código contable</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['codigo_contable'].'&nbsp;';
echo "</dd>";
echo "  <dt>BIC</dt>\n";
echo "<dd>";
echo $empresa['Empresa']['bic'].'&nbsp;';
echo "</dd>";
echo "  <dt>Cuenta bancaria</dt>\n";
echo "<dd>";
echo $iban_bancaria.'&nbsp;';
echo "</dd>";
echo "  <dt>Sitio web</dt>\n";
echo "<dd>";
echo '<a href="'.$empresa['Empresa']['website'].'">'.$empresa['Empresa']['website'].'</a>'
    .'&nbsp;';
echo "</dd>";
if ($this->fetch('class') == 'Asociado'){
    echo "  <dt>Comisión actual</dt>\n";
    echo "<dd>";
    echo $comision;
    echo "</dd>";
}
echo '</dl>';
$this->end();

$this->start('lines');
echo "<table>";
echo $this->Html->tableHeaders(array('Nombre', 'Departamento', 'Función',
    'Teléfono 1', 'Teléfono 2', 'Email','Detalle'));
foreach($empresa['Empresa']['Contacto'] as $contacto):
    echo $this->Html->tableCells(array(
	$contacto['nombre'],
	$contacto['Departamento']['nombre'],
	$contacto['funcion'],
	$contacto['telefono1'],
	$contacto['telefono2'],
	$contacto['email'],
	$this->Html->link('<i class="fa fa-envelope-o"></i>', 'mailto:'.$contacto['email'],array(
	    'class'=>'botond', 'escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'))
	    .' '.$this->Button->editLine('contactos',$contacto['id'],$this->fetch('controller'),$contacto['empresa_id'])
	    .' '.$this->Button->deleteLine('contactos',$contacto['id'],$this->fetch('controller'),$contacto['empresa_id'],$contacto['nombre'])
	)
    );
endforeach;
echo "</table>";
$this->end();

if ($this->fetch('class') == 'Asociado'):
    $this->assign('line2_object', 'comisión');
    $this->assign('line2_controller','asociado_comisiones');
    $this->start('lines2');
//la tabla con el historial de comisiones
    echo "<table>";
    echo $this->Html->tableHeaders(array(
    'válido desde','válido hasta','comisión',''));
    foreach ($comisiones as $comision):
	$fecha_inicio = $this->Date->format($comision['fecha_inicio']);
	$fecha_fin = $this->Date->format($comision['fecha_fin']);
	echo $this->Html->tableCells(array(
	$fecha_inicio,
	$fecha_fin,
	$comision['Comision']['valor'],
	$this->Button->editLine('asociado_comisiones',$comision['id'],'asociados',$comision['asociado_id'])
	.' '.$this->Button->deleteLine('asociado_comisiones',$comision['id'],'asociados',$comision['asociado_id'],$comision['Comision']['valor'])
	));
    endforeach;
    echo "</table>";
    $this->end();
endif;
?>
