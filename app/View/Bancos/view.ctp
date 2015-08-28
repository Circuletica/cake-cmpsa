	<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', array(
	'controller'=>'bancos',
	'action'=>'index'
	));
	$this->Html->addCrumb($banco['Empresa']['nombre_corto'], array(
	'controller'=>'bancos',
	'action'=>'view',
	$banco['Empresa']['id']
));
if (empty($banco)):
	echo "No hay bancos en esta lista";
else:
	echo "<div class='acciones'>\n";
	echo $this->Button->edit('bancos',$banco['Banco']['id'])
	.' '.$this->Button->delete('bancos',$banco['Banco']['id'],$banco['Empresa']['nombre_corto']);
?>
</div>
<h2>Detalles Banco <?php echo $banco['Empresa']['nombre_corto']?></h2>
<?php
      //formateamos el número de cuenta de la entidad
      $numero_bruto=$banco['Empresa']['cuenta_bancaria'];
      $cuenta_entidad=substr($numero_bruto,0,4).
	      '-'.substr($numero_bruto,4,4).
	      '-'.substr($numero_bruto,8,2).
	      '-'.substr($numero_bruto,10,10);
      //formateamos el número de cuenta cliente
      $numero_bruto=$banco['Banco']['cuenta_cliente_1'];
      $cuenta_cliente=substr($numero_bruto,0,4).
	      '-'.substr($numero_bruto,4,4).
	      '-'.substr($numero_bruto,8,2).
	      '-'.substr($numero_bruto,10,10);
	//echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $banco['Banco']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre Corto</dt>\n";
	echo "<dd>";
        echo $banco['Empresa']['nombre_corto'];
	echo "</dd>";
	echo "  <dt>Denominación legal</dt>\n";
	echo "<dd>";
        echo $banco['Empresa']['nombre'];
	echo "</dd>";
	echo "  <dt>Dirección</dt>\n";
	echo "<dd>";
	//si el id de país no esta definido no intentar mostrar el nombre
	$pais = $banco['Empresa']['Pais'] ? $banco['Empresa']['Pais']['nombre'] : '';
	echo $banco['Empresa']['direccion'].' - '.
		$banco['Empresa']['cp'].' '.
		$banco['Empresa']['municipio'].' - '.
		$pais.
		'&nbsp;';
	echo "</dd>";
	echo "  <dt>Teléfono</dt>\n";
	echo "<dd>";
        echo $banco['Empresa']['telefono'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>CIF</dt>\n";
	echo "<dd>";
        echo $banco['Empresa']['cif'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Código contable</dt>\n";
	echo "<dd>";
        echo $banco['Empresa']['codigo_contable'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>BIC</dt>\n";
	echo "<dd>";
        echo $banco['Banco']['bic'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Cuenta entidad</dt>\n";
	echo "<dd>";
        echo $cuenta_entidad.'&nbsp;';
	echo "</dd>";
	echo "  <dt>Cuenta cliente</dt>\n";
	echo "<dd>";
        //echo $banco['Banco']['cuenta_cliente_1'].'&nbsp;';
	echo $cuenta_cliente.'&nbsp;';
	echo "</dd>";
	echo "  <dt>IBAN cliente</dt>\n";
	echo "<dd>";
        echo $iban_cliente.'&nbsp;';
	echo "</dd>";
	//echo "  <dt>Cuenta cliente 2</dt>\n";
	//echo "<dd>";
        //echo $banco['Banco']['cuenta_cliente_2'].'&nbsp;';
	//echo "</dd>";
	echo '</dl>';?>
	<div class="detallado">
	<h3>Contactos</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Nombre', 'Función',
	       'Teléfono Nº1', 'Teléfono Nº2', 'E-mail','Acciones'));
	foreach($banco['Empresa']['Contacto'] as $contacto):
	echo $this->Html->tableCells(array(
		$contacto['nombre'],
		$contacto['funcion'],
		$contacto['telefono1'],
		$contacto['telefono2'],
		$contacto['email'],
		$this->Html->link('<i class="fa fa-envelope-o"></i>', 'mailto:'.$contacto['email'],array(
			'class'=>'botond', 'escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'))
			.' '.$this->Button->edit('contactos',$contacto['id'],'bancos',$contacto['empresa_id'])
			.' '.$this->Button->delete('contactos',$contacto['id'],'bancos',$contacto['empresa_id'],$contacto['nombre'])
	));
	endforeach;
endif;
?>
</table>
	<div class="btabla">
<?php echo $this->Button->addLine('contactos','bancos',$banco['Empresa']['id'],'contacto');?>
	</div>
</div>

