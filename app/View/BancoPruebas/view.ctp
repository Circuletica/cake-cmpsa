<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', array(
	'controller'=>'banco_pruebas',
	'action'=>'index'
	));
	$this->Html->addCrumb($bancoprueba['Empresa']['nombre'], array(
	'controller'=>'banco_pruebas',
	'action'=>'view',
	$bancoprueba['Empresa']['id']
));
?>
<?php
if (empty($bancoprueba)):
	echo "No hay bancos en esta lista";
else:
	//echo "<pre>";
	//print_r($bancoprueba);
	////print_r($bancoprueba['Empresa']['Contacto']);
	//echo "</pre>";

	echo "<div class='actions'>\n";
      echo $this->Html->link('Modificar banco',array('action'=>'edit',$bancoprueba['BancoPrueba']['id']));
      echo $this->Form->postLink('Borrar banco',array('action'=>'delete',$bancoprueba['BancoPrueba']['id']),array('confirm'=>'¿Realmente quiere borrar '.$bancoprueba['Empresa']['nombre'].'?'));
      echo "\n";
      echo '<p>';
      //pasamos también de qué clase de entidad venimos, para luego volver a esta vista
	echo $this->Html->link('Añadir contacto',array(
		'controller'=>'contactos',
		'action'=>'add',
		'from'=>'banco_pruebas',
		'from_id' => $bancoprueba['Empresa']['id']));
	echo "\n";
	echo "</div>\n";
?>
<div class="index">
<h2>Detalles Banco <?php echo $bancoprueba['Empresa']['nombre']?></h2>
</div>
<?php
      //formateamos el número de cuenta de la entidad
      $numero_bruto=$bancoprueba['Empresa']['cuenta_bancaria'];
      $cuenta_entidad=substr($numero_bruto,0,4).
	      '-'.substr($numero_bruto,4,4).
	      '-'.substr($numero_bruto,8,2).
	      '-'.substr($numero_bruto,10,10);
      //formateamos el número de cuenta cliente
      $numero_bruto=$bancoprueba['BancoPrueba']['cuenta_cliente_1'];
      $cuenta_cliente=substr($numero_bruto,0,4).
	      '-'.substr($numero_bruto,4,4).
	      '-'.substr($numero_bruto,8,2).
	      '-'.substr($numero_bruto,10,10);
	echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $bancoprueba['BancoPrueba']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre</dt>\n";
	echo "<dd>";
        echo $bancoprueba['Empresa']['nombre'];
	echo "</dd>";
	echo "  <dt>Dirección</dt>\n";
	echo "<dd>";
	//si el id de país no esta definido no intentar mostrar el nombre
	$pais = $bancoprueba['Empresa']['Pais'] ? $bancoprueba['Empresa']['Pais']['nombre'] : '';
	echo $bancoprueba['Empresa']['direccion'].' - '.
		$bancoprueba['Empresa']['cp'].' '.
		$bancoprueba['Empresa']['municipio'].' - '.
		$pais.
		'&nbsp;';
	echo "</dd>";
	echo "  <dt>Teléfono</dt>\n";
	echo "<dd>";
        echo $bancoprueba['Empresa']['telefono'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>CIF</dt>\n";
	echo "<dd>";
        echo $bancoprueba['Empresa']['cif'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Código contable</dt>\n";
	echo "<dd>";
        echo $bancoprueba['Empresa']['codigo_contable'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>BIC</dt>\n";
	echo "<dd>";
        echo $bancoprueba['BancoPrueba']['bic'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Cuenta entidad</dt>\n";
	echo "<dd>";
        echo $cuenta_entidad.'&nbsp;';
	echo "</dd>";
	echo "  <dt>Cuenta cliente</dt>\n";
	echo "<dd>";
        //echo $bancoprueba['BancoPrueba']['cuenta_cliente_1'].'&nbsp;';
	echo $cuenta_cliente.'&nbsp;';
	echo "</dd>";
	echo "  <dt>IBAN cliente</dt>\n";
	echo "<dd>";
        echo $iban_cliente.'&nbsp;';
	echo "</dd>";
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
	//echo $this->Html->tableCells($bancoprueba['Empresa']['Contacto']);
	foreach($bancoprueba['Empresa']['Contacto'] as $contacto):
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
              		'from'=>'banco_pruebas',
              		'from_id'=>$contacto['empresa_id']), array('class'=>'boton'))
			.' '.$this->Form->postButton('Borrar',
			array(
				'controller'=>'contactos',
				'action' => 'delete',
				$contacto['id'],
				'from' => 'banco_pruebas',
				'from_id' => $contacto['empresa_id']), array('class'=>'boton'),
				array('confirm' =>'&iquestSeguro que quieres borrar a '.$contacto['nombre'].'?')
		)
	));
		//print_r($contacto);
	endforeach;

endif;
?>
</table>
</div> </div>

