<?php $this->Html->addCrumb('Contratos', array(
	'controller'=>'contratos',
	'action'=>'index'
	));
	$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'], array(
	'controller'=>'contratos',
	'action'=>'view',
	$contrato['Contrato']['id']
));
?>
<h2>Detalles Contrato <?php echo $contrato['Contrato']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>
<div class="acciones">
<?php
	echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
		'action'=>'edit',
		$contrato['Contrato']['id']),array('title'=>'Modificar Contrato','escape'=>false))
	.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
		'action'=>'delete',
		$contrato['Contrato']['id']),array(
		'escape'=>false, 'title'=> 'Borrar',
		'confirm'=>'¿Realmente quiere borrar el contrato '.$contrato['Contrato']['referencia'].'?')
	);
?>
</div>
	<div class='view'>
	<?php
	//mysql almacena la fecha en formato YMD
	$fecha = $contrato['Contrato']['fecha_embarque'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	$fecha_embarque = $dia.'-'.$mes.'-'.$anyo;
	$fecha = $contrato['Contrato']['fecha_entrega'];
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anyo = substr($fecha,0,4);
	$fecha_entrega = $dia.'-'.$mes.'-'.$anyo;
	echo "<dl>";
	//echo "  <dt>Id</dt>\n";
	//echo "  <dd>".$contrato['Contrato']['id'].'&nbsp;'."</dd>";
	echo "  <dt>Referencia</dt>\n";
	echo "  <dd>".$contrato['Contrato']['referencia'].'&nbsp;'."</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->Html->link($contrato['Proveedor']['Empresa']['nombre'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$contrato['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "  <dd>".$contrato['CalidadNombre']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Peso</dt>\n";
	echo "  <dd>".$contrato['Contrato']['peso_comprado'].'&nbsp;'."</dd>";
	echo "  <table>\n";
	echo $this->Html->tableHeaders(array('Cantidad','Embalaje', 'Peso ud.', 'Peso'));
	$peso_total = 0;
	foreach($contrato['ContratoEmbalaje'] as $embalaje):
		$peso_embalaje = $embalaje['cantidad_embalaje'] * $embalaje['peso_embalaje_real'];
		echo $this->Html->tableCells(array(
			$embalaje['cantidad_embalaje'],
			$embalaje['Embalaje']['nombre'],
			$embalaje['peso_embalaje_real'],
			$peso_embalaje,
			));
		$peso_total += $peso_embalaje;
	endforeach;
	echo "  </table>\n";
	echo "  <dt>Fecha de embarque</dt>\n";
	echo "  <dd>".$fecha_embarque."</dd>";
	echo "  <dt>Fecha de entrega</dt>\n";
	echo "  <dd>".$fecha_entrega."</dd>";
	//$bolsa = $contrato['Contrato']['si_londres'] ? 'London' : 'New-York';
	$bolsa = $contrato['Contrato']['canal_compra'];
	//echo "  <dt>Bolsa</dt>\n";
	//echo "  <dd>".$bolsa.'&nbsp;'."</dd>";
	echo "  <dt>Diferencial</dt>\n";
	echo "  <dd>".$contrato['Contrato']['diferencial'].' ('.$bolsa.')&nbsp;'."</dd>";
	echo "  <dt>Incoterm</dt>\n";
	echo "  <dd>".$contrato['Incoterm']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Opciones</dt>\n";
	echo "  <dd>".$contrato['Contrato']['opciones'].'&nbsp;'."</dd>";
	echo "</dl>";?>
	<div class="detallado">
	<h3>Líneas de contrato</h3>
<table>
<?php
	echo $this->Html->tableHeaders(array('Referencia','Peso','Fecha de fijación', 'Precio de fijación', 'Precio de compra', 'Acciones'));
	foreach($contrato['LineaContrato'] as $linea):
		echo $this->Html->tableCells(array(
			$linea['referencia'],
			$linea['peso_linea_contrato'],
			$linea['fecha_pos_fijacion'],
			$linea['precio_fijacion'],
			$linea['precio_compra'],
			$this->Html->link('<i class="fa fa-pencil-square-o"></i>', array(
			'controller'=>'linea_contratos',
			'action' => 'edit',
			$linea['id'],
              		'from'=>'contratos',
              		'from_id'=>$contrato['Contrato']['id']), array('class'=>'botond','escape'=>false, 'title'=>'Modificar'))
			.' '.$this->Form->postLink(
				'<i class="fa fa-trash"></i>',
				array(
					'controller'=>'linea_contratos',
					'action' => 'delete',
					$linea['id'],
					'from' => 'contratos',
					'from_id' => $contrato['Contrato']['id']
				),
				array(
					'class'=>'botond',
					'escape'=>false,
					'title'=> 'Borrar',
					'confirm' =>'¿Seguro que quieres borrar a '.$linea['referencia'].'?'
				)
			)
		)
	);
	endforeach;
	echo "</table>";
		echo '<div class="btabla">';
		echo $this->Html->link('<i class="fa fa-plus"></i> Añadir línea',array(
		'controller' => 'linea_contratos',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_id' => $contrato['Contrato']['id']),
		 array('escape' => false,'title'=>'Añadir línea de contrato'));
		?>
		</div>
	</div>
</div>

