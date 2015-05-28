<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Navieras', array(
	'controller'=>'navieras',
	'action'=>'index'
	));
	$this->Html->addCrumb($empresa['Empresa']['nombre'], array(
	'controller'=>'navieras',
	'action'=>'view',
	$empresa['Naviera']['id']
));
?>
<div class="index">
<h2>Detalles Naviera <?php echo $empresa['Empresa']['nombre']?></h2>
</div>
<?php
if (empty($empresa)):
	echo "No hay navieras en esta lista";
else:
	echo "<div class='actions'>\n";
	echo $this->Html->link('Modificar naviera',array('action'=>'edit',$empresa['Naviera']['id']));
      //echo '&nbsp;';
      echo "\n";
      echo '<p>';
      echo $this->Form->postLink('Borrar naviera',array('action'=>'delete',$empresa['Naviera']['id']),array('confirm'=>'¿Realmente quiere borrar '.$empresa['Empresa']['nombre'].'?'));
      //pasamos también de qué clase de entidad venimos, para luego volver a esta vista
	echo $this->Html->link('Añadir contacto',array(
		'controller'=>'contactos',
		'action'=>'add',
		'from'=>'navieras',
		'from_id' => $empresa['Empresa']['id']));
	echo "</div>\n";
      //formateamos el número de cuenta de la entidad
      $numero_bruto=$empresa['Empresa']['cuenta_bancaria'];
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
	echo $empresa['Naviera']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre</dt>\n";
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
	echo "  <dt>Cuenta entidad</dt>\n";
	echo "<dd>";
        echo $cuenta_entidad.'&nbsp;';
	echo "</dd>";
	echo '</dl>';
	?>
	<div class="detallado">
	<h3>Contactos</h3>
	<table>
	    <?php
		echo $this->Html->tableHeaders(array('Nombre', 'Función',
		   'Teléfono 1', 'Teléfono 2', 'Email','Acciones'));
		foreach($empresa['Empresa']['Contacto'] as $contacto):
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
			'from'=>'navieras',
			'from_id'=>$contacto['empresa_id']), array('class'=>'botond'))
			.' '.$this->Form->postLink('Borrar',
			array(
			    'controller'=>'contactos',
			    'action' => 'delete',
			    $contacto['id'],
			    'from' => 'navieras',
			    'from_id' => $contacto['empresa_id']),
			    array('class'=>'botond',
			    'confirm' => '¿Seguro que quieres borrar a '.$contacto['nombre'].'?')
			)
	));
		//print_r($contacto);
		endforeach;
	endif;?>
	</table>
    </div>
</div>



