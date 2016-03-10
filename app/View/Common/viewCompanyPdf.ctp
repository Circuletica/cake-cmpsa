<?php
$this->extend('/Common/view');
$this->assign('object', $this->fetch('object'));
$this->assign('line_object', 'contacto');
$this->assign('id',$empresa['Empresa']['id']);
$this->assign('class',$this->fetch('class'));
$this->assign('controller',$this->fetch('controller'));
$this->assign('line_controller','contactos');
$this->assign('line_add', '1');

$this->start('main');
echo "<dl>";
echo "  <h4>Razón social</h4>\n";
echo $empresa['Empresa']['nombre'];
echo "</dd>";
echo "  <h4>Dirección</h4>\n";
echo $empresa['Empresa']['direccion'].' - '.
    $empresa['Empresa']['cp'].' '.
    $empresa['Empresa']['municipio'].' - '.
    $empresa['Empresa']['Pais']['nombre'].'&nbsp;';
echo "</dd>";
echo "  <h4>Teléfono</h4>\n";
echo $empresa['Empresa']['telefono'].'&nbsp;';
echo "</dd>";
echo "  <h4>CIF</h4>\n";
echo $empresa['Empresa']['cif'].'&nbsp;';
echo "</dd>";
echo "  <h4>Código contable</h4>\n";
echo $empresa['Empresa']['codigo_contable'].'&nbsp;';
echo "</dd>";
echo "  <h4>BIC</h4>\n";
echo $empresa['Empresa']['bic'].'&nbsp;';
echo "</dd>";
echo "  <h4>Cuenta bancaria</h4>\n";
echo $iban_bancaria.'&nbsp;';
echo "</dd>";
echo "  <h4>Sitio web</h4>\n";
echo '<a href="'.$empresa['Empresa']['website'].'">'.$empresa['Empresa']['website'].'</a>'
    .'&nbsp;';
echo "</dd>";
if ($this->fetch('class') == 'Asociado'){
    echo "  <h4>Comisión actual</h4>\n";
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
	isset($contacto['Departamento']['nombre']) ? $contacto['Departamento']['nombre'] : '',
	$contacto['funcion'],
	$contacto['telefono1'],
	$contacto['telefono2'],
	$this->Text->autoLinkEmails($contacto['email'])
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
