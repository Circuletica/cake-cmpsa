<?php
	$this->extend('/Common/view');
	$this->assign('object', $this->fetch('object'));
	$this->assign('line_object', 'contacto');
	$this->assign('id',$empresa['Empresa']['id']);
	$this->assign('class',$this->fetch('class'));
	$this->assign('controller',$this->fetch('controller'));
	$this->assign('line_controller','contactos');

	$this->start('filter');
		//echo $this->element('filtroflete');
		echo 'Aquí va el filtro';
	$this->end();
	$this->start('main');
	echo "<dl>";
	//echo "  <dt>Nombre corto</dt>\n";
	//echo "<dd>";
        //echo $empresa['Empresa']['nombre_corto'];
	//echo "</dd>";
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
	if ($this->fetch('class') == 'Asociado'){
	echo "  <dt>Comisión</dt>\n";
	echo "<dd>";
        echo $comision.$this->Button->view('asociado_comisiones',$empresa['Empresa']['id']).'&nbsp;';
	echo "</dd>";
	}
	echo '</dl>';
	$this->end();
	$this->start('lines');
	echo "<table>";
	echo $this->Html->tableHeaders(array('Nombre', 'Función',
	   'Teléfono 1', 'Teléfono 2', 'Email','Detalle'));
	foreach($empresa['Empresa']['Contacto'] as $contacto):
		echo $this->Html->tableCells(array(
		    $contacto['nombre'],
		    $contacto['funcion'],
		    $contacto['telefono1'],
		    $contacto['telefono2'],
		    $contacto['email'],
		    $this->Html->link('<i class="fa fa-envelope-o"></i>', 'mailto:'.$contacto['email'],array(
			'class'=>'botond', 'escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'))
			.' '.$this->Button->editLine('contactos',$contacto['id'],'navieras',$contacto['empresa_id'])
			.' '.$this->Button->deleteLine('contactos',$contacto['id'],'navieras',$contacto['empresa_id'],$contacto['nombre'])
			)
		);
	endforeach;
	echo "</table>";
	$this->end();
?>
