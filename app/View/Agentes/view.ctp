<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Agentes', array(
	'controller'=>'agentes',
	'action'=>'index'
	));
	$this->Html->addCrumb($empresa['Empresa']['nombre_corto'], array(
	'controller'=>'agentes',
	'action'=>'view',
	$empresa['Agente']['id']
));
if (empty($empresa)):
	echo "No hay agentes en esta lista";
else:
	echo "<div class='acciones'>\n";
	echo $this->Button->edit('agentes',$empresa['Agente']['id'])
	.' '.$this->Button->delete('agentes',$empresa['Agente']['id'],$empresa['Empresa']['nombre']);
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
        echo $empresa['Empresa']['nombre_corto'];
	echo "</dd>";
	echo "  <dt>Denominacion legal</dt>\n";
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
		    $this->Button->editLine('contactos',$contacto['id'],'agentes',$contacto['empresa_id'])
		    .' '.$this->Button->deleteLine('contactos',$contacto['id'],'agentes',$contacto['empresa_id'],$contacto['nombre'])
		));
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
