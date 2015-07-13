<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Agentes', array(
	'controller'=>'agentes',
	'action'=>'index'
	));
	$this->Html->addCrumb($empresa['Empresa']['nombre'], array(
	'controller'=>'agentes',
	'action'=>'view',
	$empresa['Agente']['id']
));
if (empty($empresa)):
	echo "No hay agentes en esta lista";
else:
	echo "<div class='acciones'>\n";
	echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
		'action'=>'edit',$empresa['Agente']['id']),array(
		'title'=>'Modificar Agente','escape'=>false)
		).' '.
   $this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array('action'=>'delete',$empresa['Agente']['id']),array('escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$empresa['Empresa']['nombre'].'?'));

   ?>
</div>
   <h2>Detalles Agente <?php echo $empresa['Empresa']['nombre']?></h2>
   <?php
      //pasamos también de qué clase de entidad venimos, para luego volver a esta vista
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
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $empresa['Agente']['id'].'&nbsp;';
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
		    $this->Html->link('<i class="fa fa-pencil-square-o"></i>', array(
			'controller'=>'contactos',
			'action' => 'edit',
			$contacto['id'],
			'from'=>'agentes',
			'from_id'=>$contacto['empresa_id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
			array(
			    'controller'=>'contactos',
			    'action' => 'delete',
			    $contacto['id'],
			    'from' => 'agentes',
			    'from_id' => $contacto['empresa_id']),
			    array('class'=>'botond','escape'=>false, 'title'=>'Borrar',
			    'confirm' => '¿Seguro que quieres borrar a '.$contacto['nombre'].'?'))
	));
		//print_r($contacto);
		endforeach;
	endif;?>
	</table>
		<div class="btabla">
			<?php
		echo $this->Html->link('<i class="fa fa-user-plus"></i> Añadir contacto',array(
		'controller'=>'contactos',
		'action'=>'add',
		'from'=>'agentes',
		'from_id' => $empresa['Empresa']['id']),array(
		'escape' => false,
		'title'=>'Añadir contacto'));?>
    </div>
</div>
