	<?php //$this->Html->getCrumbs(' > ');?>
<?php $this->Html->addCrumb('Bancos', array(
	'controller'=>'banco_pruebas',
	'action'=>'index'
	));
	$this->Html->addCrumb($bancoprueba['Empresa']['nombre_corto'], array(
	'controller'=>'banco_pruebas',
	'action'=>'view',
	$bancoprueba['Empresa']['id']
));
if (empty($bancoprueba)):
	echo "No hay bancos en esta lista";
else:
	//echo "<pre>";
	//print_r($bancoprueba);
	////print_r($bancoprueba['Empresa']['Contacto']);
	//echo "</pre>";

	echo "<div class='acciones'>\n";
      echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array('action'=>'edit',$bancoprueba['BancoPrueba']['id']),array('title'=>'Modificar Banco','escape'=>false)).' '.
      $this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array('action'=>'delete',$bancoprueba['BancoPrueba']['id']),array('escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$bancoprueba['Empresa']['nombre_corto'].'?'));
      //echo "\n";
     // echo '<p>';
      //pasamos también de qué clase de entidad venimos, para luego volver a esta vista
?>
</div>
<h2>Detalles Banco <?php echo $bancoprueba['Empresa']['nombre_corto']?></h2>
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
	//echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $bancoprueba['BancoPrueba']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Nombre Corto</dt>\n";
	echo "<dd>";
        echo $bancoprueba['Empresa']['nombre_corto'];
	echo "</dd>";
	echo "  <dt>Denominación legal</dt>\n";
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
	       'Teléfono Nº1', 'Teléfono Nº2', 'E-mail','Acciones'));
	foreach($bancoprueba['Empresa']['Contacto'] as $contacto):
	echo $this->Html->tableCells(array(
		$contacto['nombre'],
		$contacto['funcion'],
		$contacto['telefono1'],
		$contacto['telefono2'],
		$contacto['email'],
		$this->Html->link('<i class="fa fa-envelope-o"></i>', 'mailto:'.$contacto['email'],array(
			'class'=>'botond', 'escape'=>false,'target' => '_blank', 'title'=>'Enviar e-mail'))
		.' '.$this->Html->link('<i class="fa fa-pencil-square-o"></i>', array(
			'controller'=>'contactos',
			'action' => 'edit',
			$contacto['id'],
              		'from'=>'banco_pruebas',
              		'from_id'=>$contacto['empresa_id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar'))
			.' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
			array(
				'controller'=>'contactos',
				'action' => 'delete',
				$contacto['id'],
				'from' => 'banco_pruebas',
				'from_id' => $contacto['empresa_id']),
				array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar',
					'confirm' =>'¿Seguro que quieres borrar a '.$contacto['nombre'].'?')
		)
	));
	endforeach;

endif;
?>
</table>
	<div class="btabla">
			<?php echo $this->Html->link('<i class="fa fa-user-plus"></i> Añadir contacto',array(
		'controller'=>'transportes',
		'action'=>'add',
		'from'=>'operacion',
		'from_id' => $operacion['Transporte']['id']), array('escape' => false,'title'=>'Añadir transporte'));?>
	</div>
</div>

