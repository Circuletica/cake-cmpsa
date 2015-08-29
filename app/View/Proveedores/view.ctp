<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Proveedores', array(
	'controller'=>'proveedores',
	'action'=>'index'
	));
	$this->Html->addCrumb($proveedor['Empresa']['nombre_corto'], array(
	'controller'=>'proveedores',
	'action'=>'view',
	$proveedor['Empresa']['id']
));
?>

<?php
if (empty($proveedor)):
	echo "No hay registro en esta lista";
else:
	echo "<div class='acciones'>\n";
	echo $this->Button->edit('proveedores',$proveedor['Proveedor']['id'])
		.' '.$this->Button->delete('proveedores',$proveedor['Proveedor']['id'],$proveedor['Empresa']['nombre_corto']);
	echo "</div>";
?>
	<h2>Detalles Proveedor <?php echo $proveedor['Empresa']['nombre_corto']?></h2>
	<?php

      //formateamos el número de cuenta de la entidad
      $numero_bruto=$proveedor['Empresa']['cuenta_bancaria'];
      $cuenta_entidad=substr($numero_bruto,0,4).
	      '-'.substr($numero_bruto,4,4).
	      '-'.substr($numero_bruto,8,2).
	      '-'.substr($numero_bruto,10,10);
      //formateamos el número de cuenta cliente
//      $numero_bruto=$bancoprueba['BancoPrueba']['cuenta_cliente_1'];
//      $cuenta_cliente=substr($numero_bruto,0,4).
//	      '-'.substr($numero_bruto,4,4).
//	      '-'.substr($numero_bruto,8,2).
//	      '-'.substr($numero_bruto,10,10);
	echo "<dl>";
	//echo "  <dt>Id</dt>\n";
	//echo "<dd>";
	//echo $proveedor['Proveedor']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre corto</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['nombre_corto'];
	echo "</dd>";
	echo "  <dt>Denominación legal</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['nombre'];
	echo "</dd>";
	echo "  <dt>Dirección</dt>\n";
	echo "<dd>";
	echo $proveedor['Empresa']['direccion'].' - '.
		$proveedor['Empresa']['cp'].' '.
		$proveedor['Empresa']['municipio'].' - '.
		$proveedor['Empresa']['Pais']['nombre'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Teléfono</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['telefono'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>CIF/NIF</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['cif'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Código contable</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['codigo_contable'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>BIC</dt>\n";
	echo "<dd>";
        echo $proveedor['Empresa']['bic'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Cuenta entidad</dt>\n";
	echo "<dd>";
        echo $cuenta_entidad.'&nbsp;';
	echo "</dd>";
	//echo "  <dt>Cuenta cliente</dt>\n";
	//echo "<dd>";
        //echo $bancoprueba['BancoPrueba']['cuenta_cliente_1'].'&nbsp;';
	//echo $cuenta_cliente.'&nbsp;';
	//echo "</dd>";
	//echo "  <dt>IBAN cliente</dt>\n";
	//echo "<dd>";
        //echo $iban_cliente.'&nbsp;';
	//echo "</dd>";
	//echo "  <dt>Cuenta cliente 2</dt>\n";
	//echo "<dd>";
        //echo $bancoprueba['BancoPrueba']['cuenta_cliente_2'].'&nbsp;';
	//echo "</dd>";
	echo '</dl>';?>
<div class="detallado">
	<h3>Contactos</h3>
	<table>
<?php
	echo $this->Html->tableHeaders(array('Nombre', 'Función',
	       'Teléfono 1', 'Teléfono 2', 'Email','Acciones'));
	foreach($proveedor['Empresa']['Contacto'] as $contacto):
	echo $this->Html->tableCells(array(
		$contacto['nombre'],
		$contacto['funcion'],
		$contacto['telefono1'],
		$contacto['telefono2'],
		$contacto['email'],
		$this->Html->link('<i class="fa fa-envelope-o"></i>', 'mailto:'.$contacto['email'],array(
			'class'=>'botond', 'escape'=>false,'target' => '_blank', 'title'=>'Enciar e-mail'))
		.' '.$this->Button->editLine('contactos',$contacto['id'],'proveedores',$contacto['empresa_id'])
			.' '.$this->Button->deleteLine('contactos',$contacto['id'],'proveedores',$contacto['empresa_id'],$contacto['nombre'])
		)
	);
	endforeach;
endif;
?>
	</table>
	<div class="btabla">
			<?php echo $this->Button->addLine('contactos','proveedores',$proveedor['Empresa']['id'],'contacto'); ?>
	</div>
</div>
