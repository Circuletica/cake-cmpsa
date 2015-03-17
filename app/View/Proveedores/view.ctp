<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Proveedores', array(
	'controller'=>'proveedores',
	'action'=>'index'
	));
	$this->Html->addCrumb($proveedor['Empresa']['nombre'], array(
	'controller'=>'proveedores',
	'action'=>'view',
	$proveedor['Empresa']['id']
));
?>
<div class="index">
<h2>Detalles Proveedor <?php echo $proveedor['Empresa']['nombre']?></h2>
</div>
<?php
if (empty($proveedor)):
	echo "No hay proveedores en esta lista";
else:
	//echo "<pre>";
	//print_r($bancoprueba);
	////print_r($bancoprueba['Empresa']['Contacto']);
	//echo "</pre>";

	echo "<div class='actions'>\n";
      echo $this->Html->link('Modificar',array('action'=>'edit',$proveedor['Proveedor']['id']));
      //echo '&nbsp;';
      echo "\n";
      echo '<p>';
      echo $this->Form->postLink('Borrar',array('action'=>'delete',$proveedor['Proveedor']['id']),array('confirm'=>'Realmente quiere borrar '.$proveedor['Empresa']['nombre'].'?'));
      echo "\n";
      echo '<p>';
      //pasamos también de qué clase de entidad venimos, para luego volver a esta vista
	echo $this->Html->link('Añadir contacto',array(
		'controller'=>'contactos',
		'action'=>'add',
		'from'=>'proveedores',
		'from_id' => $proveedor['Empresa']['id']));
	echo "\n";
	echo "</div>\n";
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
	echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $proveedor['Proveedor']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre</dt>\n";
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
	//echo "</dd>";
	//echo "  <dt>BIC</dt>\n";
	//echo "<dd>";
        //echo $proveedor['BancoPrueba']['bic'].'&nbsp;';
	//echo "</dd>";
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
	echo '</dl>';
	echo "<hr>\n";
	echo "<p>\n";
	echo "<h3>Contactos</h3>";
	//echo "<pre>";
	//print_r($bancoprueba['Empresa']['Contacto']);
	//echo "</pre>";
	echo "<table>\n";
	echo $this->Html->tableHeaders(array('Nombre', 'Función',
	       'Teléfono 1', 'Teléfono 2', 'Email',''));
	//echo $this->Html->tableCells($bancoprueba['Empresa']['Contacto']);
	foreach($proveedor['Empresa']['Contacto'] as $contacto):
	echo $this->Html->tableCells(array(
		$contacto['nombre'],
		$contacto['funcion'],
		$contacto['telefono1'],
		$contacto['telefono2'],
		$contacto['email'],
		$this->Html->link('Modificar', array(
			'controller'=>'contactos',
			'action' => 'edit',
			$contacto['id'],
              		'from'=>'proveedores',
              		'from_id'=>$contacto['empresa_id']))
			.' '.$this->Form->postLink('Borrar',
			array(
				'controller'=>'contactos',
				'action' => 'delete',
				$contacto['id'],
				'from' => 'proveedores',
				'from_id' => $contacto['empresa_id']),
				array('confirm' => 'Seguro que quieres borrar a '.$contacto['nombre'].'?')
		)
	));
		//print_r($contacto);
	endforeach;
	echo "</table>\n";
	echo "</div>\n";
endif;
?>

